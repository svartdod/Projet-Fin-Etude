from nltk.corpus import wordnet as w 
import MySQLdb 
from itertools import product
import sys




db=MySQLdb.connect(host="localhost",
					user ="root",
					passwd="",
					db="pfe_final")
cursor=db.cursor()	


Query="SELECT DISTINCT (Actorname) from actor_in_superclass"
cursor.execute(Query)
rows=cursor.fetchall()
final_result = [j[0] for j in rows]


allsyns1 = set(ss for word in final_result for ss in w.synsets(word))

allsyns2 = set(ss for word in final_result for ss in w.synsets(word))

liste=product(allsyns1, allsyns2)
i=0
for l in liste :
	
	element=str(l[0])[8:-7]
	element2=str(l[1])[8:-7]
	Query1="SELECT Actor1,Actor2,max(Poid) from Wordnet  where Actor1=%s and Actor2=%s group by actor1,actor2"
	cursor.execute(Query1,(element,element2))
	rows=cursor.fetchall()
	final_result = [j for j in rows]
	print(final_result[0][0],final_result[0][1],final_result[0][2])
	cursor.execute('INSERT IGNORE INTO Wordnet_final VALUES (%s,%s,%s)',(final_result[0][0],final_result[0][1],final_result[0][2]))
	

	
print("done")
	
	

	
"""
best = ((w.wup_similarity(s1, s2) or 0, s1, s2) for s1, s2 in 
        product(allsyns1, allsyns2))


for b in best:
	cursor.execute('INSERT IGNORE INTO Wordnet VALUES (%s,%s,%s)',(str(b[2])[8:-7],str(b[1])[8:-7],b[0],))

print("done")
"""
