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
    include './../../components/header/header.php';
    include './../../components/toastr/toastr.php';

     $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $financeira = trim($_POST['financeira']);

        $financeiraExistente = executeQuery("SELECT descricaoFinanceira FROM financeira WHERE descricaoFinanceira = '$financeira'");

        $redirect = true;

        if(!empty($financeira)) {

            if(isset($_POST["adicionar"])) {
                if ($financeiraExistente -> num_rows > 0) {
                    toastr('error', 'Financeira já cadastrada.');
                    $redirect = false;
                } else {
                    executeQuery("INSERT INTO financeira (descricaoFinanceira) VALUES ('$financeira')");
                }
            }

            if(isset($_POST['salvar'])) {
                if ($financeiraExistente -> num_rows > 0) {
                    toastr('error', 'Financeira já cadastrada.');
                    $redirect = false;
                } else {
                    executeQuery("UPDATE financeira SET descricaoFinanceira = '$financeira' WHERE financeiraId= '$id'");
                    toastr('success', 'Financeira atualizada!');
                }
            }

        } else {
            $redirect = false;
            toastr('error', 'Nenhum campo deve ser vazio.');
        }

        if (isset($_POST['deletar'])) {
            executeQuery("DELETE FROM financeira WHERE financeiraId = '$id'");
            toastr('success', 'Financeira excluída');
        }

        if ($redirect) {
            header("Location: http://localhost/picareta_leiloes/pages/cadastroFinanceira/cadastroFinanceira.php");
        }
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
                <h2>Cadastro de Financeira</h2>
            </div>
            <form class='row d-flex justify-content-center' id='form' action='' method="POST">
                <?php 
                    if (isset($_GET["id"]))
                        $id = $_GET["id"];

                        if (isset($id) && $id != "") {

                            $financeiraSelecionada = executeQuery("SELECT descricaoFinanceira FROM financeira WHERE financeiraId = '$id'");
                            
                            $marca["descricaoFinanceira"] = "";

                            if($financeiraSelecionada -> num_rows > 0) {
                                $marca = $financeiraSelecionada -> fetch_assoc();
                            }

                            echo "
                            <div class='row justify-content-center mb-5'>
                                <div class='col-6 col-lg-4'>
                                    <input type='text' id='financeira' name='financeira' class='form-control' placeholder='Financeira*' value='" . $marca["descricaoFinanceira"] . "' onblur='validateInput(this)' required>
                                    <div class='invalid-feedback' id='invalid-message-financeira'>Informe um nome de financeira válido.<br> <em>Ex: Santander</em></div>
                                </div>
                            </div>
                            <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                                <button type='submit' id='deletar' name='deletar' value='deletar' class='btn btn-outline-danger col-5'>Deletar</button>
                                <button type='submit' id='salvar' name='salvar' value='salvar' class='btn btn-outline-success col-5' onclick=\"checkAllFields('form')\">Salvar</button>
                            </div>
                            ";
                        } else { 
                            echo "
                            <div class='row justify-content-center mb-5'>
                                <div class='col-6 col-lg-4'>
                                    <input type='text' id='financeira' name='financeira' class='form-control' placeholder='Financeira*' onblur='validateInput(this)' required>
                                    <div class='invalid-feedback' id='invalid-message-financeira'>Informe um nome de financeira válido.<br> <em>Ex: Santander</em></div>
                                </div>
                            </div>
                            <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                                <button type='button' value='cancelar' class='btn btn-outline-danger col-5' onclick=\"window.history.back()\">Cancelar</button>
                                <button type='submit' id='adicionar' name='adicionar' value='adicionar' class='btn btn-outline-success col-5' onclick=\"checkAllFields('form')\">Adicionar</button>
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