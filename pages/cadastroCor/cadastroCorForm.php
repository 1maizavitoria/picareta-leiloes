<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastroCorForm.scss">
    <script type="module" src="./cadastroCorForm.js"></script>
    <title>Cadastro de Cor</title>
</head>
<body>

    <?php
    include './../../components/header/header.php';
    include './../../components/toastr/toastr.php';

    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $cor = trim($_POST['cor']);

        $corExistente = executeQuery("SELECT Descricao FROM cor WHERE Descricao = '$cor'");

        $redirect = true;

        if(!empty($cor)) {

            if(isset($_POST["adicionar"])) {
                if ($corExistente -> num_rows > 0) {
                    toastr('error', 'Cor já cadastrada.');
                    $redirect = false;
                } else {
                    executeQuery("INSERT INTO cor (Descricao) VALUES ('$cor')");
                }
            }

            if(isset($_POST['salvar'])) {
                if ($corExistente -> num_rows > 0) {
                    toastr('error', 'Cor já cadastrada.');
                    $redirect = false;
                } else {
                    executeQuery("UPDATE cor SET Descricao = '$cor' WHERE corId = '$id'");
                    toastr('success', 'Cor atualizada!');
                }
            }

        } else {
            $redirect = false;
            toastr('error', 'Nenhum campo deve ser vazio.');
        }

        if (isset($_POST['deletar'])) {
            $corSelecionada = executeQuery("SELECT mc.modeloCorId FROM MODELOCOR mc INNER JOIN COR c on c.corId = mc.corId AND c.corId = '$id'");
            if($corSelecionada -> num_rows > 0) {
                $modeloCorId = $corSelecionada -> fetch_assoc();
            }
            if(isset($modeloCorId)){
                toastr('error', 'Esta cor possui um modelo cor vinculado, não é possível excluí-lo.');
                $redirect = false;


            }else{
                executeQuery("DELETE FROM cor WHERE corId = '$id'");
                toastr('success', 'Cor excluída');
            }
        }

        if ($redirect) {
            header("Location: http://localhost/picareta_leiloes/pages/cadastroCor/cadastroCor.php");
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
                <h2>Cadastro de Cor</h2>
            </div>

            <form class="row d-flex justify-content-center" id="form" action="" method="POST">

                <div class="row justify-content-center mb-5">
                    <div class="col-6 col-lg-4">
                        <?php
                        $marca["Descricao"] = "";
                        if(isset($_GET["id"])){
                            $id = $_GET["id"];

                            if (isset($id) && $id != "") {
                                $corSelecionada = executeQuery("SELECT Descricao FROM cor WHERE corId = '$id'");
                                if($corSelecionada -> num_rows > 0) {
                                    $marca = $corSelecionada -> fetch_assoc();
                                }
                            }
                        }
                            
                        echo "<input type=\"text\" id=\"name\" name=\"cor\" class=\"form-control\" placeholder=\"Cor*\" value='" . $marca["Descricao"] . "' onblur=\"validateInput(this)\" required>"
                        ?>
                        <div class="invalid-feedback" id="invalid-message-name">Informe um nome de cor válido.<br> <em>Ex: Branco</em></div>
                    </div>
                </div>
                
                <?php 
                    if (isset($_GET["id"]))
                        $id = $_GET["id"];

                        if (isset($id) && $id != "") {
                            echo "
                            <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                                <button type='submit' name='deletar' class='btn btn-outline-danger col-5'>Deletar</button>
                                <button type='submit' name='salvar' class='btn btn-outline-success col-5' onclick='checkAllFields('form')'>Salvar</button>
                            </div>
                            ";
                        } else {
                            echo "
                            <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                                <button type='button' name='cancelar' class='btn btn-outline-danger col-5' onclick=\"window.location.href = 'http://localhost/picareta_leiloes/pages/cadastroCor/cadastroCor.php'\">Cancelar</button>
                                <button type='submit' name='adicionar' class='btn btn-outline-success col-5' onclick='checkAllFields('form')'>Adicionar</button>
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