import MySQLdb
import pandas as pd 

db=MySQLdb.connect(host="localhost",user="root",passwd="",db="pfe_final")

cursor=db.cursor()

Query="SELECT * from superclass"
cursor.execute(Query)

rows=cursor.fetchall()

final_resultat=[i[0] for i in rows]

for row in final_resultat:
	text="SELECT * from object_in_superclass where Classname="
	cursor.execute(text+"'"+row+"'")
	objs=cursor.fetchall()
	object_resultat=[i[1] for i in objs]
	text2="SELECT * from action_in_superclass where Classname="
	cursor.execute(text2+"'"+row+"'")
	acts=cursor.fetchall()
	action_resultat=[i[1] for i in acts]
	text3="SELECT * from actor_in_superclass where Classname="
	cursor.execute(text3+"'"+row+"'")
	acts=cursor.fetchall()
	actor_resultat=[i[1] for i in acts]
	print(len(object_resultat),len(action_resultat),len(actor_resultat))
	x=max(len(object_resultat),len(action_resultat),len(actor_resultat))
	for i in range(	len(object_resultat),x):
		object_resultat.append("1")
	for i in range(len(action_resultat),x):
		action_resultat.append("1")
	for i in range(len(actor_resultat),x):
		actor_resultat.append("1")
	print(len(object_resultat),len(action_resultat),len(actor_resultat))

	raw_data={"Object":object_resultat,"action":action_resultat,"actor":actor_resultat}
	df=pd.DataFrame(raw_data,columns =['Object','action','actor'])
	a='Clean up/'+str(row)+'.csv'
	df.to_csv(a)
