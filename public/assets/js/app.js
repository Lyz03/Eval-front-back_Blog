// menu : responsive
const menuSpan = document.querySelector('span.menu');
const menuDiv = document.querySelector('div.menu');
let a = 0;

if (menuSpan) {

    menuSpan.addEventListener('click', () => {

        if (a === 0) {
            menuDiv.style.display = 'block';
            a++
        } else if (a === 1) {
            menuDiv.style.display = 'none';
            a--
        }

    })
}

// connection page : register display block
const connectionForm = document.querySelector('#connection');
const registerForm = document.querySelector('#register');
const createAccountSpan = document.querySelector('span.createAccount');
const createAccountP = document.querySelector('p.createAccount');


if (createAccountSpan) {
    createAccountSpan.addEventListener('click', () => {

        registerForm.style.display = 'block';
        connectionForm.style.display = 'none';
        createAccountP.style.display = 'none';

    })
}

// error message
const errorMessages = document.querySelectorAll('.error')

if (errorMessages) {
    setTimeout(() => {
       errorMessages.forEach(value => value.remove());
    }, 4000);
}



// FORM
document.querySelectorAll('input[type=submit]').forEach(value => {
    value.addEventListener('click', function () {
        checkForm();
    })
})

function checkForm() {
    // textarea
    if (document.querySelector('textarea')) {
        // comment
        if (document.querySelectorAll('textarea.comment')) {
            document.querySelectorAll('textarea.comment').forEach(comment => {
                if (comment.value.length < 5 || comment.value.length > 255) {
                    comment.setCustomValidity('Votre commentaire doit faire entre 5 et 255 caractères');
                } else {
                    comment.setCustomValidity('');
                }
            })

        }

        // article
        if (document.querySelector('textarea.article')) {
            let article = document.querySelector('textarea.article');
            if (article.value.length < 100) {
                article.setCustomValidity('l\'article doit faire au moins 100 caractères');
            } else {
                article.setCustomValidity('');
            }
        }
    }

    // input type text
    if (document.querySelector('input[type=text]')) {
        // title
        if (document.querySelector('input[type=text].title')) {
            let comment = document.querySelector('input[type=text].title');
            if (comment.value.length < 5 || comment.value.length > 255) {
                comment.setCustomValidity('Le titre doit faire entre 5 et 255 caractères');
            } else {
                comment.setCustomValidity('');
            }
        }
        // username
        if (document.querySelector('input[type=text].username')) {
            let comment = document.querySelector('input[type=text].username');
            if (comment.value.length < 8 || comment.value.length > 100) {
                comment.setCustomValidity('le pseudo doit faire entre 8 et 100 caractères');
            } else {
                comment.setCustomValidity('');
            }
        }
    }

    // input type mail
    if (document.querySelectorAll('input[type=email]')) {
        document.querySelectorAll('input[type=email]').forEach(mail => {
            if (mail.value.length < 8 || mail.value.length > 150) {
                mail.setCustomValidity('l\'adresse email doit faire entre 8 et 150 caractères');
            } else {
                mail.setCustomValidity('');
            }
        })
    }

    // input type password
    if (document.querySelectorAll('input[type=password]')) {
        let paterne = new RegExp(/^(?=.*[!@#$%^&*-\\])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/);

        document.querySelectorAll('input[type=password]').forEach(password => {
            if (password.value.length < 8) {
                password.setCustomValidity("le mot de passe doit faire entre 8 caractères");
            } else {
                password.setCustomValidity('');
            }

            if (!paterne.test(password.value)) {
                password.setCustomValidity("Le mot de passe n'est pas assez sécurisé");
            } else {
                password.setCustomValidity('');
            }
        })
    }
}