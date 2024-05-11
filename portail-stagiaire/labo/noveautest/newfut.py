import spacy

nlp = spacy.load('en_core_web_sm')

def extract_verb_tenses(text):
    doc = nlp(text)
    present_verbs = []
    past_verbs = []

    for token in doc:
        if token.pos_ == 'VERB':
            if token.dep_ == 'ROOT':
                if token.tag_ == 'VBZ':
                    present_verbs.append(token.lemma_)
                elif token.tag_ == 'VBD':
                    past_verbs.append(token.lemma_)

    return present_verbs, past_verbs

# Example usage
text = "I have new book"
present, past = extract_verb_tenses(text)
print("Present:", present)
print("Past:", past)
