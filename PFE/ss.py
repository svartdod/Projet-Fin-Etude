from nltk.corpus import wordnet as w 
import MySQLdb 
from itertools import product
import sys




db=MySQLdb.connect(host="localhost",
					user ="root",
					passwd="",
					db="pfe_final")
cursor=db.cursor()	

Query="SELECT DISTINCT Actor1,Actor2,Poid from Wordnet_final"
cursor.execute(Query)
rows=cursor.fetchall()
final_result = [j for j in rows]
print(final_result)


for f in final_result:

	cursor.execute('INSERT IGNORE INTO Wordnet_final_final VALUES (%s,%s,%s)',(f[0],f[1],f[2]))
