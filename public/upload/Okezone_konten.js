title = document.getElementsByClassName("title")[0];
title = title.getElementsByTagName("h1")[0].innerHTML;
let read_time = document.getElementsByClassName("reporter")[0].getElementsByTagName("b")[0].innerHTML;
console.clear();
let photo = document.getElementById("imgCheck");

let photo_src = photo.getAttribute("data-cfsrc");
let photo_detail = photo.nextElementSibling.nextElementSibling.innerHTML;

let read_content = document.getElementById("contentx");
let paragraph_article = read_content.getElementsByTagName("p");
let article_text = "";
for (i = 0; i < paragraph_article.length; i++) {
  if (paragraph_article[i].id == "rctiplus" || (paragraph_article[i].getElementsByTagName("strong").length > 0 && i > 0)) continue;
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
// document.body.innerHTML = JSON.stringify(data);
document.body.append(form);
form.submit();
