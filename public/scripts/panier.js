liste = document.cookie //recupere le cookie  sous forme de chaine de caractere
if (liste != "") montab = JSON.parse(liste) // transforme la chaine  en tableau JSON
else montab = Array() // si il n'y a pas de tableau dans le cookie alors créer le tableau
console.log(montab)

document.getElementById('liste').value = JSON.stringify(montab);

var totalgeneral = 0
montab.forEach(elem => {

    html = `<tr id="${elem.id}">
    <td>${elem.article}</td>
    <td><button class="moins">-</button><span>${elem.quantite}</span><button class="plus">+</button></td>
    <td ><span class="unitaire">${elem.prix}</span>€</td>
    <td><span class="prix">${elem.quantite * elem.prix}</span>€</td>
    </tr>`;

    document.getElementById('zone').innerHTML += html
    totalgeneral += elem.prix * elem.quantite
})
document.getElementById('total').innerHTML = totalgeneral;

document.querySelectorAll('.plus').forEach(clickplus)
function clickplus(tag) {
    tag.addEventListener('click', function () {
        qte = this.parentNode.querySelector('span').innerHTML;
        qte++;
        this.parentNode.querySelector('span').innerHTML = qte;

        prix = this.parentNode.parentNode.querySelector('.unitaire').innerHTML;
        total = prix * qte;
        this.parentNode.parentNode.querySelector('.prix').innerHTML = total;

        id = this.parentNode.parentNode.id; // recupere l'id de l'article cliqué
        index = montab.findIndex(element => element.id == id); //trouver l'article dans la liste du panier
        montab[index].quantite = parseInt(montab[index].quantite) + 1; //incrementer la quantité
        document.cookie = JSON.stringify(montab);  // sauvegarde des infos dans le cookie "liste"
        document.getElementById('liste').value = JSON.stringify(montab); // sauver montab pour le formulaire


        totalgeneral += 1 * prix
        document.querySelector('#total').innerHTML = totalgeneral
    })
};

document.querySelectorAll('.moins').forEach(clickmoins)
function clickmoins(tag) {
    tag.addEventListener('click', function () {
        qte = this.parentNode.querySelector('span').innerHTML;
        qte--;
        this.parentNode.querySelector('span').innerHTML = qte;

        prix = this.parentNode.parentNode.querySelector('.unitaire').innerHTML;
        total = prix * qte;
        this.parentNode.parentNode.querySelector('.prix').innerHTML = total;

        id = this.parentNode.parentNode.id; // recupere l'id de l'article cliqué
        index = montab.findIndex(element => element.id == id); //trouver l'article dans la liste du panier
        montab[index].quantite = parseInt(montab[index].quantite) - 1; //incrementer la quantité
        document.cookie = JSON.stringify(montab);  // sauvegarde des infos dans le cookie "liste"
        document.getElementById('liste').value = JSON.stringify(montab); // sauver montab pour le formulaire


        totalgeneral -= 1*prix
        document.querySelector('#total').innerHTML=totalgeneral
    })
};