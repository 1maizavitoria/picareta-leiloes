<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastroModeloForm.scss">
    <script type="module" src="./cadastroModeloForm.js"></script>
    <title>Cadastro de Modelo</title>
</head>
<body>

    <?php
    include './../../components/header/header.php';
    ?>
    
    <div class="content">

        <div class="left">
            <?php
            include './../../components/sidebar/sidebar.php';
            ?>
        </div>

        <div class="right">

            <div class="d-flex justify-content-center my-5">
                <h2>Cadastro de Modelo</h2>
            </div>

            <form class="row d-flex justify-content-center" id="form" action="" method="POST">

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <select class="form-select" id="brand" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Marca*</option>
                            <option value="1">FORD</option>
                            <option value="2">BMW</option>
                            <option value="3">FIAT</option>
                            <option value="4">VOLKSWAGEN</option>
                            <option value="5">CHEVROLET</option>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-brand">Informe uma marca válida.</div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <input type="text" id="name" class="form-control" placeholder="Modelo*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-name">Informe um nome de modelo válido.<br> <em>Ex: Astra</em></div>
                    </div>
                    <div class="col-3">
                        <input type="number" id="year" maxLength="4" class="form-control" placeholder="Ano Modelo*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-year">Informe um ano modelo válido.<br> <em>Ex: 2020</em></div>
                    </div>
                </div>
                
                <?php 
                    if (isset($_GET["id"]))
                        $id = $_GET["id"];

                        if (isset($id) && $id != "") {
                            echo "
                            <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                                <button type='submit' value='deletar' class='btn btn-outline-danger col-5'>Deletar</button>
                                <button type='submit' value='salvar' class='btn btn-outline-success col-5' onclick=\"checkAllFields('form')\">Salvar</button>
                            </div>
                            ";
                        } else {
                            echo "
                            <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                                <button type='button' value='cancelar' class='btn btn-outline-danger col-5' onclick=\"window.history.back()\">Cancelar</button>
                                <button type='submit' value='adicionar' class='btn btn-outline-success col-5' onclick=\"checkAllFields('form')\">Adicionar</button>
                            </div>
                            ";
                        }
                ?>

            </form>

        </div>

    </div>

    <?php
    include './../../components/footer/footer.html';
    ?>

    <?php
    include './../../libs/authenticator.php';
    autenticar(2);
    ?>
    
</body>
</html>