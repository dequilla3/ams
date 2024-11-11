import Swal from "sweetalert2";


export function showLoad() {
    Swal.fire({
        title: 'Preparing',
        html: 'Please wait...',
        allowEscapeKey: false,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
        },
    }).then(r => {
    });
}

export function showSuccessMsg(success) {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: success,
        showConfirmButton: true,
        timer: 5000 // Optional: auto-dismiss after 5 seconds
    }).then(r => {
    });
}
