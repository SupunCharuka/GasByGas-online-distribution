import './bootstrap';

import Swal from "sweetalert2";
import intlTelInput from "intl-tel-input";

window.Swal = Swal;
window.Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
});

window.intlTelInput = {
    intlTelInput,
    errorMap: [
        "Invalid number",
        "Invalid country code",
        "The number is too short",
        "Number Too long",
        "Invalid number",
    ],
    options: {
        initialCountry: "auto",
        customContainer: "int-phone",
        separateDialCode: true,
        utilsScript: import("intl-tel-input/build/js/utils.js"),
    },
    selector: document.querySelector("#phone") || false,
    init: function (selector = this.selector) {
        return selector && intlTelInput(selector, this.options);
    },
};