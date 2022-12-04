const cb = document.getElementById('cb_cardNum');
const nomentier = document.getElementById('cb_cardName');
const mois = document.getElementById('cb_cardMois');
const annee = document.getElementById('cb_cardAnnee');

const cb_display = document.getElementById('carte_num');
const nom_display = document.getElementById('carte_nom');
const mois_display = document.getElementById('carte_mois');
const annee_display = document.getElementById('carte_annee');

cb.addEventListener('keyup', (event) => {
    if (cb.value.length == 4) {
        cb.value += ' ';
    }
    if (cb.value.length == 9) {
        cb.value += ' ';
    }
    if (cb.value.length == 14) {
        cb.value += ' ';
    }
    cb_display.innerText = cb.value;
})

nomentier.addEventListener('input', () => {
    // console.log(nomentier.value);
    nom_display.innerText = nomentier.value;
})

mois.addEventListener('change', () => {
    //console.log(mois.value);
    mois_display.innerText = mois.value;
})

annee.addEventListener('change', () => {
    //console.log(mois.value);
    annee_display.innerText = annee.value;
})