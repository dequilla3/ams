import {showLoad} from "../alerts.js";

let navLinks = ['dashboard', 'appointments', 'patient-info'];

navLinks.forEach(val => {
    document.getElementById(val).addEventListener('click', () => {
        showLoad();
    });
})

