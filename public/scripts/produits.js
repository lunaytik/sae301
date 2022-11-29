const btn_ajout = document.getElementById('btn_ajout');

btn_ajout.addEventListener('click', () => {
    const event_quantite = document.getElementById('event_quantite');
    const event_nom = document.getElementById('event_nom').innerText;
    const event_prix = document.getElementById('event_prix').innerText;
    const event_img = document.getElementById('event_img').src;
    const event_date = document.getElementById('event_date').innerText;
    const event_id = document.getElementById('event_id').value;


    index = panier_tab.findIndex(element => element.id == event_id);
    //console.log(panier_tab)
    if(index > -1) {
        panier_tab[index].quantite = parseInt(panier_tab[index].quantite) + parseInt(event_quantite.value);
        panier_val += parseInt(event_quantite.value)
        panier_display.innerText = panier_val;
        document.cookie = JSON.stringify(panier_tab);
        document.cookie += ';path=/'
    } else {
        panier_tab.push({"id":event_id,"nom":event_nom,"img":event_img,"quantite":event_quantite.value,"prix":event_prix,"date":event_date});
        panier_val += parseInt(event_quantite.value);
        panier_display.innerText = panier_val;
        document.cookie = JSON.stringify(panier_tab);
        document.cookie += ';path=/'
    }
})

function delay (URL) {
    setTimeout( function() { window.location = URL }, 500 );
}

const ajout = document.getElementById('ajout');

ajout.addEventListener('click', () => {
    const event_quantite = document.getElementById('event_quantite');
    const event_nom = document.getElementById('event_nom').innerText;
    const event_prix = document.getElementById('event_prix').innerText;
    const event_img = document.getElementById('event_img').src;
    const event_date = document.getElementById('event_date').innerText;
    const event_id = document.getElementById('event_id').value;

    index = panier_tab.findIndex(element => element.id == event_id);
    if(index > -1) {
        panier_tab[index].quantite = parseInt(panier_tab[index].quantite) + parseInt(event_quantite.value);
        panier_val += parseInt(event_quantite.value)
        panier_display.innerText = panier_val;
        document.cookie = JSON.stringify(panier_tab);
        document.cookie += ';path=/'
    } else {
        panier_tab.push({"id":event_id,"nom":event_nom,"img":event_img,"quantite":event_quantite.value,"prix":event_prix,"date":event_date});
        panier_val += parseInt(event_quantite.value);
        panier_display.innerText = panier_val;
        document.cookie = JSON.stringify(panier_tab);
        document.cookie += ';path=/'
    }
})