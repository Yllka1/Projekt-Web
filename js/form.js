// Page three - Contact

// Deklarimi i variablave
let signinbtn = document.getElementById("signinbtn")
let signupbtn = document.getElementById("signupbtn")
let nameField = document.getElementById("nameField")
let title = document.getElementById("title")

signinbtn.onclick = function (){
    nameField.style.maxHeight= "0";
    nameField.style.border = "none";
    title.innerHTML = "Sign in";
}

signupbtn.onclick = function (){
    nameField.style.maxHeight = "60px";
    nameField.style.border = "1px solid black";
    title.innerHTML = "Sign Up";
}


// Deklarimi i variablave per validim
let name = document.getElementById('name')
let email = document.getElementById('email')
let phone = document.getElementById('password')


signupbtn.addEventListener('click', (e) => {
    e.preventDefault()
    
    // validate name
    if(validateName(name.value)) {
        name.style.border = '2px solid red'
        name.style.background = '#e9938d'
    } else {
        name.style.border = '2px solid green'
        name.style.background = 'transparent'
    }

    // validate email
    if(validateEmail(email.value)) {
        email.style.border = '2px solid red'
        email.style.background = '#e9938d'
    } else {
        email.style.border = '2px solid green'
        email.style.background = 'transparent'
    }

    // validate password
    if(validatePassword(password.value)) {
        password.style.border = '2px solid red'
        password.style.background = '#e9938d'
    } else {
        password.style.border = '2px solid green'
        password.style.background = 'transparent'
    }
})

signinbtn.addEventListener('click', (e) => {
    e.preventDefault()

    // validate email
    if(validateEmail(email.value)) {
        email.style.border = '2px solid red'
        email.style.background = '#e9938d'
    } else {
        email.style.border = '2px solid green'
        email.style.background = 'transparent'
    }

    // validate password
    if(validatePassword(password.value)) {
        password.style.border = '2px solid red'
        password.style.background = '#e9938d'
    } else {
        password.style.border = '2px solid green'
        password.style.background = 'transparent'
    }

})


function validateName(name) {
    const regex = /[a-zA-Z]{2}/g
    return name.match(regex) === null
}

function validateEmail(email) {
    const regex = /[a-zA-Z0-9\.\_\-]+\@[a-z]+\.[a-z]{3}/g
    return email.match(regex) === null
}

function validatePassword(password) {
    const regex = /[a-zA-Z0-9\.]{8}/g
    return password.match(regex) === null
}