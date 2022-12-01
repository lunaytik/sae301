const navMenu = document.querySelector(".nav2");
navToggle = document.querySelector(".burger");
if(navToggle)
{
    navToggle.addEventListener("click", () =>
    {
        navMenu.classList.toggle("active");
    })
}
