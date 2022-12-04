let success = document.getElementById('success_info')

success_affichage();

function success_affichage() {
    setTimeout(() => {success.classList.add('dispa')}, 3000);

    setTimeout(() => {success.remove()}, 4000);
}