// Page three - Contact

// Deklarimi i variablave
let signupbtn = document.getElementById("signupbtn")
let signinbtn = document.getElementById("signinbtn")
let nameField = document.getElementById("nameField")
let title = document.getElementById("title")

signinbtn.onclick = function (){
    nameField.style.maxHeight= "0";
    nameField.style.border = "none";
    title.innerHTML = "Sign in";
    signupbtn.classList.add("disable");
    siginpbtn.classList.remove("disable")
}

signupbtn.onclick = function (){
    nameField.style.maxHeight = "60px";
    nameField.style.border = "1px solid";
    title.innerHTML = "Sign Up";
    signupbtn.classList.remove("disable");
    siginpbtn.classList.add("disable");
}