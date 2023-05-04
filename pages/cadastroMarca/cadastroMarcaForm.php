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
    include './../../components/toastr/toastr.php';

    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $descricao = trim($_POST['descricao']);
        $marcaExistente = executeQuery("SELECT marcaId, descricao FROM marca WHERE  descricao = '$descricao'");
        $redirect = true;

        if (!empty($descricao)) {
            
            if(isset($_POST["adicionar"])) {
                if ($marcaExistente -> num_rows > 0) {
                    toastr('error', 'Marca já cadastrada.');
                    $redirect = false;
                } else {
                    executeQuery("INSERT INTO marca (descricao) VALUES ('$descricao')"); 
                }  
            }

            if(isset($_POST['salvar'])) {
                if ($marcaExistente -> num_rows > 0) {
                    toastr('error', 'Marca já cadastrada.');
                    $redirect = false;
                } else {
                    executeQuery("UPDATE marca SET descricao = '$descricao' WHERE marcaId = '$id'");
                    toastr('success', 'Marca atualizada!');
                }
            }        
        }

        if (isset($_POST['deletar'])) {
            $marcaSelecionada = executeQuery("SELECT ma.marcaId, ma.descricao FROM marca ma INNER JOIN modelo mo on mo.marcaId = ma.marcaId WHERE ma.marcaId = '$id'");
            if($marcaSelecionada -> num_rows > 0) {
                $marca = $marcaSelecionada -> fetch_assoc();
            }
            if(isset($marca)){
                toastr('error', 'Esta marca possui um modelo vinculado, não é possível excluí-la.');
                $redirect = false;


            }else{
                executeQuery("DELETE FROM marca WHERE marcaId = '$id'");
                toastr('success', 'Marca excluída');
            }
        }

        if ($redirect)
            header("Location: http://localhost/picareta_leiloes/pages/cadastroMarca/cadastroMarca.php");
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

               
                
                <?php 
                    if (isset($_GET["id"]))
                        $id = $_GET["id"];

                        if (isset($id) && $id != "") {
                            $marcaSelecionada = executeQuery("SELECT ma.marcaId, ma.descricao FROM marca ma WHERE ma.marcaid = '$id'");
                            if($marcaSelecionada -> num_rows > 0) {
                                $marca = $marcaSelecionada -> fetch_assoc();
                            }
                            if (isset($marca)) {
                                echo "
                                <div class='row justify-content-center mb-5'>
                                <div class='col-6 col-lg-4'>
                                    <input type='text' id='name' name='descricao' class='form-control' placeholder='Marca*' value='" . $marca["descricao"] . "' onblur='validateInput(this)' required>
                                    <div class='invalid-feedback' id='invalid-message-name'>Informe um nome de marca válido.<br> <em>Ex: Chevrolet</em></div>
                                </div>
                                </div>
                                ";
                            }

                            echo "
                            <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                                <button type='submit' value='deletar' name='deletar' class='btn btn-outline-danger col-5'>Deletar</button>
                                <button type='submit' value='salvar' name='salvar' class='btn btn-outline-success col-5' onclick=\"checkAllFields('form')\">Salvar</button>
                            </div>
                            ";
                        } else {
                            echo "
                            <div class='row justify-content-center mb-5'>
                            <div class='col-4 col-lg-4'>
                                <input type='text' id='name' name='descricao' class='form-control' placeholder='Marca*' onblur='validateInput(this)' required>
                                <div class='invalid-feedback' id='invalid-message-name'>Informe um nome de marca válido.<br> <em>Ex: Chevrolet</em></div>
                            </div>
                            </div>
                            
                            <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                                <button type='button' value='cancelar' class='btn btn-outline-danger col-5' onclick=\"onclick=\"window.location.href='http://localhost/picareta_leiloes/pages/cadastroMarca/cadastroMarca.php'\"\">Cancelar</button>
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

    <?php
    include './../../libs/authenticator.php';
    autenticar(2);
    ?>
    
</body>
</html>