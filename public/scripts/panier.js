    garantie = document.getElementById('garantie_total');

    if (panier_val == 0) {
        loadPanierVide();
    } else {
        document.getElementById('liste').value = JSON.stringify(panier_tab);
    }



    var totalgeneral = 0
    panier_tab.forEach(evenement => {
        date = evenement.date.split(' ')
        html = `
        <div class="panier_box">
            <div class="panier_gauche"><img class="test" src="${evenement.img}" alt="Image de ${evenement.nom}"></div>
            <div class="panier_droite">
                <h2>${evenement.nom}</h2>
                <div class="panier_date">
                    <p>${date[0]}</p>
                    <p>${date[1]}</p>
                </div>
                <div class="panier_lieu">
                    <div>
                        <i class="fa-solid fa-location-dot"></i>
                        <p>${evenement.lieu}</p>
                    </div>
                    <p>${evenement.adresse}</p>
                </div>
                <div class="panier_nb_prix">
                    <div class="selecteur_nb select_panier">
                        <button class="moins">-</button>
                        <p class="panier_quantite" id="event_quantite">${evenement.quantite}</p>
                        <input type="hidden" id="event_id" value="${ evenement.id }">
                        <button class="plus">+</button>
                    </div>
                    <div class="panier_prix">
                        <p class="event_prix hide_prix"><span>${evenement.prix}</span>€</p>
                        <p class="event_prix_total"><span>${parseFloat(evenement.prix * evenement.quantite).toFixed(2)}</span>€</p>
                    </div>
                </div>
            </div>
        </div>
    `;

        document.getElementById('panier_zone').innerHTML += html;
        totalgeneral += evenement.prix * evenement.quantite;
    })

    garantie_val =  parseFloat(panier_val * 4).toFixed(2);
    garantie.innerText = garantie_val;

    document.getElementById('total_prix').value = parseFloat(totalgeneral).toFixed(2);
    document.getElementById('total').innerHTML = parseFloat(totalgeneral).toFixed(2);

    document.querySelectorAll('.plus').forEach(clickplus)
    function clickplus(tag) {
        tag.addEventListener('click', function () {
            val_quantite = parseInt(this.parentNode.querySelector('#event_quantite').innerHTML);
            val_quantite++;
            panier_val++;
            panier_display.innerText = panier_val;
            this.parentNode.querySelector('#event_quantite').innerHTML = val_quantite;

            garantie_val = parseFloat(panier_val * 4).toFixed(2);
            garantie.innerText = garantie_val;

            prix = this.parentNode.parentNode.parentNode.querySelector('.event_prix span').innerHTML;
            total = parseFloat(prix) * val_quantite;
            this.parentNode.parentNode.parentNode.querySelector('.event_prix_total span').innerHTML = parseFloat(total).toFixed(2);

            id = this.parentNode.querySelector('#event_id').value;
            index = panier_tab.findIndex(element => element.id == id);
            panier_tab[index].quantite = parseInt(panier_tab[index].quantite) + 1;
            document.cookie = JSON.stringify(panier_tab);
            document.cookie += ';path=/'
            document.getElementById('liste').value = JSON.stringify(panier_tab);

            totalgeneral += 1 * parseFloat(prix);
            document.getElementById('total_prix').value = parseFloat(totalgeneral).toFixed(2);
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

            garantie_val = parseFloat(panier_val * 4).toFixed(2);
            garantie.innerText = garantie_val;

            prix = this.parentNode.parentNode.parentNode.querySelector('.event_prix span').innerHTML;
            total = parseFloat(prix) * val_quantite;
            this.parentNode.parentNode.parentNode.querySelector('.event_prix_total span').innerHTML = parseFloat(total).toFixed(2);



            totalgeneral -= 1 * parseFloat(prix);

            totalgeneral < 0 ? totalgeneral = 0 : totalgeneral = totalgeneral;

            document.getElementById('total_prix').value = parseFloat(totalgeneral).toFixed(2);
            document.getElementById('total').innerHTML = parseFloat(totalgeneral).toFixed(2);

            id = this.parentNode.querySelector('#event_id').value;
            if (val_quantite == 0) {
                //console.log('debut suppr')
                index = panier_tab.findIndex(element => element.id == id);
                //console.log(index)
                if(index > -1) {
                    //console.log("supression");
                    panier_tab.splice(index, 1);
                    document.cookie = JSON.stringify(panier_tab);
                    document.cookie += ';path=/'
                    document.getElementById('liste').value = JSON.stringify(panier_tab);


                    this.parentNode.parentNode.parentNode.parentNode.remove();

                    if (panier_val == 0) {
                        loadPanierVide();
                    }
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

    function loadPanierVide() {
        //console.log('Panier vide !')
        panier_vide = document.createElement('div');
        panier_vide.classList.add('panier_vide');
        panier_vide.innerHTML = '<h2>Votre panier est vide !</h2>';
        panier_vide.innerHTML += '<a class="panier_link" href="/evenements">Parcourir les évenements</a>';
        document.getElementById('panier_zone').append(panier_vide);
        document.getElementById('liste').value = null;

        garantie_val = parseFloat(0).toFixed(2)
        garantie.innerText = garantie_val;

        document.getElementById('log_btn').remove();
    }


    garantie_check = document.getElementById('garantie_check')

    garantie_check.addEventListener('change', () => {
        if (garantie_check.checked) {
            document.getElementById('total').innerHTML = parseFloat(totalgeneral + garantie_val).toFixed(2);
        } else {
            document.getElementById('total').innerHTML =  parseFloat(totalgeneral).toFixed(2);
        }
    })

