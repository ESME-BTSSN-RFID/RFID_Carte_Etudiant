import serial
import time
import mysql.connector
import argparse
import ipaddress


def connection():
    global connect, cursor   ##Pas besoin de connect et cursor en global   
    connect = mysql.connector.connect(host="10.4.253.110", user="connect", password="", database="projet_btssnir")
    cursor= connect.cursor()

    return connect, cursor ##Enlever connect



def request(req):
    connection()  ##Connection appeler une fois en début de programme puis utiliser le return dans une autre variable
    global myresult  ##Pas besoin de myresult en global

    cursor.execute(req)
    myresult=cursor.fetchall() ##Pas besoin de myresult

    return myresult  ##Pas besoin de return


def validate_ip_address(address):
    try:
        ip = ipaddress.ip_address(address)
        print("IP address {} is valid. The object returned is {}".format(address, ip))
        return True
    except ValueError:
        print("IP address {} is not valid".format(address))
        print("exiting ...")
        return False


def main():
    while 1:                    # quit when key pressed
        line = ser.readline()   # read a byte
        if line:
            string = line.decode()  # convert the byte string to a unicode string
            #num = int(string) # convert the unicode string to an int
            print(string)
            request("INSERT INTO `test` (`id`, `uid`) VALUES (NULL, '{}')".format(string))
    

if __name__ == "__main__":
    parser = argparse.ArgumentParser(description="Read UID scanned by the arduino and send it to the remote database")
    parser.add_argument("ip-address", type=str, help="Give the ip address of the server")
    args = parser.parse_args()

    if validate_ip_address(args.ip-address):
        #ser = serial.Serial('COM5', 9800, timeout=1)
        #main(args.ip-address)
        #ser.close()
        pass
    else:
        exit()