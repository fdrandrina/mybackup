import json
import nltk
from nltk.tokenize import word_tokenize
from nltk.tag import pos_tag
from nltk.probability import FreqDist
from nltk.corpus import stopwords

nltk.download('punkt')
nltk.download('averaged_perceptron_tagger')
nltk.download('stopwords')

text = "In this video, I want to share you how to tokenize the dataset for preprocessing. It was my last solution. I did it to save you. I want to go to the market. I like to move it. I would like to present my application to you. I like seeming. I am going to use chat gpt."

tokens = word_tokenize(text)
tagged_tokens = pos_tag(tokens)

stop_words = set(stopwords.words('english'))

verb_pos_dict = {}
verb_pos_dict2 = {}

for word, pos in tagged_tokens:
    if word.lower() not in stop_words and (pos.startswith('VB') or pos.startswith('MD')):
        if pos in verb_pos_dict:
            verb_pos_dict[pos].append(word)
        else:
            verb_pos_dict[pos] = [word]

verb_pos_dict2["present"] = verb_pos_dict.get("VB", []) + verb_pos_dict.get("VBP", [])

# Copier les autres clés avec leurs contenus respectifs
for pos in verb_pos_dict.keys():
    if pos not in ["VB", "VBP"]:
        verb_pos_dict2[pos] = verb_pos_dict[pos]

res2 = json.dumps(verb_pos_dict2)
print(res2)
