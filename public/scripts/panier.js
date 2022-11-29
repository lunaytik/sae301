document.getElementById('liste').value = JSON.stringify(panier_tab);

var totalgeneral = 0
panier_tab.forEach(evenement => {
    html = `
        <div class="panier_box">
            <div class="panier_gauche"><img class="test" src="${evenement.img}" alt="Image de ${evenement.nom}"></div>
            <div class="panier_droite">
                <h1>${evenement.nom}</h1>
                <div class="panier_date">
                    <p>${evenement.date}</p>
                    <p>????</p>
                </div>
                <div class="panier_lieu">
                    <div>
                        <i class="fa-solid fa-location-dot"></i>
                        <p>Centre des lumières</p>
                    </div>
                    <p>11 Rue Aimé Collomb, 69003 Lyon, France</p>
                </div>
                <div class="panier_nb_prix">
                    <div class="selecteur_nb">
                        <button class="moins">-</button>
                        <p id="event_quantite">${evenement.quantite}</p>
                        <input type="hidden" id="event_id" value="${ evenement.id }">
                        <button class="plus">+</button>
                    </div>
                    <div class="panier_prix">
                        <p class="event_prix">${evenement.prix}€</p>
                        <p class="event_prix_total"><span>${parseFloat(evenement.prix * evenement.quantite).toFixed(2)}</span>€</p>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.getElementById('panier_zone').innerHTML += html;
    totalgeneral += evenement.prix * evenement.quantite;
})

document.getElementById('total').innerHTML = parseFloat(totalgeneral).toFixed(2);


document.querySelectorAll('.plus').forEach(clickplus)
function clickplus(tag) {
    tag.addEventListener('click', function () {
        val_quantite = parseInt(this.parentNode.querySelector('#event_quantite').innerHTML);
        val_quantite++;
        panier_val++;
        panier_display.innerText = panier_val;
        this.parentNode.querySelector('#event_quantite').innerHTML = val_quantite;

        prix = this.parentNode.parentNode.parentNode.querySelector('.event_prix').innerHTML;
        total = parseFloat(prix) * val_quantite;
        this.parentNode.parentNode.parentNode.querySelector('.event_prix_total span').innerHTML = parseFloat(total).toFixed(2);

        id = this.parentNode.querySelector('#event_id').value;
        index = panier_tab.findIndex(element => element.id == id);
        panier_tab[index].quantite = parseInt(panier_tab[index].quantite) + 1;
        document.cookie = JSON.stringify(panier_tab);
        document.cookie += ';path=/'
        document.getElementById('liste').value = JSON.stringify(panier_tab);

        totalgeneral += 1 * parseFloat(prix);
        document.getElementById('total').innerHTML = parseFloat(totalgeneral).toFixed(2);
    })
};

document.querySelectorAll('.moins').forEach(clickmoins)
function clickmoins(tag) {
    tag.addEventListener('click', function () {
        val_quantite = parseInt(this.parentNode.querySelector('#event_quantite').innerHTML);
        val_quantite--;
        panier_val--;
        panier_display.innerText = panier_val;
        this.parentNode.querySelector('#event_quantite').innerHTML = val_quantite;

        prix = this.parentNode.parentNode.parentNode.querySelector('.event_prix').innerHTML;
        total = parseFloat(prix) * val_quantite;
        this.parentNode.parentNode.parentNode.querySelector('.event_prix_total span').innerHTML = parseFloat(total).toFixed(2);

        totalgeneral -= 1 * parseFloat(prix);
        document.getElementById('total').innerHTML = parseFloat(totalgeneral).toFixed(2);

        totalgeneral = -0 ? totalgeneral = 0 : totalgeneral = totalgeneral;

        id = this.parentNode.querySelector('#event_id').value;
        if (val_quantite == 0) {
            console.log('debut suppr')
            index = panier_tab.findIndex(element => element.id == id);
            console.log(index)
            if(index > -1) {
                console.log("supression");
                panier_tab.splice(index, 1);
                document.cookie = JSON.stringify(panier_tab);
                document.cookie += ';path=/'
                document.getElementById('liste').value = JSON.stringify(panier_tab);


                this.parentNode.parentNode.parentNode.parentNode.remove();
            }
        } else {
            index = panier_tab.findIndex(element => element.id == id);
            panier_tab[index].quantite = parseInt(panier_tab[index].quantite) - 1;
            document.cookie = JSON.stringify(panier_tab);
            document.cookie += ';path=/'
            document.getElementById('liste').value = JSON.stringify(panier_tab);
        }
    })
};
