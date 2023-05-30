import { validateInput, checkAllFields, formatLicensePlate, formatMoney, parameterURL } from '../../libs/helper.js';

window.validateInput = validateInput;
window.checkAllFields = checkAllFields;
window.parameterURL = parameterURL;

document.addEventListener('DOMContentLoaded', function() {
    listenLicensePlate();
    listenExpenses();
});

function listenLicensePlate() {
    const licensePlateInput = document.getElementById('licensePlate');
    licensePlateInput.addEventListener('input', function() {
        licensePlateInput.value = formatLicensePlate(licensePlateInput.value);
    });
}

function listenExpenses() {
    const expensesInput = document.getElementById('expenses');
    expensesInput.addEventListener('input', function() {
        expensesInput.value = formatMoney(expensesInput.value);
    });
}