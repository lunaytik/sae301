const btn = document.getElementById('btn_ajout');

btn.addEventListener('click', () => {
    const quantite = document.getElementById('product_quantite').value;
    const nom = document.getElementById('product_name').innerText;
    const prix = document.getElementById('product_price').innerText;
    const id = document.getElementById('product_idr').value;

    console.log(id);

})