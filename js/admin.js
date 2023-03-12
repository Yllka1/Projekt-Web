// Deklarimi i variablave kyqe

let navbar = document.querySelector('ul')
let accountBox = document.querySelector('header .account-box')

document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active')
    user_box.classList.remove('active')
}

document.querySelector('#user-btn').onclick = () => {
    accountBox.classList.toggle('active')
    navbar.classList.remove('active')
}

window.onscroll = () => {
    navbar.classList.remove('active')
    accountBox.classList.remove('active')
}

// Vendi i perdorimit admin_sale.php
document.querySelector('#close-update').onclick = () => {
    document.querySelector('.edit__product_form').style.display = 'none'
    window.location.href = 'admin_sale.php';
}