import { validateInput, checkAllFields, formatMoney, parameterURL } from '../../libs/helper.js';

window.validateInput = validateInput;
window.checkAllFields = checkAllFields;
window.parameterURL = parameterURL;

document.addEventListener('DOMContentLoaded', function() {
    listenInitialValue();
    listenIncrementalValue();
});

function listenInitialValue() {
    const initialValueInput = document.getElementById('initialValue');
    initialValueInput.addEventListener('input', function() {
        initialValueInput.value = formatMoney(initialValueInput.value);
    });
}

function listenIncrementalValue() {
    const incrementalValueInput = document.getElementById('incrementalValue');
    incrementalValueInput.addEventListener('input', function() {
        incrementalValueInput.value = formatMoney(incrementalValueInput.value);
    });
}