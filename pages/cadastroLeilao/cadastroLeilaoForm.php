<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastroLeilaoForm.scss">
    <script type="module" src="./cadastroLeilaoForm.js"></script>
    <title>Cadastro de Leilão</title>
</head>
<body>

    <?php
    include './../../components/header/header.php';
    include './../../components/toastr/toastr.php';

    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $dataLeilao = trim($_POST['dataLeilao']);
        $leilaoExistente = executeQuery("SELECT leilaoId, dataLeilao FROM leilao WHERE  dataLeilao = '$dataLeilao'");
        $redirect = true;

        if (!empty($dataLeilao)) {
            
            if(isset($_POST["adicionar"])) {
                echo "<script>console.log('$dataLeilao')</script>";
                if ($leilaoExistente -> num_rows > 0) {
                    toastr('error', 'Já existe um leilão cadastrado nessa data.');
                    $redirect = false;
                } else {
                    executeQuery("INSERT INTO leilao (dataLeilao) VALUES ('$dataLeilao')"); 
                }  
            }

            if(isset($_POST['salvar'])) {
                if ($leilaoExistente -> num_rows > 0) {
                    toastr('error', 'Já existe um leilão cadastrado nessa data.');
                    $redirect = false;
                } else {
                    executeQuery("UPDATE leilao SET dataLeilao = '$dataLeilao' WHERE leilaoId = '$id'");
                    toastr('success', 'Leilão atualizado!');
                }
            }        
        }

        if (isset($_POST['deletar'])) {
            $leilaoSelecionado = executeQuery("SELECT le.leilaoId, le.dataLeilao FROM leilao le INNER JOIN lote lo on le.leilaoId = lo.leilaoId WHERE le.leilaoId = '$id'");
            if($leilaoSelecionado -> num_rows > 0) {
                $leilao = $leilaoSelecionado -> fetch_assoc();
            }
            if(isset($leilao)){
                toastr('error', 'Este leilão possui um lote vinculado, não é possível excluí-lo.');
                $redirect = false;


            }else{
                executeQuery("DELETE FROM leilao WHERE leilaoId = '$id'");
                toastr('success', 'Leilão excluído.');
            }
        }

        if ($redirect)
            header("Location: http://localhost/picareta_leiloes/pages/cadastroLeilao/cadastroLeilao.php");
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
                <h2>Cadastro de Leilão</h2>
            </div>

            <form class="row d-flex justify-content-center" id="form" action="" method="POST">

                <div class="row justify-content-center mb-5">
                <div class="col-4 col-lg-3">
                    <?php
                        if (isset($_GET["id"]) && $_GET["id"] != ""){
                            $id = $_GET["id"];
                            $leilao = executeQuery("SELECT leilaoId, DATE_FORMAT(dataLeilao, '%Y-%m-%dT%H:%i') AS dataLeilao FROM leilao WHERE leilaoId = '$id'");
                            $leilao = mysqli_fetch_assoc($leilao);
                            $dataLeilao = $leilao['dataLeilao'];
                            echo "<input type='datetime-local' id='auctionDate' name='dataLeilao' class='form-control' placeholder='Data do leilão*' onblur='validateInput(this)' value='$dataLeilao' required>";
                        } else {
                            echo "<input type='datetime-local' id='auctionDate' name='dataLeilao' class='form-control' placeholder='Data do leilão*' onblur='validateInput(this)' required>";
                        }
                    ?>
                        <div class="invalid-feedback" id="invalid-message-auctionDate">Informe uma data de leilão válida.<br> <em>Ex: 25/05/2023</em></div>
                    </div>
                </div>
                
                <?php 
                    if (isset($_GET["id"]))
                        $id = $_GET["id"];

                        if (isset($id) && $id != "") {
                            echo "
                            <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                                <button type='submit' value='deletar' name='deletar' class='btn btn-outline-danger col-5'>Deletar</button>
                                <button type='submit' value='salvar' name='salvar' class='btn btn-outline-success col-5' onclick=\"checkAllFields('form')\">Salvar</button>
                            </div>
                            ";
                        } else {
                            echo "
                            <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                                <button type='button' value='cancelar' class='btn btn-outline-danger col-5' onclick=\"window.location.href='http://localhost/picareta_leiloes/pages/cadastroLeilao/cadastroLeilao.php'\"\">Cancelar</button>
                                <button type='submit' value='adicionar' name='adicionar' class='btn btn-outline-success col-5' onclick=\"checkAllFields('form')\">Adicionar</button>
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
    
</body>
</html>