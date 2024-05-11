import spacy

# Charger le modèle linguistique anglais
nlp = spacy.load('en_core_web_sm')

# Texte à analyser
text = "You may click to consent to our and our partners processing as described above. Alternatively you may access more detailed information and change your preferences before consenting or to refuse consenting. Please note that some processing of your personal data may not require your consent, but you have a right to object to such processing. The cake was baked by John. The movie was watched by millions of people. The building will be demolished next month. I eat rice. the big fish is catched by me. Yes there are some dads who have dropped their careers. So I think it is the right thing to do for many women, to introduce these reforms and we are introducing them as quickly as we can because we want to remove those barriers to work. The fact he mentions women is careers ending . And the way in which women are viewed by Mr Hunt and the wider society is surely one of the biggest barriers of all.""

# Analyser le texte avec le modèle
doc = nlp(text)

# Filtrer les verbes et les classer selon leur temps
past_tense = [token.lemma_ for token in doc if token.tag_ == 'VBD' or token.tag_ == 'VBN']
present_tense = [token.lemma_ for token in doc if token.tag_ == 'VBZ' or token.tag_ == 'VBP']
future_tense = [token.lemma_ for token in doc if token.tag_ == 'MD']

# Afficher les verbes trouvés classés selon leur temps
print("Past tense:", past_tense)
print("Present tense:", present_tense)
print("Future tense:", future_tense)
