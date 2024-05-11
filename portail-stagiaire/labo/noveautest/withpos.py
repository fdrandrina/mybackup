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


verbs = [(word, pos) for word, pos in tagged_tokens if (pos.startswith('VB') or pos.startswith('MD')) and word.lower() not in stop_words]

verbs_occurrences = [{'verb': word, 'pos': pos} for (word, pos) in verbs]

stats = {'verbs': verbs_occurrences}
res = json.dumps(stats)
print(res)
