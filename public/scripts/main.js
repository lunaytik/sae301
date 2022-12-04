// js de la progressbar
const progressBar = document.getElementById("progress-bar");
// const progressNext = document.getElementById("progress-next");
// const progressPrev = document.getElementById("progress-prev");
const steps = document.querySelectorAll(".step");
let active = 1;

const updateProgress = () => {
    // toggle active class on list items
    steps.forEach((step, i) => {
        if (i < active) {
            step.classList.add("active");
        } else {
            step.classList.remove("active");
        }
    });
    // set progress bar width
    progressBar.style.width =
        ((active - 1) / (steps.length - 1)) * 100 + "%";
};