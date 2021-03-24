if(document.getElementById('btnAdd')){
  document.getElementById('btnAdd').onclick = function() {
    document.getElementsByClassName('modal')[0].style.display = "block";
  }
}
if(document.getElementById('btnCloseModal')){
  document.getElementById('btnCloseModal').onclick = function() {
    document.getElementsByClassName('modal')[0].style.display = "none";
  }
}

window.onclick = function(event) {
  if(document.getElementsByClassName('modal')[0]){
    if (event.target == document.getElementsByClassName('modal')[0]) {
      document.getElementsByClassName('modal')[0].style.display = "none";
    }
  }
}

if(document.getElementById('closeAlert')){
  document.getElementById('closeAlert').onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}