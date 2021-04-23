let title = document.getElementsByClassName('read__title');
title = title[0].innerHTML;
let read_time = document.getElementsByClassName('read__time');
read_time = read_time[0].innerHTML;
let photo = document.getElementsByClassName('photo')[0];
let photo_src = photo.getElementsByTagName('img')[0].getAttribute('src');
let photo_detail = photo.getElementsByTagName('span')[0].innerHTML;
let read_content = document.getElementsByClassName('read__content')[0];
let paragraph_article = read_content.getElementsByTagName('p');
let article_text = '';
for (i = 0; i < paragraph_article.length; i++) {
    if (paragraph_article[i].querySelectorAll('strong').length > 0 && i > 0) {
        continue;
    }
    article_text += paragraph_article[i].outerHTML;
}
delete paragraph_article;
delete photo;
delete read_content;

let data = {
    title, read_time, photo_src, photo_detail, article_text : `${article_text}`
};
document.body.innerHTML = JSON.stringify(data);