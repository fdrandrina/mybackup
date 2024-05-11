import spacy

# Charger le modèle linguistique en anglais de Spacy
nlp = spacy.load('en_core_web_sm')

# Phrase d'exemple
sentence = "New images of prototypes were quite impressive. Tesla gave an update on its humanoid robot program, which is known as Tesla Bot or Optimus.Making the project look less like a sideshow and increasingly like a potentially real product. When Elon Musk first announced the Tesla Bot, many laughed it off as a sideshow or distraction to Tesla’s more important mission to accelerate the advent of sustainable energy. Tesla had a very early prototype that didn’t look like much. The problem is people have issues seeing Tesla making it a reality"

# Traiter la phrase avec Spacy
doc = nlp(sentence)

# Mot ou expression à rechercher
target_word = "Tesla"

# Parcourir les tokens du document
for token in doc:
    # Vérifier si le token correspond à la cible
    if token.text == target_word:
        # Récupérer la phrase contenant le token
        sentence_containing_concordance = token.sent

        # Afficher la concordance et la phrase complète
        concordance = ' '.join([token.text for token in sentence_containing_concordance])
        print('concordance',concordance)
#         concordances = [
#     "Concordance: Tesla gave an update on its humanoid robot program, which is known as Tesla Bot or Optimus.",
#     "Concordance: Tesla gave an update on its humanoid robot program, which is known as Tesla Bot or Optimus.",
#     "Concordance: When Elon Musk first announced the Tesla Bot, many laughed it off as a sideshow or distraction to Tesla’s more important mission to accelerate the advent of sustainable energy.",
#     "Concordance: When Elon Musk first announced the Tesla Bot, many laughed it off as a sideshow or distraction to Tesla’s more important mission to accelerate the advent of sustainable energy.",
#     "Concordance: Tesla had a very early prototype that didn’t look like much.",
#     "Concordance: The problem is people have issues seeing Tesla making it a reality."
# ]

# filtered_concordances = []

# for concordance in concordances:
#     if concordance not in filtered_concordances:
#         filtered_concordances.append(concordance)

# # Afficher les phrases uniques
# for concordance in filtered_concordances:
#     print(concordance)
