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

                            $modeloSelecionado = executeQuery("SELECT mo.modeloId, mo.anoModelo, mo.descricao, ma.marcaId, ma.descricao as dsMarca FROM modelo mo INNER JOIN marca ma on mo.marcaId = ma.marcaId WHERE mo.modeloId = '$id'");

                            $modeloMarca = executeQuery("SELECT DISTINCT ma.marcaId, ma.descricao FROM marca ma LEFT JOIN modelo mo ON mo.marcaId = ma.marcaId order by case when mo.modeloId = '$id' then 0 else 1 end");

                            if($modeloSelecionado -> num_rows > 0) {
                                $modelo = $modeloSelecionado -> fetch_assoc();
                            }

                            $validateInput = "";
                            if ($modeloMarca -> num_rows > 0) {
                                while($row = $modeloMarca -> fetch_assoc()) {
                                    $validateInput = $validateInput . "<option value='" . $row["marcaId"] . "'>" . $row["descricao"] . "</option>";
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
                                            <input type='text' id='descricao' name='descricao' class='form-control' placeholder='Modelo*' value='" . $modelo["descricao"] . "' onblur='validateInput(this)' required>
                                        <div class='invalid-feedback' id='invalid-message-name'>Informe um nome de modelo válido.<br> <em>Ex: Astra</em></div>
                                        </div>
                                        <div class='col-3'>
                                            <input type='number' id='year' name='year' maxLength='4' class='form-control' placeholder='Ano Modelo*' value='" . $modelo["anoModelo"] . "' onblur='validateInput(this)' required>
                                        </div>
                                </div>
                                ";
                            }

                            echo "
                            <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                                <button type='submit' value='deletar' class='btn btn-outline-danger col-5'>Deletar</button>
                                <button type='submit' value='salvar' class='btn btn-outline-success col-5' onclick=\'checkAllFields('form')\; \window.location.href='./../../pages/index/index.php';'>Salvar</button>
                            </div>
                            ";

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                                $marcaId = $_POST['brand'];
                                $anoModelo = $_POST['year'];
                                $descricao = $_POST['descricao'];
                    
                                $modeloExistente = executeQuery("SELECT marcaId, anoModelo, descricao FROM modelo WHERE marcaId = '$marcaId' AND anoModelo = '$anoModelo' AND descricao = '$descricao'");
                    
                                if ($modeloExistente -> num_rows > 0) {
                                    toastr('error', 'Modelo já cadastrado.');
                                } else {
                                    executeQuery("UPDATE modelo SET marcaId = '$marcaId', anoModelo = '$anoModelo', descricao = '$descricao' WHERE modeloId = '$id'");
                                }
                    
                            }

                        } else {

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                                $marcaId = $_POST['brand'];
                                $anoModelo = $_POST['year'];
                                $descricao = $_POST['descricao'];
                    
                                $modeloExistente = executeQuery("SELECT marcaId, anoModelo, descricao FROM modelo WHERE marcaId = '$marcaId' AND anoModelo = '$anoModelo' AND descricao = '$descricao'");
                    
                                if ($modeloExistente -> num_rows > 0) {
                                    // Exibe mensagem de erro
                                    toastr('error', 'Modelo já cadastrado.');
                                } else {
                                    // Insere o novo registro na tabela modelo
                                    executeQuery("INSERT INTO modelo (marcaId, anoModelo, descricao) VALUES ('$marcaId','$anoModelo', '$descricao')");
                                }
                    
                            }

                            echo "
                            <div class='row justify-content-center mb-5'>
                                <div class='col-4 col-lg-3'>
                                    <select class='form-select' id='brand' name='brand' onblur='validateInput(this)' required>";                           

                                    $dadosMarca = executeQuery("SELECT marcaId, descricao FROM marca");

                                    if ($dadosMarca -> num_rows > 0) {
                                        // Loop para iterar pelos resultados
                                        while($row = $dadosMarca -> fetch_assoc()) {
                                            // Gera a opção com os dados do banco de dados
                                            echo "<option value='" . $row["marcaId"] . "'>" . $row["descricao"] . "</option>";
                                        }
                                    }

                                    echo "</select>
                                    <div class='invalid-feedback' id='invalid-message-brand'>Informe uma marca válida.</div>
                                    </div>
                                    <div class='col-6 col-lg-4'>
                                        <input type='text' id='descricao' name='descricao' class='form-control' placeholder='Modelo*' onblur='validateInput(this)' required>
                                        <div class='invalid-feedback' id='invalid-message-name'>Informe um nome de modelo válido.<br> <em>Ex: Astra</em></div>
                                    </div>
                                    <div class='col-3'>
                                        <input type='number' id='year' name='year' maxLength='4' class='form-control' placeholder='Ano Modelo*' onblur='validateInput(this)' required>
                                        <div class='invalid-feedback' id='invalid-message-year'>Informe um ano modelo válido.<br> <em>Ex: 2020</em></div>
                                    </div>
                                </div>
                                <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                                    <button type='button' value='cancelar' class='btn btn-outline-danger col-5' onclick=\'window.history.back()\'>Cancelar</button>
                                    <button type='submit' value='adicionar' class='btn btn-outline-success col-5' onclick=\'checkAllFields('form')\'>Adicionar</button>
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