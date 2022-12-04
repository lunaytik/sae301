// mettre la lettre dans la photo de profil
window.onload = function(){
    var premierelettre = document.getElementById('account').innerHTML
    let tkt = premierelettre.charAt(0);
    //console.log(tkt);
    document.getElementById('profileImage').innerHTML = tkt
};
