import spacy as sp
import json

nlp = sp.load("en_core_web_sm")

def extract_verb_tenses(text):
    doc = nlp(text)
    verb_tenses = []

    for token in doc:
        if token.pos_ == 'VERB':
            verb_tenses.append((token.lemma_, token.tag_))

    return verb_tenses
# text = "When Barack Obama was elected president in 2008, he became the first African American to hold the office. The framers of the Constitution always hoped that our leadership would not be limited to Americans of wealth or family connections."
text = "it was my last solution. I did it to save you."
tenses = extract_verb_tenses(text)
# verbes = [('stand', 'VB'), ('share', 'VB'), ('hold', 'VBZ'), ('want', 'VBP'), ('begin', 'VB'), ('express', 'VBG'), ('support', 'VBN'), ('achieve', 'VBN'), ('set', 'VBD')]

# # Créer un dictionnaire pour stocker les mots par POS
# mots_par_pos = {}

# # Parcourir la liste de tuples et regrouper les mots par POS
# for mot, pos in tenses:
#     if pos in mots_par_pos:
#         mots_par_pos[pos].append(mot)
#     else:
#         mots_par_pos[pos] = [mot]

# # Afficher les mots par POS
# for pos, mots in mots_par_pos.items():
#     print(f"Mots avec POS '{pos}':")
#     for mot in mots:
#         print(mot)
#     print()



# verbes = [('stand', 'VB'), ('share', 'VB'), ('hold', 'VBZ'), ('want', 'VBP'), ('begin', 'VB'), ('express', 'VBG'), ('support', 'VBN'), ('achieve', 'VBN'), ('set', 'VBD')]

# Créer un dictionnaire pour stocker les mots par POS
mots_par_pos = {}

# Parcourir la liste de tuples et regrouper les mots par POS
for mot, pos in tenses:
    if pos in mots_par_pos:
        mots_par_pos[pos].append(mot)
    else:
        mots_par_pos[pos] = [mot]

# Convertir le dictionnaire en JSON
resultat_json = json.dumps(mots_par_pos, indent=4)

# Afficher le résultat JSON
print(resultat_json)