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

function ajax(url, respon, method = "get", data = "") {
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        respon(xhr);
      }
    }
  };
  if (method == "get") {
    xhr.open("get", url, true);
    xhr.send();
  } else {
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("links=" + data);
  }
}

function closeModal() {
  document.getElementsByClassName("modal")[0].style.display = "none";
}
