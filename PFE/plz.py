from nltk.corpus import wordnet
from nltk.corpus import wordnet as wn


dog = wn.synset('son.n.01')

cat = wn.synset('boy.n.01')


print(dog.wup_similarity(cat))