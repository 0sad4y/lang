from bs4 import BeautifulSoup
import requests
import re


def get_urls(posts_per_page=1, page=0) -> list:
    url = f'https://vlg-media.ru/wp-admin/admin-ajax.php?id=&post_id=0&slug=home&canonical_url=/\
        &posts_per_page={posts_per_page}\
        &page={page}\
        &offset=21&post_type=post&repeater=template_1&seo_start_page=1&preloaded=false&preloaded_amount=0&order=DESC\
        &orderby=date&action=alm_get_posts&query_type=standard'

    resp = requests.get(url).json()['html']
    soup = BeautifulSoup(resp, 'html.parser')
    soup = soup.findAll('a')
    urls = [u.get('href') for u in soup if re.fullmatch(r'https://vlg-media\.ru/\d{4}/\d{2}/\d{2}/.*', u.get('href'))]

    return urls


def get_data(url: str) -> dict:
    resp = requests.get(url).text
    soup = BeautifulSoup(resp, 'html.parser')
    soup = soup.find('main')

    title = soup.find('header').find('h1').text
    date = soup.find('header').find('time').get('datetime')
    text = soup.find('header').find('p').text + ' '
    parts = soup.find('div', {'class', 'entry-content'}).findAll('p')
    main_text = [part.text for part in parts \
                 if part.text is not None \
                 and (not re.fullmatch(r'Волгоградская\sобласть,\s\d{1,2}\s.*\s\d{4}\s/\s.*', part.text) or\
                      not re.fullmatch(r'Волгоград,\s\d{1,2}\s.*\s\d{4}\s/\s.*', part.text))]
    text += ' '.join(main_text)

    res = {
        'url': url,
        'title': title,
        'date': date,
        'text': text,
    }

    return res
