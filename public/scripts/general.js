panier_liste = document.cookie;

// js de la nav3
const navMenu = document.querySelector(".nav2");
navToggle = document.querySelector(".burger");
if(navToggle)
{
    navToggle.addEventListener("click", () =>
    {
        navMenu.classList.toggle("active");
    })
}

if (panier_liste.length!=0) {
    var panier_liste = document.cookie.split(";");

    if (panier_liste.length > 1) {
        panier_liste = panier_liste.splice(-1, 1);
        panier_liste.join();
    }
    panier_tab = JSON.parse(panier_liste);
}
else { panier_tab = Array(); }
console.log(panier_tab);

const panier_display = document.getElementById('panier_nombre');

var panier_val = 0;
panier_tab.forEach(element => {
    panier_val += parseInt(element.quantite);
    panier_display.innerText = panier_val;
});


// nav3 active
var btnContainer = document.getElementsByClassName("nav3");
var btns = document.getElementsByClassName("nav3-select");
for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
        (document.querySelector('.active')) ? document.querySelector('.active').classList.remove('active') : '';
        this.classList.add('active');
    });
}

$(document).ready(function () {
    // nav3 bulle compteur panier
    document.getElementById('panier_nombre_bis').innerHTML = panier_nombre.innerHTML
    // Barre de recherche en AJAX
    $("#recherche").on('keyup', function (event) {
        let nom = $(this).val();
        console.log(nom)
        if (nom == null || nom.length === 0) {
            $('#recherche_container').hide();
        }
        console.log(nom.length)
        if (nom != null && nom.length != 0) {
            $.ajax({
                type: 'POST',
                url: '/recherche',
                data: {
                    recherche: nom
                },
                async: true
            })
                .done(function (data, status) {
                    console.log(data)
                    $('#recherche_container').html('');
                    $('#recherche_container').show();
                    if (data.length == 0) {
                        let e = $('<div class="recherche_container_noresult">Aucun résultat lié à cette recherche !</div>');
                        $('#recherche_container').append(e);
                    }
                    for (i = 0; i < data.length; i++) {
                        evenement = data[i];
                        let e = $('<a href=""><img id="recherche_img" src=""><div><h1 style="font-size: 1.4rem !important;font-weight: 600;" id="recherche_nom"></h1><h2 id="recherche_prix" style="font-size: 1.2rem;font-weight: 400;color: #e90065;"></h2></div></a><hr style="margin: 0 1rem;color: #e2e2e2;">');
                        e.attr('href', evenement['lien'])

                        let lien = "/uploads/"+evenement['src'];

                        $('#recherche_img', e).attr('src', lien)
                        $('#recherche_nom', e).html(evenement['nom']);
                        $('#recherche_prix', e).html(evenement['prix']);
                        $('#recherche_container').append(e);
                    }
                })
                .fail(function (xhr, textStatus, errorThrown) {
                    alert('Ajax request failed.');
                })
        }
    });
})
