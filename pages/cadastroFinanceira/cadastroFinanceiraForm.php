<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastroFinanceiraForm.scss">
    <script type="module" src="./cadastroFinanceiraForm.js"></script>
    <title>Cadastro de Financeira</title>
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
                <h2>Cadastro de Financeira</h2>
            </div>

            <form class="row d-flex justify-content-center" id="form" action="post">

                <div class="row justify-content-center mb-5">
                    <div class="col-6 col-lg-4">
                        <input type="text" id="name" class="form-control" placeholder="Financeira*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-name">Informe um nome de financeira válido.<br> <em>Ex: Santander</em></div>
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
                                <button type='button' value='cancelar' class='btn btn-outline-danger col-5' onclick=\"window.close()\">Cancelar</button>
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
    
</body>
</html>