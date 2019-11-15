import MySQLdb
import random
import pandas as pd
import numpy as np
import os
from sklearn import svm
from sklearn.ensemble import BaggingClassifier, RandomForestClassifier
from sklearn.externals import joblib

for root, dirs, files in os.walk("."):  
    for filename in files:
        if filename.endswith("ALL.csv"):
        	train_dataframe = pd.read_csv("Scene/"+filename)
        	train_labels = train_dataframe.Label
        	labels=list(train_labels)
        	train_labels=np.array(labels)
        	train_features = train_dataframe.iloc[:,2:]
        	train_features=np.array(train_features)

classifier=RandomForestClassifier(min_samples_leaf=20)
classifier.fit(train_features, train_labels)

filename = 'final_train.sav'
joblib.dump(classifier, filename)


#print(classifier.predict([[26,271,42,167,77,141,228,20,335,985,610,886]])[0])
"""
for i in range(0,100):
	
	test_dataframe = pd.read_csv('test.csv')

	test_labels = test_dataframe.Label
	labels = list(test_labels)
	test_labels = np.array(labels)

	test_features = test_dataframe.iloc[:,2:]
	test_features = np.array(test_features)

	results = classifier.predict(test_features)
	num_correct = (results == test_labels).sum()
	recall = num_correct / len(test_labels)
	print ("model accuracy (%): ", recall * 100, "%")
"""