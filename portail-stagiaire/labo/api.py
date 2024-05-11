# -*- coding: utf-8 -*-


import json
from flask import Flask, jsonify, request
import nltk
from nltk.corpus import wordnet
from nltk.sentiment import SentimentIntensityAnalyzer
from nltk.tokenize import word_tokenize
from nltk.tag import pos_tag
from nltk.corpus import stopwords
from nltk.probability import FreqDist
from nltk.collocations import BigramAssocMeasures, BigramCollocationFinder
from nltk.collocations import TrigramAssocMeasures, TrigramCollocationFinder
import string
import spacy
import numpy as np
nlp = spacy.load("en_core_web_sm")

nltk.download('stopwords')
nltk.download('punkt')
nltk.download('averaged_perceptron_tagger')
app = Flask(__name__)
nltk.download('vader_lexicon')
sia = SentimentIntensityAnalyzer()
def extractpos(sentence):
    mots = nltk.word_tokenize(sentence)
    pos_tags = nltk.pos_tag(mots)
    return pos_tag
@app.route('/extractpos', methods=['POST'])
def extractpos():
    sentence = request.json['sentence']
    mots = nltk.word_tokenize(sentence)
    pos_tags = nltk.pos_tag(mots)
    return jsonify({'pos_tags': pos_tags})

@app.route('/mystats', methods=['POST'])
def extract():
    sentence = request.json['sentence']
    tokens = word_tokenize(sentence)

    # Obtenir les parties du discours pour chaque mot
    tagged_tokens = pos_tag(tokens)

    # Extraire les verbes du texte
    verbs = [word for word, pos in tagged_tokens if pos.startswith('VB')]
    verbs = jsonify({'verbs':verbs,'test':verbs})
    return jsonify({'verbs': verbs})

@app.route('/listverb', methods=['POST'])
def listverb():
    text = "In this video, I want to share how to tokenize the dataset for preprocessing."
    sentence = request.json['sentence']
    # Tokenizer le texte en mots
    tokens = word_tokenize(sentence)
    # Obtenir les parties du discours pour chaque mot
    tagged_tokens = pos_tag(tokens)
    # Extraire les verbes du texte
    verbs = [word for word, pos in tagged_tokens if pos.startswith('VB')]
    verbs_uniques = set(verbs)
    verbs_uniques_liste = list(verbs_uniques)
    adjectivs = [word for word, pos in tagged_tokens if pos.startswith('JJ')]
    adjectivs_uniques = set(adjectivs)
    adjectivs_uniques_liste = list(adjectivs_uniques)
    texte = sentence.lower()
    mots = nltk.word_tokenize(texte)
    mots_sans_stopwords = [mot for mot in mots if mot not in stopwords.words('english')] # Supprimer les mots vides
    # Compter les occurrences des mots
    compteur_mots = nltk.FreqDist(mots_sans_stopwords)
    hapax = compteur_mots.hapaxes()
    num_vb = len(verbs_uniques_liste)
    if not verbs_uniques_liste:
        verbs_uniques_liste = ['0']
    stats = jsonify({'glossaire_verbs':verbs_uniques_liste, 'stats_nbverb':num_vb})
    # Afficher les verbes
    # print("Verbes : ", verbs)
    return stats
@app.route('/listverbPos', methods=['POST'])
def listverbPos():
    text = "In this video, I want to share you how to tokenize the dataset for preprocessing. It was my last solution. I did it to save you. I want to go to the market. I like to move it. I would like to present my application to you. I like seeming. I am going to use chat gpt. I will travel to Europe next summer and explore different countries. I will go to the park tomorrow."
    sentence = request.json['sentence']
    tokens = nltk.word_tokenize(sentence)
    tagged_tokens = nltk.pos_tag(tokens)

    stop_words = set(nltk.corpus.stopwords.words('english'))

    verb_pos_dict = {}
    verb_pos_dict2 = {}

    for word, pos in tagged_tokens:
        if word.lower() not in stop_words and (pos.startswith('VB') or pos.startswith('MD')):
            if pos in verb_pos_dict:
                verb_pos_dict[pos].append(word)
            else:
                verb_pos_dict[pos] = [word]

    # verb_pos_dict2["conjugaison_presentVerb"] = verb_pos_dict.get("VB", []) + verb_pos_dict.get("VBP", []) + verb_pos_dict.get("VBZ", [])
    # verb_pos_dict2["conjugaison_ingVerb"] = verb_pos_dict.get("VBG", [])
    # verb_pos_dict2["conjugaison_pastParticipe"] = verb_pos_dict.get("VBN", [])
    # verb_pos_dict2["conjugaison_pastVerb"] = verb_pos_dict.get("VBD", [])


    present_verb = verb_pos_dict.get("VB", []) + verb_pos_dict.get("VBP", []) + verb_pos_dict.get("VBZ", [])

    if not present_verb:
        verb_pos_dict2["conjugaison_presentVerb"] = ['0']
    else:
        verb_pos_dict2["conjugaison_presentVerb"] = present_verb

    if not verb_pos_dict.get("MD"):
        verb_pos_dict2["conjugaison_modalVerb"] = ['0']
    else:
        verb_pos_dict2["conjugaison_modalVerb"] = verb_pos_dict.get("MD", [])

    if not verb_pos_dict.get("VBG"):
        verb_pos_dict2["conjugaison_ingVerb"] = ['0']
    else:
        verb_pos_dict2["conjugaison_ingVerb"] = verb_pos_dict.get("VBG", [])

    if not verb_pos_dict.get("VBN"):
        verb_pos_dict2["conjugaison_pastParticipe"] = ['0']
    else:
        verb_pos_dict2["conjugaison_pastParticipe"] = verb_pos_dict.get("VBN", [])

    if not verb_pos_dict.get("VBD"):
        verb_pos_dict2["conjugaison_pastVerb"] = ['0']
    else:
        verb_pos_dict2["conjugaison_pastVerb"] = verb_pos_dict.get("VBD", [])



    # # Copier les autres clés avec leurs contenus respectifs
    # for pos in verb_pos_dict.keys():
    #     if pos not in ["VB", "VBP", "VBZ", "VBG"]:
    #         verb_pos_dict2[pos] = verb_pos_dict[pos]

    res = json.dumps(verb_pos_dict2)
    print(res)
    return res




@app.route('/listadj', methods=['POST'])
def listadj():
    sentence = request.json['sentence']
    # Tokenizer le texte en mots
    tokens = word_tokenize(sentence)
    # Obtenir les parties du discours pour chaque mot
    tagged_tokens = pos_tag(tokens)
    # Extraire les verbes du texte
    adjectivs = [word for word, pos in tagged_tokens if pos.startswith('JJ')]
    adjectivs_uniques = set(adjectivs)
    adjectivs_uniques_liste = list(adjectivs_uniques)
    num_adj = len(adjectivs_uniques_liste)
    # Afficher les verbess
    # print("Verbes : ", verbs)
    if not adjectivs_uniques_liste:
        adjectivs_uniques_liste = ['0']
    return jsonify({"glossaire_adjectivs":adjectivs_uniques_liste, 'stats_nbadj':num_adj})

@app.route('/countword', methods=['POST'])
def countexpression():
    sentence = request.json['sentence']
    mots = nltk.word_tokenize(sentence)
    num_words = len(mots)
    return jsonify({'nbwords': num_words})

@app.route('/listhapax', methods=['POST'])
def listhappax():
    sentence = request.json['sentence']
# Prétraiter le texte
    texte = sentence.lower() # Convertir en minuscules
    translator = str.maketrans('', '', string.punctuation)
    filtered_text = texte.translate(translator)
    mots = nltk.word_tokenize(filtered_text) # Diviser en mots
    mots_sans_stopwords = [mot for mot in mots if mot not in stopwords.words('english')] # Supprimer les mots vides
    # Compter les occurrences des mots
    compteur_mots = nltk.FreqDist(mots_sans_stopwords)
    hapax = compteur_mots.hapaxes()
    num_hapax = len(hapax)
    if not hapax:
        hapax = ['0']
    # print(hapax)
    return jsonify({'glossaire_hapaxes': hapax, 'stats_nbhapax':num_hapax})

@app.route('/listexp', methods=['POST'])
def listExp():
    sentence = request.json['sentence']
    texte = sentence.lower()
    finder = TrigramCollocationFinder.from_words(texte.split())
    finder.apply_freq_filter(1) # Pour inclure uniquement les collocations qui apparaissent au moins 2 fois
    trigram_measures = TrigramAssocMeasures()
    collocations = finder.nbest(trigram_measures.pmi, 20)
    scored = finder.score_ngrams(trigram_measures.raw_freq)
    sorted_collocations = sorted(scored, key=lambda x: x[1], reverse=True)
    results = []
    mots = nltk.word_tokenize(sentence)
    num_words = len(mots)
    if num_words > 2:
        print("num_words est supérieur à 2")
        for collocation, score in sorted_collocations:
            nb_occurrences = sentence.count(" ".join(collocation))
            results.append({
                    "glossaire_collocation": " ".join(collocation),
                    "score": score,
                    "occurrences": nb_occurrences
                })
    else:
        print("num_words n'est pas supérieur à 2")
        results.append({
                    "glossaire_collocation": " ",
                    "score": 0,
                    "occurrences": 0
                })
    
    return jsonify(results)

@app.route('/sentenceform', methods=['POST'])
def sentenceform():
    sentences = request.json['sentence']
    if sentences is None:
        resultsact = ['0']
        resultspass = ['0']
        nbact = 0
        nbpas = 0
    else:
        print("L'élément est défini.")
        sentences_str = str(sentences)
        # text = "John shot an elephant. An elephant was shot with an arrow.The check was paid. He will be remembered. The Philippines is known for its marine biodiversity. The passive voice has a subtler tone than the active voice has. Sometimes your writing needs this tone, like when you want your reader to focus on the action being described or the action’s target rather than on who or what is performing the action."
        resultspass = []
        resultsact = []

        print(sentences)
        for sent in nlp(sentences).sents:
            # Trouver le verbe principal
            verb = None
            for token in sent:
                if token.pos_ == "VERB" and token.dep_ == "ROOT":
                    verb = token
                    break
            # Vérifier si le verbe principal est à la voix passive
            passive = False
            if verb is None:
                print("no verb")
            else:

                for child in verb.children:
                    if child.dep_ == "auxpass":
                        passive = True
                        break
                # Marquer la phrase comme active ou passive
                if passive:
                    resulted = sent.text
                    resultspass.append(resulted)
                else:
                    result = sent.text
                    resultsact.append(result)
            
        nbact = len(resultsact)
        nbpas = len(resultspass)
        if not resultsact:
            resultsact = ['0']
            nbact = 0
        if not resultspass:
            resultspass = ['0']
            nbpas = 0
    return jsonify({"phrase_passive": resultspass, "phrase_active": resultsact,'stats_nbpass' : nbpas,'stats_nbact' : nbact})
@app.route('/listconcord', methods=['POST'])
def listconcord():
    sentences = request.json['sentence']
    # Traiter la phrase avec Spacy
    doc = nlp(sentences)
    # Mot ou expression à rechercher
    target_word = request.json['word']
    # Liste pour stocker les concordances
    concordances = []
    # Parcourir les tokens du document
    for token in doc:
        # Vérifier si le token correspond à la cible
        if token.text == target_word:
            # Récupérer la phrase contenant le token
            sentence_containing_concordance = token.sent
            # Ajouter la concordance à la liste
            concordances.append(' '.join([token.text for token in sentence_containing_concordance]))
    # Convertir la liste en un tableau (array) NumPy
    concordances_array = set(np.array(concordances))
    list_concord = list(concordances_array)
    # Afficher le tableau
    print(concordances_array)
    return jsonify({'list_concord':list_concord})





if __name__ == '__main__':
     app.run(host='146.59.159.57',port='5053')
