import pymysql
from natasha import (
    Segmenter,
    MorphVocab,

    NewsEmbedding,
    NewsMorphTagger,
    NewsSyntaxParser,
    NewsNERTagger,

    LOC,
    NamesExtractor,

    Doc
)


def main():
    segmenter = Segmenter()
    morph_vocab = MorphVocab()

    emb = NewsEmbedding()
    ner_tagger = NewsNERTagger(emb)

    names_extractor = NamesExtractor(morph_vocab)

    db = pymysql.connect(host="localhost", user="root", password="", database="lang", autocommit=True)
    cursor = db.cursor()

    cursor.execute("SELECT id, text FROM sentences")
    sentences = cursor.fetchall()

    for sentence in sentences:
        doc = Doc(sentence[1])

        doc.segment(segmenter)
        doc.tag_ner(ner_tagger)

        for span in doc.spans:
            span.normalize(morph_vocab)

        for span in doc.spans:
            if span.type == LOC:
                span.extract_fact(names_extractor)

        locations = [span.normal for span in doc.spans if span.type == LOC]

        if len(locations) > 0:
            for location in locations:
                cursor.execute(f"SELECT id FROM attractions WHERE name = '{location}'")
                index = cursor.fetchone()
                if not index:
                    cursor.execute(f"INSERT INTO attractions (name) VALUE ('{location}')")
                    cursor.execute(f"SELECT id FROM attractions WHERE name = '{location}'")
                    index = cursor.fetchone()
                cursor.execute(f"INSERT INTO attrtosent (idsent, idattr) VALUE ('{sentence[0]}', '{index[0]}')")


if __name__ == '__main__':
    main()
