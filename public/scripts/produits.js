const btn_ajout = document.getElementById('btn_ajout');

btn_ajout.addEventListener('click', () => {
    const event_quantite = document.getElementById('event_quantite');
    const event_nom = document.getElementById('event_nom').innerText;
    const event_prix = document.getElementById('event_prix').innerText;
    const event_id = document.getElementById('event_id').value;

    index = panier_tab.findIndex(element => element.id == event_id);
    console.log(panier_tab)
    if(index > -1) {
        console.log("Déjà dans le panier")
        panier_tab[index].quantite = parseInt(panier_tab[index].quantite) + parseInt(event_quantite.value);
        panier_val += parseInt(event_quantite.value)
        panier_display.innerText = panier_val;
        document.cookie = JSON.stringify(panier_tab);
        document.cookie += ';path=/'
    } else {
        console.log("Ajout dans le panier")
        panier_tab.push({"id":event_id,"nom":event_nom,"quantite":event_quantite.value,"prix":event_prix});
        panier_val += parseInt(event_quantite.value);
        panier_display.innerText = panier_val;
        document.cookie = JSON.stringify(panier_tab);
        document.cookie += ';path=/'
    }
})