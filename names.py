import pymysql
from natasha import (
    Segmenter,
    MorphVocab,

    NewsEmbedding,
    NewsMorphTagger,
    NewsSyntaxParser,
    NewsNERTagger,

    PER,
    NamesExtractor,

    Doc
)


def main():
    segmenter = Segmenter()
    morph_vocab = MorphVocab()

    emb = NewsEmbedding()
    ner_tagger = NewsNERTagger(emb)

    names_extractor = NamesExtractor(morph_vocab)

    #Подключение к бд
    db = pymysql.connect(host="localhost", user="root", password="", database="lang", autocommit=True)
    cursor = db.cursor()

    #Запрос всех предложений
    cursor.execute("SELECT id, text FROM sentences")
    sentences = cursor.fetchall()

    #Цикл по предложениям
    for sentence in sentences:
        doc = Doc(sentence[1])

        doc.segment(segmenter)
        doc.tag_ner(ner_tagger)

        for span in doc.spans:
            span.normalize(morph_vocab)

        for span in doc.spans:
            if span.type == PER:
                span.extract_fact(names_extractor)

        #Сборка имен в массив
        names = [span.normal for span in doc.spans if span.type == PER]

        #При наличии имен
        if len(names) > 0:
            #Цикл по именам
            for name in names:
                #Запрос id имени
                cursor.execute(f"SELECT id FROM names WHERE name = '{name}'")
                index = cursor.fetchone()
                #При отсутствии имени в бд
                if not index:
                    #Запрос для добавления имени в бд
                    cursor.execute(f"INSERT INTO names (name) VALUE ('{name}')")
                    #Запрос id имени
                    cursor.execute(f"SELECT id FROM names WHERE name = '{name}'")
                    index = cursor.fetchone()
                #Добавление связи с предложением
                cursor.execute(f"INSERT INTO nametosent (idsent, idname) VALUE ('{sentence[0]}', '{index[0]}')")


if __name__ == '__main__':
    main()
