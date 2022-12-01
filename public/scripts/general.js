panier_liste = document.cookie;

// js de la nav3
const navMenu = document.querySelector(".nav2");
navToggle = document.querySelector(".burger");
if(navToggle)
{
    navToggle.addEventListener("click", () =>
    {
        navMenu.classList.toggle("active");
    })
}

if (panier_liste.length!=0) {
    var panier_liste = document.cookie.split(";");

    if (panier_liste.length > 1) {
        panier_liste = panier_liste.splice(-1, 1);
        panier_liste.join();
    }
    panier_tab = JSON.parse(panier_liste);
}
else { panier_tab = Array(); }
console.log(panier_tab);

const panier_display = document.getElementById('panier_nombre');

var panier_val = 0;
panier_tab.forEach(element => {
    panier_val += parseInt(element.quantite);
    panier_display.innerText = panier_val;
});
