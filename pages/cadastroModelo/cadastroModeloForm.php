<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='cadastroModeloForm.scss'>
    <script type='module' src='./cadastroModeloForm.js'></script>
    <title>Cadastro de Modelo</title>
</head>
<body>

    <?php
        include './../../components/header/header.php';
        include './../../components/toastr/toastr.php';

        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $marcaId = trim($_POST['brand']);
            $anoModelo = trim($_POST['year']);
            $descricao = trim($_POST['descricao']);

            $modeloExistente = executeQuery("SELECT marcaId, modeloId, anoModelo, descricao FROM modelo WHERE marcaId = '$marcaId' AND anoModelo = '$anoModelo' AND descricao = '$descricao'");

            $redirect = true;

            if(!empty($marcaId) && !empty($anoModelo) && !empty($descricao)) {

                if(isset($_POST["adicionar"])) {
                    if ($modeloExistente -> num_rows > 0) {
                        toastr('error', 'Modelo já cadastrado.');
                        $redirect = false;
                    } else {
                        executeQuery("INSERT INTO modelo (marcaId, anoModelo, descricao) VALUES ('$marcaId','$anoModelo', '$descricao')");
                    }
                }

                if(isset($_POST['salvar'])) {
                    if ($modeloExistente -> num_rows > 0) {
                        toastr('error', 'Modelo já cadastrado.');
                        $redirect = false;
                    } else {
                        executeQuery("UPDATE modelo SET marcaId = '$marcaId', anoModelo = '$anoModelo', descricao = '$descricao' WHERE modeloId = '$id'");
                        toastr('success', 'Modelo atualizado!');
                    }
                }

            } else {
                $redirect = false;
                toastr('error', 'Nenhum campo deve ser vazio.');
            }

            if (isset($_POST['deletar'])) {
                $modeloIdSelecionado = executeQuery("SELECT v.modeloId FROM veiculo v INNER JOIN modelo m ON m.modeloId = v.ModeloId WHERE m.modeloId = '$id'");
                if($modeloIdSelecionado -> num_rows > 0) {
                    $modeloId = $modeloIdSelecionado -> fetch_assoc();
                }
                if(isset($modeloId)){
                    toastr('error', 'Este modelo possui um veículo vinculado, não é possível excluí-lo.');
                    $redirect = false;
                }
                else{
                    executeQuery("DELETE FROM modelo WHERE modeloId = '$id'");
                    toastr('success', 'Modelo excluído');
                }
            }
    
            if ($redirect) {
                header("Location: http://localhost/picareta_leiloes/pages/cadastroModelo/cadastroModelo.php");
            }
        }
    ?>
    
    <div class='content'>

        <div class='left'>
            <?php
            include './../../components/sidebar/sidebar.php';
            ?>
        </div>

        <div class='right'>

            <div class='d-flex justify-content-center my-5'>
                <h2>Cadastro de Modelo</h2>
            </div>

            <form class='row d-flex justify-content-center' id='form' action="" method='POST'>
                
                <?php 
                    if (isset($_GET['id']))
                        $id = $_GET['id'];

                        if (isset($id) && $id != "") {
                            $modeloMarca = executeQuery("SELECT ma.marcaId, ma.descricao, mo.modeloId, mo.anoModelo, mo.descricao AS descModelo FROM marca ma LEFT JOIN modelo mo ON mo.marcaId = ma.marcaId ORDER BY CASE WHEN mo.modeloId = '$id' THEN 0 ELSE 1 END");

                            // echo "<script>console.log('".$id."');</script>";

                            $validateInput = "";
                            $isFirstRow = true;
                            if ($modeloMarca -> num_rows > 0) {
                                while($row = $modeloMarca -> fetch_assoc()) {
                                    if ($isFirstRow) {
                                        $modelo = $row;
                                        $isFirstRow = false;
                                    }
                                    if (!str_contains($validateInput, $row["descricao"])) {
                                        $validateInput = $validateInput . "<option value='" . $row["marcaId"] . "'>" . $row["descricao"] . "</option>";
                                    }
                                }
                            }

                            if (isset($modelo)) {
                                echo "
                                <div class='row justify-content-center mb-5'>
                                    <div class='col-4 col-lg-3'>
                                    <select class='form-select' id='brand' name='brand' onblur='validateInput(this)' required>
                                        " . $validateInput . "
                                    </select>
                                        <div class='invalid-feedback' id='invalid-message-brand'>Informe uma marca válida.</div>
                                    </div>

                                    <div class='col-6 col-lg-4'>
                                        <input type='text' id='model' name='descricao' class='form-control' placeholder='Modelo*' value='" . $modelo["descModelo"] . "' onblur='validateInput(this)' required>
                                        <div class='invalid-feedback' id='invalid-message-name'>Informe um nome de modelo válido.<br> <em>Ex: Astra</em></div>
                                    </div>
                                    <div class='col-3'>
                                        <input type='number' id='year' name='year' maxLength='4' class='form-control' placeholder='Ano Modelo*' value='" . $modelo["anoModelo"] . "' onblur='validateInput(this)' required>
                                        <div class='invalid-feedback' id='invalid-message-year'>Informe um ano modelo válido.<br> <em>Ex: 2020</em></div>
                                    </div>
                                </div>
                                ";
                            }

                            echo "
                            <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                            <button type='submit' name='deletar' class='btn btn-outline-danger col-5'>Deletar</button>
                                <button type='submit' value='salvar' name='salvar' class='btn btn-outline-success col-5' onclick=\"checkAllFields('form')\">Salvar</button>
                            </div>
                            ";

                        } else {

                            echo "
                            <div class='row justify-content-center mb-5'>
                                <div class='col-4 col-lg-3'>
                                    <select class='form-select' id='brand' name='brand' onblur='validateInput(this)' required>";                           

                                    $dadosMarca = executeQuery("SELECT marcaId, descricao FROM marca");

                                    if ($dadosMarca -> num_rows > 0) {
                                        while($row = $dadosMarca -> fetch_assoc()) {
                                            echo "<option value='" . $row["marcaId"] . "'>" . $row["descricao"] . "</option>";
                                        }
                                    }

                                    echo "</select>
                                    <div class='invalid-feedback' id='invalid-message-brand'>Informe uma marca válida.</div>
                                    </div>
                                    <div class='col-6 col-lg-4'>
                                        <input type='text' id='model' name='descricao' class='form-control' placeholder='Modelo*' onblur='validateInput(this)' required>
                                        <div class='invalid-feedback' id='invalid-message-name'>Informe um nome de modelo válido.<br> <em>Ex: Astra</em></div>
                                    </div>
                                    <div class='col-3'>
                                        <input type='number' id='year' name='year' maxLength='4' class='form-control' placeholder='Ano Modelo*' onblur='validateInput(this)' required>
                                        <div class='invalid-feedback' id='invalid-message-year'>Informe um ano modelo válido.<br> <em>Ex: 2020</em></div>
                                    </div>
                                </div>
                                <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                                <button type='button' value='cancelar' class='btn btn-outline-danger col-5' onclick=\"window.location.href='http://localhost/picareta_leiloes/pages/cadastroModelo/cadastroModelo.php'\">Cancelar</button>
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
        include './../../libs/authenticator.php';
        autenticar(2);

        
    ?>
    
</body>
</html>