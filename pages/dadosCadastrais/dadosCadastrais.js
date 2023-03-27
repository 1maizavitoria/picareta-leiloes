function nameValidation(input) {
    const regex = /[a-zA-ZáàâãäéèêëíìïîóòôõöùüúûçñÁÀÂÃÉÈÊÍÌÏÓÒÔÕÖÚÙÛÇÑ]+(?:\s+[a-zA-ZáàâãäéèêëíìïîóòôõöùüúûçñÁÀÂÃÉÈÊÍÌÏÓÒÔÕÖÚÙÛÇÑ]+)+/;
    const invalidMessage = document.getElementById("invalid-message-name");
    validateInput(input, regex, invalidMessage);
}

function emailValidation(input) {
    const regex = /^\S+@\S+\.\S+$/; // procurar regEx melhor
    const invalidMessage = document.getElementById("invalid-message-email");
    validateInput(input, regex, invalidMessage);
}

function phoneValidation(input) {
    const regex = /^[1-9]{2}\s?9[\d]{4}[\d]{4}$/;
    const invalidMessage = document.getElementById("invalid-message-phone");
    validateInput(input, regex, invalidMessage);
}

function validateInput(input, regex, invalidMessage) {

    if (!regex.test(input.value)) {
    //red border
        input.style.border = "solid #e74c3c";
        input.value = null;
        invalidMessage.style.color = "#e74c3c";
        invalidMessage.hidden = false;

    } else {
    //green border
        input.style.borderColor = "#2ecc71";
        invalidMessage.hidden = true;
    }
}