const btn = document.getElementById('btn_ajout');

btn.addEventListener('click', () => {
    const quantite = document.getElementById('product_quantite');
    const nom = document.getElementById('product_name').innerText;
    const prix = document.getElementById('product_price').innerText;
    const id = document.getElementById('product_id').value;

    console.log({"id":id,"article":nom,"quantite":quantite.value,"prix":prix});

})