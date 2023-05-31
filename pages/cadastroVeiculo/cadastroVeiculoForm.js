import { validateInput, checkAllFields, formatMoney, parameterURL } from '../../libs/helper.js';

window.validateInput = validateInput;
window.checkAllFields = checkAllFields;
window.parameterURL = parameterURL;

document.addEventListener('DOMContentLoaded', function() {
    listenExpenses();
});


function listenExpenses() {
    const expensesInput = document.getElementById('expenses');
    expensesInput.addEventListener('input', function() {
        expensesInput.value = formatMoney(expensesInput.value);
    });
}