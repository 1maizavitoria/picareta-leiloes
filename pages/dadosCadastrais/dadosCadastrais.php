<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dadosCadastrais.scss">
    <script src="./dadosCadastrais.js"></script>
    <title>Dados cadastrais</title>
</head>
<body>

    <?php
    include './../../components/header/header.html';
    ?>
    
    <div class="content">

        <div class="left">
            <?php
            include './../../components/sidebar/sidebar.html';
            ?>
        </div>

        <div class="right">

            <div class="d-flex justify-content-center my-5">
                <h2>Dados Cadastrais</h2>
            </div>

            <form class="row d-flex justify-content-center" action="post">

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <input type="text" id="name" class="form-control" placeholder="Nome completo" onblur="nameValidation(this)" required>
                        <p id="invalid-message-name" hidden>
                            Informe seu nome completo.<br> <em>Ex: José Silva</em>
                        </p>
                    </div>
                    <div class="col-4 col-lg-3">
                        <input type="email" class="form-control" placeholder="E-mail" onblur="emailValidation(this)" required>
                        <p id="invalid-message-email" hidden>
                            Informe um e-mail válido.<br> <em>Ex: nome@dominio.com</em>
                        </p>
                    </div>
                    <div class="col-4 col-lg-2">
                        <input type="tel" class="form-control" placeholder="Telefone" onblur="phoneValidation(this)" required>
                        <p id="invalid-message-phone" hidden>
                            Informe um telefone válido.<br> <em>Ex: 68998785468</em>
                        </p>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <!-- Adicionar validação para ser igual ou maior que 18 anos -->
                        <input type="date" class="form-control" placeholder="Data de nascimento" required> 
                    </div>
                    <div class="col-5 col-lg-3">
                        <select class="form-select" required>
                            <option value="" disabled selected hidden>Estado civil</option>
                            <option value="solteiro">Solteiro</option>
                            <option value="casado">Casado</option>
                            <option value="separado">Separado</option>
                            <option value="divorciado">Divorciado</option>
                            <option value="viuvo">Viúvo</option>
                        </select>
                    </div>
                    <div class="col-3 col-lg-2">
                        <select class="form-select" required>
                            <option value="" disabled selected hidden>Sexo</option>
                            <option value="masculino">Masculino</option>
                            <option value="feminino">Feminino</option>
                        </select>
                    </div>
                </div>

                <div class="col-6 col-lg-3 mx-auto d-flex justify-content-center">
                    <button type="submit" value="salvar" class="btn btn-outline-success col-6">Salvar</button>
                </div>

            </form>

        </div>

    </div>

    <?php
    include './../../components/footer/footer.html';
    ?>
    
</body>
</html>