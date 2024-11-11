import Swal from "sweetalert2";
import {showLoad, showSuccessMsg} from "../alerts.js";

window.onload = () => {
    document.getElementById('search').focus();

    let successEl = document.getElementById('success');
    if (successEl) {
        showSuccessMsg(successEl.textContent)
    }
}

document.getElementById('newAppointment').addEventListener('click', () => {
    showLoad()
})


