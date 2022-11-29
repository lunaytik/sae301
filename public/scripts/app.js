const account_btn = document.getElementById('account_btn');
const dropdown_menu = document.getElementById('dropdown');

account_btn.addEventListener('click', () => {
    if (dropdown_menu.classList.contains("active_menu")) {
        dropdown_menu.classList.remove("active_menu");
    } else {
        dropdown_menu.classList.add("active_menu");
    }
})