import spacy

# Charger le modèle linguistique en anglais de Spacy
nlp = spacy.load('en_core_web_sm')

# Phrase d'exemple
sentence = "New images of prototypes were quite impressive. Tesla gave an update on its humanoid robot program, which is known as Tesla Bot or Optimus.Making the project look less like a sideshow and increasingly like a potentially real product. When Elon Musk first announced the Tesla Bot, many laughed it off as a sideshow or distraction to Tesla’s more important mission to accelerate the advent of sustainable energy."

# Traiter la phrase avec Spacy
doc = nlp(sentence)

# Mot ou expression à rechercher
target_word = "Tesla"

# Parcourir les tokens du document
for token in doc:
    # Vérifier si le token correspond à la cible
    if token.text == target_word:
        # Récupérer le contexte du token (5 mots précédents et 5 mots suivants)
        start_index = max(token.i - 5, 0)
        end_index = min(token.i + 6, len(doc))
        context = doc[start_index:end_index]

        # Afficher le concordancement
        concordance = ' '.join([token.text for token in context])
        print(concordance)
