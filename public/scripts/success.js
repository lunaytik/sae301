let success = document.getElementById('success_info')

success_affichage();

function success_affichage() {
    setTimeout(() => {success.classList.add('dispa')}, 3000);

    setTimeout(() => {success.remove()}, 4000);
}

let error = document.getElementById('error_info')

error_affichage();

function error_affichage() {
    setTimeout(() => {error.classList.add('dispa')}, 3000);

    setTimeout(() => {error.remove()}, 4000);
}