import { validateInput, formatCPF, formatRG, formatCEP, formatPhone, checkAllFields } from '../../libs/helper.js';

window.validateInput = validateInput;
window.checkAllFields = checkAllFields;

document.addEventListener('DOMContentLoaded', function() {
    listenCPF();
    listenRG();
    listenCEP();
    listenPhone();
});

function listenCPF() {
    const cpfInput = document.getElementById('cpf');
    cpfInput.addEventListener('input', function() {
        cpfInput.value = formatCPF(cpfInput.value);
    });
}

function listenRG() {
    const rgInput = document.getElementById('rg');
    rgInput.addEventListener('input', function() {
        rgInput.value = formatRG(rgInput.value);
    });
}

function listenCEP() {
    const cepInput = document.getElementById('cep');
    cepInput.addEventListener('input', function() {
        cepInput.value = formatCEP(cepInput.value);
    });
}

function listenPhone() {
    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', function() {
        phoneInput.value = formatPhone(phoneInput.value);
    });
}