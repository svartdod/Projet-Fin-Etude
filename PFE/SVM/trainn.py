import MySQLdb
import random
import pandas as pd
import numpy as np
import os
from sklearn import svm
from sklearn.ensemble import BaggingClassifier, RandomForestClassifier
from sklearn.externals import joblib

"""

train_dataframe = pd.read_csv("data.csv")
train_labels = train_dataframe.Label
labels=list(train_labels)
train_labels=np.array(labels)
train_features = train_dataframe.iloc[:,2:]
train_features=np.array(train_features)

classifier=svm.SVC()


classifier.fit(train_features, train_labels)
filename = 'final_trainsvm.sav'
joblib.dump(classifier, filename)
"""

filename = 'final_trainsvm.sav'
loaded_model = joblib.load(filename)
print(loaded_model.predict([[131,111,258,398,1147,1223]])[0])








test_dataframe = pd.read_csv('data_ff.csv')

test_labels = test_dataframe.Label
labels = list(test_labels)
test_labels = np.array(labels)

test_features = test_dataframe.iloc[:,2:]
test_features = np.array(test_features)

results = loaded_model.predict(test_features)
num_correct = (results == test_labels).sum()
recall = num_correct / len(test_labels)
print ("model accuracy (%): ", recall * 100, "%")
