export { validateInput, formatCPF, formatRG, formatCEP, formatPhone, checkAllFields };

function validateInput(input) {
    let regex;
    let validField = true;
    let invalidDiv = document.getElementById(`invalid-message-${input.id}`);

    switch (input.id) {
        case "name":
            regex = /^[\p{L}\s]+$/u;
            break;
        case "email":
            regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/u;
            break;
        case "cpf":
            regex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
            break;
        case "rg":
            regex = /^\d{2}\.\d{3}\.\d{3}-\d{1}$/;
            break;
        case "phone":
            regex = /^\([1-9]{2}\)\s?[9][6-9]\d{3}\-\d{4}$/;
            break;
        case "birthDate":
            regex = /^\d{4}-\d{2}-\d{2}$/;
            validField = (new Date().getFullYear() - new Date(input.value).getFullYear()) >= 18;
            break;
        case "maritalStatus":
            regex = /^[1-5]$/;
            validField = input.value != "";
            break;
        case "gender":
            regex = /^[1-2]$/;
            validField = input.value != "";
            break;
        case "address":
            regex = /^[\p{L}\s\d]+$/u;
            break;
        case "city":
            regex = /^[\p{L}\s.'-]+$/u;
            break;
        case "state":
            regex = /^(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)$/;
            break;
        case "houseNumber":
            regex = /^\d{1,5}$/;
            break;
        case "complement":
            regex = /^[\p{L}\s\d]+$/u;
            break;
        case "cep":
            regex = /^\d{5}-\d{3}$/;
            break;
    }

    if (!regex.test(input.value) || !validField) {
        invalidDiv.hidden = false;
        input.classList.add("is-invalid");
        input.classList.remove("is-valid")
        input.value = null;
    } else {
        invalidDiv.hidden = true;
        input.classList.remove("is-invalid");
        input.classList.add("is-valid")
        input.value = input.value.trim();
    }
}

function formatCPF(cpf) {
    const cleanedCPF = cpf.replace(/\D/g, ''); // Remove tudo que não é dígito

    let formattedCPF = cleanedCPF.replace(/^(\d{3})(\d{0,3})?(\d{0,3})?(\d{0,2})?$/, function(match, cpf1, cpf2, cpf3, cpf4) {
      let formatted = cpf1;
      if (cpf2) formatted += '.' + cpf2;
      if (cpf3) formatted += '.' + cpf3;
      if (cpf4) formatted += '-' + cpf4;
      return formatted;
    });
    
    return formattedCPF;
}

function formatRG(rg) {
    const cleanedRG = rg.replace(/\D/g, ''); // Remove tudo que não é dígito

    let formattedRG = cleanedRG.replace(/^(\d{2})(\d{0,3})?(\d{0,3})?(\d{0,1})?$/, function(match, rg1, rg2, rg3, rg4) {
      let formatted = rg1;
      if (rg2) formatted += '.' + rg2;
      if (rg3) formatted += '.' + rg3;
      if (rg4) formatted += '-' + rg4;
      return formatted;
    });
    
    return formattedRG;
}

function formatCEP(cep) {
    const cleanedCEP = cep.replace(/\D/g, ''); // Remove tudo que não é dígito

    let formattedCEP = cleanedCEP.replace(/^(\d{5})(\d{0,3})$/, function(match, cep1, cep2) {
      let formatted = cep1;
      if (cep2) formatted += '-' + cep2;
      return formatted;
    });
    
    return formattedCEP;
}

function formatPhone(phone) {
    const cleanedPhone = phone.replace(/\D/g, ''); // Remove tudo que não é dígito
  
    let formattedPhone = cleanedPhone.replace(/^(\d{2})(\d{0,1})?(\d{0,4})?(\d{0,4})?$/, function(match, phone1, phone2, phone3, phone4) {
      let formatted = '(' + phone1 + ')';
      if (phone2) formatted += ' ' + phone2;
      if (phone3) formatted += '' + phone3;
      if (phone4) formatted += '-' + phone4;
      return formatted;
    });
    
    return formattedPhone;
}

function checkAllFields(id) {
    let form = document.getElementById(id)
    let elements = Array.from(form.querySelectorAll('[onblur]'));
    elements = elements.concat(Array.from(form.querySelectorAll('[onchange]')));
    
    elements.forEach(element => {
        if(element.onblur)
            element.onblur();
        else if (element.onchange)
            element.onchange();
    })
}