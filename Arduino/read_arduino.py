import serial
import time
import mysql.connector


def connection():
    global connect, cursor    
    connect = mysql.connector.connect(host="10.4.253.110", user="connect", password="", database="projet_btssnir")
    cursor= connect.cursor()

    return connect, cursor



def request(req):
    connection()
    global myresult

    cursor.execute(req)
    myresult=cursor.fetchall()

    return myresult


ser = serial.Serial('COM5', 9800, timeout=1)

while True:
    line = ser.readline()   # read a byte
    if line:
        string = line.decode()  # convert the byte string to a unicode string
        #num = int(string) # convert the unicode string to an int
        print(string)
        request("INSERT INTO `test` (`id`, `uid`) VALUES (NULL, '{}')".format(string))
    

ser.close()