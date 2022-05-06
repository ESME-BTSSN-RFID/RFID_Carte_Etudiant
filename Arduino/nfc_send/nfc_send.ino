#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

#include <SPI.h>
#include <MFRC522.h>

#define SS_PIN D8
#define RST_PIN D0

MFRC522 rfid(SS_PIN, RST_PIN); // Instance of the class
MFRC522::MIFARE_Key key;

//char nuidPICC[4];
String uidString;

// Replace with your network credentials
const char* ssid     = "SilverFlamingo";
const char* password = "uNBN7DsuVQ";

//const char* ssid     = "Arduino";
//const char* password = "hugooooo";

// REPLACE with your Domain name and URL path or IP address with path
const char* serverName = "http://10.10.10.60/BTS2/projet_web-main/SCRIPTS/esp_insert.php";


void setup() {
  Serial.begin(115200);
  SPI.begin(); // Init SPI bus
  rfid.PCD_Init(); // Init MFRC522

  
  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) { 
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());

}

void loop() {
  // Reset the loop if no new card present on the sensor/reader. This saves the entire process when idle.
 if ( ! rfid.PICC_IsNewCardPresent())
   return;
 // Verify if the UID has been readed
 if ( ! rfid.PICC_ReadCardSerial())
   return;
 
 MFRC522::PICC_Type piccType = rfid.PICC_GetType(rfid.uid.sak);
 
 if (piccType != MFRC522::PICC_TYPE_MIFARE_MINI &&
     piccType != MFRC522::PICC_TYPE_MIFARE_1K &&
     piccType != MFRC522::PICC_TYPE_MIFARE_4K) {
   Serial.println(F("Your tag is not of type MIFARE Classic."));
   return;
  }
 if (rfid.uid.uidByte) {
   Serial.println(F("UID tag is:"));
   printHex(rfid.uid.uidByte, rfid.uid.size);
   Serial.println();

   uidString = String(rfid.uid.uidByte[0], HEX) + " " + String(rfid.uid.uidByte[1], HEX) + " " + 
    String(rfid.uid.uidByte[2], HEX) + " " + String(rfid.uid.uidByte[3], HEX);

    Serial.println(uidString);

   connection(uidString);
   delay(3000);
  }

}

void printHex(byte *buffer, byte bufferSize) {
 for (byte i = 0; i < bufferSize; i++) {
   Serial.print(buffer[i] < 0x10 ? " 0" : " ");
   Serial.print(buffer[i], HEX);
 }


}


void connection(String send){
  if(WiFi.status()== WL_CONNECTED){
    WiFiClient client;
    HTTPClient http;
    
    // Your Domain name with URL path or IP address with path
    http.begin(client, serverName);
    
    // Specify content-type header
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    
    // Prepare your HTTP POST request data
    String httpRequestData = "data=" + send;
    Serial.print("httpRequestData: ");
    Serial.println(httpRequestData);

    // Send HTTP POST request
    int httpResponseCode = http.POST(httpRequestData);
    Serial.println(httpResponseCode);
    
  }
  else {
    Serial.println("WiFi Disconnected");
  }
  }
