panier_liste = document.cookie;

if (panier_liste.length!=0) {
    var panier_liste = document.cookie.split(";");

    if (panier_liste.length == 2) {
        panier_liste.shift();
        panier_liste.join()
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