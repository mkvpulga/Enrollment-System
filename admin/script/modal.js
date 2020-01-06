var foc = document.getElementById('UserName');
var btn = document.getElementById('BtnLogin');
var modal = document.getElementById('Modal');
var closebtn = document.getElementById('BtnCancel');

btn.onclick = function() {
	modal.style.display = "block";
	foc.focus();
}

closebtn.onclick = function() {
	modal.style.display = "none";
}