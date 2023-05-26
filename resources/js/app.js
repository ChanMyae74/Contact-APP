require('./bootstrap');

let Swal = require("sweetalert2");
window.Swal = Swal;
import ScrollReveal from "scrollreveal";
window.jquery = window.$ = require("jquery");

ScrollReveal().reveal('.contact-list', {
    distance: '50px',
    easing: 'ease-out',
    duration: 600,
    interval: 200,
    origin: 'bottom',
    mobile: true,
    reset: true,
    scale: 0.9
});

window.bootstrap = require("bootstrap");

