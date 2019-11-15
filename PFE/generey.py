import MySQLdb
import random
import pandas as pd
import numpy as np
import os

db=MySQLdb.connect(host="localhost",
					user ="root",
					passwd="",
					db="pfe_final")
cursor=db.cursor()	


Query="SELECT * from object"
cursor.execute(Query)
rows=cursor.fetchall()
final_result = [i for i in rows]
dicto={}
i=0
for resultat in final_result:
	if (resultat not in dicto.keys()):
		dicto[resultat]=i
		i+=1

x_train=np.array()
train_label=np.array()

for root, dirs, files in os.walk("."):  
    for filename in files:
        if filename.endswith(".csv"):
        	train_dataframe = pd.read_csv("Scene/"+filename)
        	train_labels = train_dataframe.Label
        	labels=list(train_labels)
        	train_labels=np.array([labels.index(x) for x in train_labels])
        	np.concatenate((train_label, train_label)