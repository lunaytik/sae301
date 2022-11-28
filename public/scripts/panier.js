panier_content = document.cookie; //recupere le cookie  sous forme de chaine de caractere
if (panier_content.length!=0)panier = JSON.parse(panier_content); // transforme la chaine  en tableau JSON
else panier = Array(); // si il n'y a pas de tableau dans le cookie alors créer le tableau
console.log(panier);

const panierNb = document.getElementById('panier_nombre');
console.log(panierNb)

var panier_val = 0;
panier.forEach(element => {
    panier_val += parseInt(element.quantite);
    panierNb.innerText = panier_val;
});