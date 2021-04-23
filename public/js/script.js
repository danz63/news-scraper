if (document.getElementById("btnAdd")) {
  document.getElementById("btnAdd").onclick = function () {
    document.getElementsByClassName("modal")[0].style.display = "block";
  };
}

window.onclick = function (event) {
  if (document.getElementsByClassName("modal")[0]) {
    if (event.target == document.getElementsByClassName("modal")[0]) {
      document.getElementsByClassName("modal")[0].style.display = "none";
    }
  }
};

if (document.getElementById("closeAlert")) {
  document.getElementById("closeAlert").onclick = function () {
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function () {
      div.style.display = "none";
    }, 600);
  };
}

function ajax(url) {
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        document.getElementsByClassName("modal")[0].innerHTML = xhr.responseText;
        document.getElementsByClassName("modal")[0].style.display = "block";
      } else {
        console.log(xhr);
      }
    }
  };
  xhr.open("get", url);
  xhr.send();
}

function closeModal() {
  document.getElementsByClassName("modal")[0].style.display = "none";
}
