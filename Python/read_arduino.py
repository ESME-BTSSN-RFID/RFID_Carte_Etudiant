import serial
import time
import mysql.connector
import argparse


def connection():
    global connect, cursor    
    connect = mysql.connector.connect(host="10.4.253.110", user="connect", password="", database="projet_btssnir")
    cursor= connect.cursor()

    return connect, cursor ##Enlever connect



def request(req):
    connection()  ##Connection appeler une fois en début de programme puis utiliser le return dans une autre variable
    global myresult  ##Pas besoin de myresult

    cursor.execute(req)
    myresult=cursor.fetchall() ##Pas besoin de myresult

    return myresult  ##Pas besoin de return


ser = serial.Serial('COM5', 9800, timeout=1)

def main():
    while 1:
        line = ser.readline()   # read a byte
        if line:
            string = line.decode()  # convert the byte string to a unicode string
            #num = int(string) # convert the unicode string to an int
            print(string)
            request("INSERT INTO `test` (`id`, `uid`) VALUES (NULL, '{}')".format(string))
    

ser.close()

if __name__ == "__main__":
    parser = argparse.ArgumentParser(description="Read data from the arduino and send it to the remote database")
    main()