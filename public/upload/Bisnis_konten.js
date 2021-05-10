let title = document.getElementsByClassName("title-premium")[0];
title = title.innerHTML;
let read_time = document.getElementsByClassName("new-description")[0];
if (read_time.querySelectorAll("a").length > 0) {
  read_time.getElementsByTagName("a")[0].remove();
}
var tmp = "";
var str = read_time.getElementsByTagName("span");
if (str.length > 0) {
  tmp = str[0].innerHTML.trim();
  str[0].remove();
}
read_time = read_time.innerHTML;
read_time = read_time.replace("-", "").trim();
read_time = read_time + " - " + tmp;
read_time = read_time.replace(/\&nbsp;/g, "").trim();
let photo = document.getElementsByClassName("main-image")[0];
let photo_src = photo.getElementsByTagName("img")[0].getAttribute("src");
let photo_detail = photo.getElementsByClassName("caption")[0].innerHTML;

let read_content = document.getElementsByClassName("description")[0];
let paragraph_article = read_content.getElementsByTagName("p");
let article_text = "";
for (i = 0; i < paragraph_article.length; i++) {
  article_text += paragraph_article[i].outerHTML;
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
