let title = document.getElementsByClassName("read__title");
title = title[0].innerHTML;
let read_time = document.getElementsByClassName("read__info__date");
read_time = "pikiran-rakyat.com" + read_time[0].innerHTML;
let photo = document.getElementsByClassName("photo")[0];
let photo_src = photo.getElementsByTagName("img")[0].getAttribute("src");
let photo_detail = photo.getElementsByClassName("photo__caption")[0].innerHTML.trim();
let read_content = document.getElementsByClassName("read__content")[0];
let paragraph_article = read_content.getElementsByTagName("p");
let article_text = "";
for (i = 0; i < paragraph_article.length; i++) {
  if (paragraph_article[i].querySelectorAll("strong").length > 0 && (i > 2 || i < 1)) {
    continue;
  }
  var tmp = paragraph_article[i].innerHTML;
  article_text += tmp;
}
delete paragraph_article;
delete photo;
delete read_content;

let data = {
  title,
  read_time,
  photo_src,
  photo_detail,
  article_text: `${article_text}`,
};
let form = document.createElement("form");
form.setAttribute("method", "POST");
form.setAttribute("action", "");
let input = document.createElement("input");
input.setAttribute("type", "hidden");
input.setAttribute("name", "json");
input.setAttribute("value", JSON.stringify(data));
form.append(input);
document.body.innerHTML = "";
document.body.append(form);
form.submit();
