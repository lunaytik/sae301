document.getElementById('panier_liste').value = JSON.stringify(panier_tab);

var totalgeneral = 0
panier_tab.forEach(elem => {
    html = `<tr id="${elem.id}">
    <td>${elem.nom}</td>
    <td><button class="moins">-</button><span>${elem.quantite}</span><button class="plus">+</button></td>
    <td ><span class="unitaire">${elem.prix}</span>€</td>
    <td><span class="prix">${elem.quantite * elem.prix}</span>€</td>
    </tr>`;

    document.getElementById('zone').innerHTML += html
    totalgeneral += elem.prix * elem.quantite
})
document.getElementById('total').innerHTML = totalgeneral;

