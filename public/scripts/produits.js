const btn = document.getElementById('btn_ajout');

btn.addEventListener('click', () => {
    const quantite = document.getElementById('product_quantite');
    const nom = document.getElementById('product_name').innerText;
    const prix = document.getElementById('product_price').innerText;
    const id = document.getElementById('product_id').value;

    index = panier.findIndex(element => element.id == id);
    console.log(panier)
    if(index > -1) {
        console.log("deja dedans")
        panier[index].quantite = parseInt(panier[index].quantite) + parseInt(quantite.value);
        panier_val += parseInt(quantite.value)
        panierNb.innerText = panier_val;
        document.cookie = JSON.stringify(panier);
    } else {
        console.log("ajout")
        panier.push({"id":id,"article":nom,"quantite":quantite.value,"prix":prix});
        panier_val += parseInt(quantite.value);
        panierNb.innerText = panier_val;
        document.cookie = JSON.stringify(panier);
    }

})