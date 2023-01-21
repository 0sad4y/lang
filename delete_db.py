import pymysql


db = pymysql.connect(host="localhost", user="root", password="", database="lang", autocommit=True)
cursor = db.cursor()


#cursor.execute('DELETE FROM nametosent')
#cursor.execute('DELETE FROM attrtosent')
#cursor.execute('DELETE FROM names')
#cursor.execute('DELETE FROM attractions')
#cursor.execute('DELETE FROM sentences')
#cursor.execute('DELETE FROM news')
