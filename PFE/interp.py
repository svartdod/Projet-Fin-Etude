from nltk.corpus import wordnet as w 
import MySQLdb 
from itertools import product
import sys


db=MySQLdb.connect(host="localhost",
					user ="root",
					passwd="",
					db="pfe_final")
cursor=db.cursor()	




classsname=sys.argv[1]



liste=classsname.split("_")

list2=[]
list2.append(str(liste[1]))



Query="SELECT * from interactions where Classname="+"'"+str(liste[0])+"'"


cursor.execute(Query)

rows=cursor.fetchall()





list1=set([i[1] for i in rows])


liste_final=product(list2, list1)


resultat=[]

for l in liste_final:
	Query1="SELECT Poid,Actor2 from Wordnet_final_final where Actor1=%s and Actor2=%s"
	cursor.execute(Query1,(l[0],l[1]))
	rows=cursor.fetchall()
	final_result = [j[0] for j in rows]
	actors = [j[1] for j in rows]
	
	resultat.append(final_result[0])

indexx=resultat.index(max(resultat))

print(actors[indexx])


"""

allsyns1 = set(ss for word in list1 for ss in w.synsets(word))

allsyns2 = set(ss for word in list2 for ss in w.synsets(word))




best = max((w.wup_similarity(s1, s2) or 0, s1, s2) for s1, s2 in 
        product(allsyns1, allsyns2))
       

"""

"""


	$actors=$_POST['actts'];
	$new_traitement=$classs;
	$se9sini=$new_traitement."_".$actors;
	$chaine1="python3 interp.py ".(string)$se9sini;

	
	$resultat1=shell_exec($chaine1);
	
	$gg=$resultat1;
	echo $gg;
	$V=joke($database,get_all_triplettt($database,$gg),$classs);
	print_r($V);

"""