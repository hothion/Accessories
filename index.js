document.getElementById("login-form").style.display = "none";
document.getElementById("register-form").style.display = "none";
document.getElementById("edit-form").style.display = "none";

function onLoginClicked(){
	document.getElementById("login-form").style.display = "block";
}


function onRegisterClicked(){
    alert("Register");
	document.getElementById("register-form").style.display = "block";
}


function onEditClicked(){
    alert("Edit");
    document.getElementById("login-form").style.display = "none";
    document.getElementById("register-form").style.display = "none";
    document.getElementById("edit-form").style.display = "block";
}
