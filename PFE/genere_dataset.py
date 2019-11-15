import MySQLdb
import random
import pandas as pd

db=MySQLdb.connect(host="localhost",
					user ="root",
					passwd="",
					db="pfe_final")
cursor=db.cursor()	
Query="SELECT * from object"
cursor.execute(Query)
rows=cursor.fetchall()
final_result = [i for i in rows]
dicto=dict()
i=0
for resultat in final_result:
	if (resultat not in dicto.keys()):
		dicto[resultat[0]]=i
		i+=1



Query="SELECT * from action_in_superclass"
cursor.execute(Query)
rows=cursor.fetchall()
final_result = [j for j in rows]

for resultat in final_result:
	if (resultat not in dicto.keys()):
		dicto[resultat[1]]=i
		i+=1

"""	
Query="SELECT * from actor_in_superclass"
cursor.execute(Query)
rows=cursor.fetchall()
final_result = [j for j in rows]

for resultat in final_result:
	if (resultat not in dicto.keys()):
		dicto[resultat[1]]=i
		i+=1

"""
print(i)
outfile = open( 'dict.txt', 'w' )
for key, value in sorted( dicto.items() ):
    outfile.write( str(key) + '\t' + str(value) + '\n' )

Query="SELECT * from superclass"
cursor.execute(Query)
rows=cursor.fetchall()
final_result = [i[0] for i in rows]
print(final_result)

args='bedroom'
sql = "SELECT * FROM object_in_superclass WHERE poid >=80 and Classname="
sql1="SELECT * FROM action_in_superclass where Poid >=70 and Classname="
sql2="SELECT * FROM actor_in_superclass where Poid >= 85 and Classname="
liste5=[]
	


	
liste=[]
liste2=[]
liste3=[]
label=[]
liste4=[]

for row in final_result:

	Query_object=sql+"'"+row+"'"
	cursor.execute(Query_object)
	objs=cursor.fetchall()
	object_resultat=[i[1] for i in objs]
	
	query_action=sql1+"'"+row+"'"
	cursor.execute(query_action)
	acts=cursor.fetchall()
	action_resultat=[i[1] for i in acts]

	

	

	query_actor=sql2+"'"+row+"'"
	cursor.execute(query_actor)
	actors=cursor.fetchall()
	actor_resultat=[i[1] for i in actors]

	
	
	for j in range(0,5000):
		label.append(row)
		print(row)
		option1, option2, option3 = random.sample(range(0, len(object_resultat)), 3)

		liste.append(dicto[object_resultat[option1]])
		liste2.append(dicto[object_resultat[option2]])
		liste3.append(dicto[object_resultat[option3]])

		rando=random.randrange(0, len(action_resultat))

		liste4.append(dicto[action_resultat[rando]])
		"""
		rando=random.randrange(0,len(actor_resultat))
		liste5.append(dicto[actor_resultat[rando]])
		"""
		
raw_data={"Label":label,"Object1":liste,"Object2":liste2,"Object3":liste3,"Action":liste4}
df=pd.DataFrame(raw_data,columns =['Label','Object1','Object2','Object3','Action'])
a='Scene/'+'ALL'+'.csv'
#a='test'+'.csv'
gg=str(a)
df.to_csv(gg)