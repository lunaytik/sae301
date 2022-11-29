const account_btn = document.getElementById('account_btn');
const dropdown_menu = document.getElementById('dropdown');

account_btn.addEventListener('click', () => {
    console.log('click');
    if (dropdown_menu.classList.contains("active_menu")) {
        console.log('yes')
        dropdown_menu.classList.remove("active_menu");
    } else {
        console.log('no')
        dropdown_menu.classList.add("active_menu");
    }
})