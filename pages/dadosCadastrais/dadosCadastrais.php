<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dadosCadastrais.scss">
    <script type="module" src="./dadosCadastrais.js"></script>
    <title>Dados Cadastrais</title>
</head>
<body>

    <?php
    include './../../components/header/header.html';
    ?>
    
    <div class="content">

        <div class="left">
            <?php
            include './../../components/sidebar/sidebar.php';
            ?>
        </div>

        <div class="right">

            <div class="d-flex justify-content-center my-5">
                <h2>Dados Cadastrais</h2>
            </div>

            <form class="row d-flex justify-content-center" id="form" action="save" method="POST">

                <div class="row justify-content-center mb-5">
                    <div class="col-6 col-lg-4">
                        <input type="text" id="name" class="form-control" placeholder="Nome completo*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-name">Informe um nome válido.<br> <em>Ex: Tyler Durden</em></div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <input type="email" id="email" class="form-control" placeholder="E-mail*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-email">Informe um e-mail válido.<br> <em>Ex: nome@dominio.com</em></div>
                    </div>
                </div>
                
                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <input type="text" id="cpf" maxLength="14" class="form-control" placeholder="CPF*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-cpf">Informe um CPF válido.<br> <em>Ex: 123.456.789-00</em></div>
                    </div>
                    <div class="col-4 col-lg-3">
                        <input type="text" id="rg" maxLength=12 class="form-control" placeholder="RG*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-rg">Informe um RG válido.<br> <em>Ex: 12.345.678-9</em></div>
                    </div>
                    <div class="col-4 col-lg-2">
                        <input type="tel" maxLength="15" id="phone" class="form-control" placeholder="Celular*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-phone">Informe um celular válido.<br> <em>Ex: (00) 90000-0000</em></div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <input type="date" id="birthDate" class="form-control" placeholder="Data de nascimento*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-birthDate">Informe uma data de nascimento válida.<br> <em>Ex: 01/01/2000</em></div>
                    </div>
                    <div class="col-5 col-lg-3">
                        <select class="form-select" id="maritalStatus" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Estado civil*</option>
                            <option value="1">Solteiro</option>
                            <option value="2">Casado</option>
                            <option value="3">Separado</option>
                            <option value="4">Divorciado</option>
                            <option value="5">Viúvo</option>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-maritalStatus">Informe um estado civil válido.</div>
                    </div>
                    <div class="col-3 col-lg-2">
                        <select class="form-select" id="gender" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Sexo*</option>
                            <option value="1">Masculino</option>
                            <option value="2">Feminino</option>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-gender">Informe um sexo válido.</div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <input type="text" id="address" class="form-control" placeholder="Logradouro*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-address">Informe um logradouro válido.<br> <em>Ex: Rua São Francisco de Sales</em></div>
                    </div>
                    <div class="col-4 col-lg-3">
                        <input type="text" id="city" class="form-control" placeholder="Cidade*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-city">Informe uma cidade válida.<br> <em>Ex: Curitiba</em></div>
                    </div>
                    <div class="col-4 col-lg-2">
                        <select class="form-select" id="state" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Estado*</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federel</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goías</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-state">Informe uma sigla de Estado válida</div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                <div class="col-4 col-lg-3">
                        <input type="text" id="houseNumber" class="form-control" placeholder="Número da residência*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-houseNumber">Informe uma número de residência válido.<br> <em>Ex: 338</em></div>
                    </div>
                    <div class="col-4 col-lg-3">
                        <input type="text" id="complement" class="form-control" placeholder="Complemento" onblur="validateInput(this)">
                        <div class="invalid-feedback" id="invalid-message-complement">Informe um complemento válido.<br> <em>Ex: Sobrado 20</em></div>
                    </div>
                    <div class="col-4 col-lg-2">
                        <input type="tel" id="cep" maxLength="9" class="form-control" placeholder="CEP*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-cep">Informe um CEP válido.<br> <em>Ex: 81720-290</em></div>
                    </div>
                </div>

                <div class="col-6 col-lg-3 mx-auto d-flex justify-content-center">
                    <button type="submit" value="salvar" class="btn btn-outline-success col-6" onclick="checkAllFields('form')">Salvar</button>
                </div>

            </form>

        </div>

    </div>

    <?php
    include './../../components/footer/footer.html';
    ?>
    
</body>
</html>