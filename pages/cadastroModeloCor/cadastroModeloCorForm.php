<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastroModeloCorForm.scss">
    <script type="module" src="./cadastroModeloCorForm.js"></script>
    <title>Cadastro de Modelo Cor</title>
</head>
<body>

    <?php
    include './../../components/header/header.php';
    include './../../components/toastr/toastr.php';

    $id = $_GET['id'];
    if($id != '') {
        if (!isset($_GET['marcaId'])) {
            $modeloCor = executeQuery('SELECT mo.marcaId, ma.descricao as marcaDescricao, mo.descricao, mo.anoModelo, c.corId FROM MODELO MO INNER JOIN MARCA MA ON MA.marcaId = MO.marcaId INNER JOIN modelocor MC ON MC.modeloId = MO.modeloId INNER JOIN cor C ON C.corId = MC.corId WHERE MC.modeloCorId = ' . $_GET['id']);
            $modeloCor = mysqli_fetch_assoc($modeloCor);
            header("Location: http://localhost/picareta_leiloes/pages/cadastroModeloCor/cadastroModeloCorForm.php?id=$id&marcaId=" . $modeloCor['marcaId'] . "&descricaoModelo=" . $modeloCor['descricao'] . "&anoModelo=" . $modeloCor['anoModelo'] . "&corId=" . $modeloCor['corId'] . "");
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $modelo = $_POST['modelo'];
        $corId = $_POST['cor'];
        $ano = $_POST['ano'];
        $marcaId = $_POST['marca'];

        $modeloId = executeQuery("SELECT modeloId FROM modelo WHERE descricao = '$modelo' AND anoModelo = '$ano' AND marcaId = '$marcaId'");
        $modeloId = mysqli_fetch_assoc($modeloId);
        $modeloId = $modeloId['modeloId'];

        $modeloExistente = executeQuery("SELECT * FROM modeloCor mc INNER JOIN modelo mo ON mo.modeloId = mc.modeloId INNER JOIN marca ma ON ma.marcaId = mo.modeloId WHERE mc.modeloId = '$modeloId' AND mc.corId = '$corId'");
        $modeloExistente = mysqli_fetch_assoc($modeloExistente);
        $redirect = true;

        if (isset($_POST['adicionar'])) {
            if($modeloExistente != null) {
                toastr('error', 'Modelo Cor já cadastrado');
                $redirect = false;
            } else
                executeQuery("INSERT INTO MODELOCOR (modeloId, corId) VALUES ('$modeloId', '$corId')");
        }

        if (isset($_POST['salvar'])) {
            if($modeloExistente != null && $modeloExistente['modeloId'] != $_GET['id']) {
                toastr('error', 'Modelo Cor já cadastrado');
                $redirect = false;
            } else
                executeQuery("UPDATE MODELOCOR SET modeloId = '$modeloId', corId = '$corId' WHERE modeloCorId = '$id'");
        }

        if (isset($_POST['deletar'])) {
            $modeloCorSelecionado = executeQuery("SELECT v.modeloCorId FROM veiculo v INNER JOIN modeloCor mc on mc.modeloCorId = v.modeloCorId WHERE mc.modeloCorId = '$id'");
            if($modeloCorSelecionado -> num_rows > 0) {
                $modeloCorId = $modeloCorSelecionado -> fetch_assoc();
            }
            if(isset($modeloCorId)){
                toastr('error', 'Este modelo cor possui um veículo vinculado, não é possível excluí-lo.');
                $redirect = false;


            }else{
                executeQuery("DELETE FROM modeloCor WHERE modeloCorId = '$id'");
                toastr('success', 'Modelo cor excluido');
            }
        }

        if ($redirect)
            header("Location: http://localhost/picareta_leiloes/pages/cadastroModeloCor/cadastroModeloCor.php");

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
                <h2>Cadastro de Modelo Cor</h2>
            </div>

            <form class="row d-flex justify-content-center" id="form" action="" method="POST">

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <select class="form-select" name="marca" id="brand" onblur="validateInput(this)" onchange='parameterURL("marcaId", this.value)' required>
                            <?php
                            $marcaId = $_GET['marcaId'] ?? -1;
                            $selected = $marcaId == -1 ? "selected" : "";
                            echo "<option value='' disabled $selected hidden>Marca*</option>";
                            $selectMarcas = executeQuery('SELECT * FROM MARCA');
                            while ($row = mysqli_fetch_assoc($selectMarcas)) {
                                $selected = $marcaId == $row['marcaId'] ? "selected" : "";
                                echo "<option $selected value=" . $row['marcaId'] . ">" . $row['descricao'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-brand">Informe uma marca válida.</div>
                    </div>
                    <div class="col-6 col-lg-4">
                    <?php
                        $marcaId = $_GET['marcaId'] ?? -1;
                        $disabled = $marcaId == -1 ? "disabled" : "";
                        echo "<select class='form-select' id='model' $disabled name='modelo' onblur='validateInput(this)' onchange='parameterURL(\"descricaoModelo\", this.value)' required>";
                            $descricaoModelo = $_GET['descricaoModelo'] ?? -1;
                            $selected = $descricaoModelo == -1 ? "selected" : "";
                            echo "<option value='' disabled $selected hidden>Modelo*</option>";
                            $selectModelos = executeQuery('SELECT DISTINCT  descricao from MODELO where MARCAID = ' . $marcaId . '');
                            while ($row = mysqli_fetch_assoc($selectModelos)) {
                                $selected = $descricaoModelo == $row['descricao'] ? "selected" : "";
                                echo "<option $selected value=" . $row['descricao'] . ">" . $row['descricao'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-model">Informe um modelo válido.</div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <?php 
                            $descricaoModelo = $_GET['descricaoModelo'] ?? -1;
                            $disabled = $descricaoModelo == -1 ? "disabled" : "";
                        echo "<select class='form-select' id='year' name='ano' $disabled onblur='validateInput(this)' onchange='parameterURL(\"anoModelo\", this.value)' required>";
                            $anoModelo = $_GET['anoModelo'] ?? -1;
                            $selected = $anoModelo == -1 ? "selected" : "";
                            echo "<option value='' disabled $selected hidden>Ano Modelo*</option>";
                            $selectModelos = executeQuery('SELECT * FROM MODELO WHERE DESCRICAO = "' . $descricaoModelo . '"');
                            while ($row = mysqli_fetch_assoc($selectModelos)) {
                                $selected = $anoModelo == $row['anoModelo'] ? "selected" : "";
                                echo "<option $selected value=" . $row['anoModelo'] . ">" . $row['anoModelo'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-year">Informe um ano modelo válido.</div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <select class="form-select" id="color" name="cor" onblur="validateInput(this)" onchange='parameterURL("corId", this.value)' required>
                            <?php 
                            $marcaId = $_GET['marcaId'] ?? -1;
                            $descricaoModelo = $_GET['descricaoModelo'] ?? -1;
                            $anoModelo = $_GET['anoModelo'] ?? -1;
                            $corId = $_GET['corId'] ?? -1;
                            $selected = $corId == -1 ? "selected" : "";
                            echo "<option value='' disabled $selected hidden>Cor*</option>";
                            $selectCoresModelo = executeQuery('SELECT * FROM COR');
                            while ($row = mysqli_fetch_assoc($selectCoresModelo)) {
                                $selected = $corId == $row['corId'] ? "selected" : "";
                                echo "<option $selected value=" . $row['corId'] . ">" . $row['Descricao'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-color">Informe uma cor válida.</div>
                    </div>
                </div>
                
                <?php 
                    if (isset($_GET["id"]))
                        $id = $_GET["id"];

                        if (isset($id) && $id != "") {
                            echo "
                            <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                                <button type='submit' name='deletar' class='btn btn-outline-danger col-5'>Deletar</button>
                                <button type='submit' name='salvar' class='btn btn-outline-success col-5' onclick=\"checkAllFields('form')\">Salvar</button>
                            </div>
                            ";
                        } else {
                            echo "
                            <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                                <button type='button' name='cancelar' class='btn btn-outline-danger col-5' onclick=\"window.location.href='http://localhost/picareta_leiloes/pages/cadastroModeloCor/cadastroModeloCor.php'\">Cancelar</button>
                                <button type='submit' name='adicionar' class='btn btn-outline-success col-5' onclick=\"checkAllFields('form')\">Adicionar</button>
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