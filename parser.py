import pymysql
from time import sleep
from page_parser import get_urls, get_data


if __name__ == '__main__':
    posts_per_page = 1000
    page_count = 1

    db = pymysql.connect(host="localhost", user="root", password="", database="lang", autocommit=True)
    cursor = db.cursor()

    for page in range(page_count):
        urls = get_urls(posts_per_page, page)
        for url in urls:
            print(url)
            data = get_data(url)
            insert_query = 'INSERT INTO news (title, url, date, text) VALUE (%s, %s, %s, %s)'
            insert_args = (data['title'], data['url'], data['date'], data['text'])
            cursor.execute(insert_query, insert_args)

            index_query = 'SELECT id FROM news WHERE url = %s'
            index_args = (data['url'],)
            cursor.execute(index_query, index_args)
            index = cursor.fetchone()

            sentences = data['text'].split('. ')
            sentences += data['title'].split('. ')
            sentence_query = 'INSERT INTO sentences (text, idnews) VALUE (%s, %s)'
            for sentence in sentences:
                sentence_args = (sentence, index)
                cursor.execute(sentence_query, sentence_args)

        sleep(1.0)
