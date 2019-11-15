import MySQLdb
import random
import pandas as pd
from random import randrange, uniform
db=MySQLdb.connect(host="localhost",
					user ="root",
					passwd="",
					db="pfe_final")
cursor=db.cursor()	




def generer_medium_dataset(Precision):
	Query="SELECT * from object"
	cursor.execute(Query)
	rows=cursor.fetchall()
	final_result = [i for i in rows]
	final_result1 = [i[0] for i in rows]
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

	Query="SELECT * from actor_in_superclass"
	cursor.execute(Query)
	rows=cursor.fetchall()
	final_result = [j for j in rows]

	for resultat in final_result:
		if (resultat not in dicto.keys()):
			dicto[resultat[1]]=i
			i+=1


	print(i)
	outfile = open( 'dict1.txt', 'w' )
	for key, value in sorted( dicto.items() ):
	    outfile.write( str(key) + '\t' + str(value) + '\n' )

	sql = "SELECT * FROM object_in_superclass WHERE poid >=65 and Classname="
	sql1="SELECT * FROM action_in_superclass Where Poid >=80 and Classname="
	sql2="SELECT * FROM actor_in_superclass Where Poid >=90 and Classname="
	liste5=[]
		
	
	liste2=[]
	liste3=[]
	label=[]
	liste4=[]
	generam=[]
	obj_number=int(4*Precision)
	reste=4-obj_number
	

	Query="SELECT * from superclass"
	cursor.execute(Query)
	rows=cursor.fetchall()
	final_result = [i[0] for i in rows]
	for row in final_result:
		print(row)
		
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
		actss=cursor.fetchall()
		actor_resultat=[i[1] for i in actss]



		for j in range(0,100):
			label.append(row)
			indexs=0
			liste=[]
			listes=object_resultat[:]
			while(indexs<obj_number):
				option=randrange(0,len(object_resultat))
				liste.append(dicto[object_resultat[option]])
				del object_resultat[option]
				indexs=indexs+1
			object_resultat=listes[:]
			k=0
			while(k<reste):
				optionn=randrange(0,len(final_result1))
				liste.append(dicto[final_result1[optionn]])
				k=k+1



			generam.append(liste)
			option1=random.randint(0,len(action_resultat)-1)

			liste2.append(dicto[action_resultat[option1]])
		

			option4= random.randint(0,len(actor_resultat)-1)
			#random.sample(range(0, len(actor_resultat)), 1)
			liste4.append(dicto[actor_resultat[option4]])


	raw_data={"Label":label,"Object1":[x[0] for x in generam],"Object2":[x[1] for x in generam],"Object3":[x[2] for x in generam],"Object4":[x[3] for x in generam],"Action":liste2,"Acteur":liste4}
	df=pd.DataFrame(raw_data,columns =['Label','Object1','Object2','Object3','Object4','Action','Acteur'])
	
	a='data_ff'+'.csv'

	gg=str(a)
	df.to_csv(gg)

		


generer_medium_dataset(1)