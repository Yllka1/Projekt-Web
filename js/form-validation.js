// Deklarimi i variablave per validim
let register_now = document.getElementById('register_now')
let name = document.getElementById('name')
let email = document.getElementById('email')
let password = document.getElementById('password')
let confirm_password = document.getElementById('confirm_password')
let choose = document.getElementById('choose')


register_now.addEventListener('click', () => {
    
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

    if(password.value === '') {
        confirm_password.style.border = '2px solid red'
        confirm_password.style.background = '#e9938d'
    } else if(password.value.length < 8) {
        confirm_password.style.border = '2px solid red'
        confirm_password.style.background = '#e9938d'
    } else if(confirm_password.value === password.value) {
        confirm_password.style.border = '2px solid green'
        confirm_password.style.background = 'transparent'
    } else {
        confirm_password.style.border = '2px solid red'
        confirm_password.style.background = '#e9938d'
    }

    // validate select/otpion
    if(choose.value === '') {
        choose.style.border = '2px solid red'
        choose.style.background = '#e9938d'
    } else {
        choose.style.border = '2px solid green'
        choose.style.background = 'transparent'
    }

})

// Regular expressions(regex), eshte nje sekuence karakteresh qe formon nje model kerkimi(paterne). Per ket arsyje e kemi quajtur konstanten keshtu.
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
