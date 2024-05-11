import spacy

# Charger le modèle de langue anglais de spaCy
nlp = spacy.load("en_core_web_sm")

# Exemple de texte à analyser
text = "John shot an elephant. An elephant was shot with an arrow.The check was paid. He will be remembered. The Philippines is known for its marine biodiversity. The passive voice has a subtler tone than the active voice has. Sometimes your writing needs this tone, like when you want your reader to focus on the action being described or the action’s target rather than on who or what is performing the action."

# Diviser le texte en phrases et analyser chaque phrase
for sent in nlp(text).sents:
    # Trouver le verbe principal
    verb = None
    for token in sent:
        if token.pos_ == "VERB" and token.dep_ == "ROOT":
            verb = token
            break

    # Vérifier si le verbe principal est à la voix passive
    passive = False
    for child in verb.children:
        if child.dep_ == "auxpass":
            passive = True
            break

    # Marquer la phrase comme active ou passive
    if passive:
        print(sent.text, "is passive.")
