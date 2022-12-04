let event_quantite = document.getElementById("event_quantite")
let popup_prix = document.getElementById('event_prix')


let popup = document.getElementsByClassName('popup')

function popup_affichage() {
    //console.log("popup intervention");
    document.getElementById('popup_nb').innerHTML = "x" + event_quantite.value;
    document.getElementById('popup_prix').innerHTML = 1 * popup_prix.innerHTML * event_quantite.value + '€';
    document.getElementsByClassName('popup')[0].style.display = "flex"
    document.getElementsByClassName('popup')[0].style.opacity = "1"

    setTimeout(() => {document.getElementsByClassName('popup')[0].style.opacity = "0";}, 3000);
    setTimeout(() => {document.getElementsByClassName('popup')[0].style.display = "none" }, 3200);
}