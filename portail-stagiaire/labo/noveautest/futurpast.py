import spacy

nlp = spacy.load("en_core_web_sm")

def extract_verb_tenses(text):
    doc = nlp(text)
    present_verbs = []
    future_verbs = []
    past_verbs = []

    for token in doc:
        if token.pos_ == 'VERB':
            if token.morph.get('Tense') == 'Pres':
                present_verbs.append(token.lemma_)
            elif token.morph.get('Tense') == 'Fut':
                future_verbs.append(token.lemma_)
            elif token.morph.get('Tense') == 'Past':
                past_verbs.append(token.lemma_)

    return present_verbs, future_verbs, past_verbs

# Exemple d'utilisation
text = "It is an honor to stand before you today and share my thoughts on the future, a future that holds immense possibilities for all of humanity. I want to begin by expressing my gratitude to each and every one of you who has supported me and my endeavors thus far. It is because of your unwavering support that we have achieved remarkable milestones and set new benchmarks in various industries."
present, future, past = extract_verb_tenses(text)
print("Présent:", present)
print("Futur:", future)
print("Passé:", past)
