import MySQLdb
import random
import pandas as pd
import numpy as np
import sys
import os
from sklearn import svm
from sklearn.ensemble import BaggingClassifier, RandomForestClassifier
from sklearn.externals import joblib

db=MySQLdb.connect(host="localhost",
					user ="root",
					passwd="",
					db="pfe_final")
cursor=db.cursor()	
dicto=dict()


"""
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
"""
for line in open("dict1.txt"):
	a=(line.replace("\n","").split("	"))
	dicto[a[0]]=a[1]


input_data=sys.argv[1]
input_data=input_data.replace("_"," ")
data=input_data[:].replace(","," ").split(" ")
data_final=[d.replace('$',' ') for d in data]
traintement=[]
for d in data_final:
	if d in dicto.keys():
		traintement.append(dicto[d])
	else:
		traintement.append(0)


filename = 'final_train1.sav'
loaded_model = joblib.load(filename)
print(loaded_model.predict([traintement]))
