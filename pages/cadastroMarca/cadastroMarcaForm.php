<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastroMarcaForm.scss">
    <script type="module" src="./cadastroMarcaForm.js"></script>
    <title>Cadastro de Marca</title>
</head>
<body>

    <?php
    include './../../components/header/header.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao = $_POST['descricao'];
    executeQuery("INSERT INTO marca (descricao) VALUES ('$descricao')");
    }
    ?>
    
    <div class="content">

        <div class="left">
            <?php
            include './../../components/sidebar/sidebar.php';
            


            ?>
        </div>

        <div class="right">

            <div class="d-flex justify-content-center my-5">
                <h2>Cadastro de Marca</h2>
            </div>

            <form class="row d-flex justify-content-center" id="form" action="" method="POST">

                <div class="row justify-content-center mb-5">
                    <div class="col-6 col-lg-4">
                        <input type="text" id="name" name="descricao" class="form-control" placeholder="Marca*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-name">Informe um nome de marca válido.<br> <em>Ex: Chevrolet</em></div>
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
    include './../../components/footer/footer.php';
    ?>

    <?php
    include './../../libs/authenticator.php';
    autenticar(2);
    ?>
    
</body>
</html>