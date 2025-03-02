<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastroLoteForm.scss">
    <script type="module" src="./cadastroLoteForm.js"></script>
    <title>Cadastro de Lote</title>
</head>
<body>

    <?php
    include './../../components/header/header.php';
    include './../../components/toastr/toastr.php';


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $loteId = $_GET['id'] == '' ? -1 : $_GET['id'];
        $leilaoId = $_POST['leilao'];
        $valorInicial = floatval(str_replace(",", ".", str_replace("R$", "", $_POST['inicialValue'])));
        $valorIncremento = floatval(str_replace(",", ".", str_replace("R$", "", $_POST['incrementValue'])));
        $financeiraId = $_POST['financeira'];
        $veiculoId = $_POST['veiculo'];


        $frontalBlob = null;

        if (isset($_FILES['frontal']) && strtolower(pathinfo($_FILES['frontal']['name'], PATHINFO_EXTENSION) != null)) {
            
            $tipoImagem = strtolower(pathinfo($_FILES['frontal']['name'], PATHINFO_EXTENSION));
            if ($tipoImagem != "jpg" && $tipoImagem != "jpeg" && $tipoImagem != "png") {
                toastr("error", "Formato de imagem inválido. Apenas JPG, JPEG e PNG são aceitos.");
            } else {
                $imagemTemp = $_FILES['frontal']['tmp_name'];
                $frontalBlob = addslashes(file_get_contents($imagemTemp));
                
            }
        }
        $traseiraBlob = null;

        if (isset($_FILES['traseira']) && strtolower(pathinfo($_FILES['traseira']['name'], PATHINFO_EXTENSION) != null)) {

            $tipoImagem = strtolower(pathinfo($_FILES['traseira']['name'], PATHINFO_EXTENSION));
            if ($tipoImagem != "jpg" && $tipoImagem != "jpeg" && $tipoImagem != "png") {
                toastr("error", "Formato de imagem inválido. Apenas JPG, JPEG e PNG são aceitos.");
            } else {
                $imagemTemp = $_FILES['traseira']['tmp_name'];
                $traseiraBlob = addslashes(file_get_contents($imagemTemp));
            }
        }
        $lateralEsquerdaBlob = null;

        if (isset($_FILES['lateralEsquerda']) && strtolower(pathinfo($_FILES['lateralEsquerda']['name'], PATHINFO_EXTENSION) != null)) {

            $tipoImagem = strtolower(pathinfo($_FILES['lateralEsquerda']['name'], PATHINFO_EXTENSION));
            if ($tipoImagem != "jpg" && $tipoImagem != "jpeg" && $tipoImagem != "png") {
                toastr("error", "Formato de imagem inválido. Apenas JPG, JPEG e PNG são aceitos.");
            } else {
                $imagemTemp = $_FILES['lateralEsquerda']['tmp_name'];
                $lateralEsquerdaBlob = addslashes(file_get_contents($imagemTemp));
            }
        }

        $lateralDireitaBlob = null;

        if (isset($_FILES['lateralDireita']) && strtolower(pathinfo($_FILES['lateralDireita']['name'], PATHINFO_EXTENSION) != null)) {

            $tipoImagem = strtolower(pathinfo($_FILES['lateralDireita']['name'], PATHINFO_EXTENSION));
            if ($tipoImagem != "jpg" && $tipoImagem != "jpeg" && $tipoImagem != "png") {
                toastr("error", "Formato de imagem inválido. Apenas JPG, JPEG e PNG são aceitos.");
            } else {
                $imagemTemp = $_FILES['lateralDireita']['tmp_name'];
                $lateralDireitaBlob = addslashes(file_get_contents($imagemTemp));
            }
        }

        $interiorBlob = null;

        if (isset($_FILES['interior']) && strtolower(pathinfo($_FILES['interior']['name'], PATHINFO_EXTENSION) != null)) {

            $tipoImagem = strtolower(pathinfo($_FILES['interior']['name'], PATHINFO_EXTENSION));
            if ($tipoImagem != "jpg" && $tipoImagem != "jpeg" && $tipoImagem != "png") {
                toastr("error", "Formato de imagem inválido. Apenas JPG, JPEG e PNG são aceitos.");
            } else {
                $imagemTemp = $_FILES['interior']['tmp_name'];
                $interiorBlob = addslashes(file_get_contents($imagemTemp));
            }
        }

        $painelBlob = null;
        
        if (isset($_FILES['painel']) && strtolower(pathinfo($_FILES['painel']['name'], PATHINFO_EXTENSION) != null)) {

            $tipoImagem = strtolower(pathinfo($_FILES['painel']['name'], PATHINFO_EXTENSION));
            if ($tipoImagem != "jpg" && $tipoImagem != "jpeg" && $tipoImagem != "png") {
                toastr("error", "Formato de imagem inválido. Apenas JPG, JPEG e PNG são aceitos.");
            } else {
                $imagemTemp = $_FILES['painel']['tmp_name'];
                $painelBlob = addslashes(file_get_contents($imagemTemp));
            }
        }

        $motorBlob = null;
        
        if (isset($_FILES['motor']) && strtolower(pathinfo($_FILES['motor']['name'], PATHINFO_EXTENSION) != null)) {

            $tipoImagem = strtolower(pathinfo($_FILES['motor']['name'], PATHINFO_EXTENSION));
            if ($tipoImagem != "jpg" && $tipoImagem != "jpeg" && $tipoImagem != "png") {
                toastr("error", "Formato de imagem inválido. Apenas JPG, JPEG e PNG são aceitos.");
            } else {
                $imagemTemp = $_FILES['motor']['tmp_name'];
                $motorBlob = addslashes(file_get_contents($imagemTemp));
            }
        }


        $redirect = true;

        
        if(isset($_POST["deletar"])){
            $lanceExistente = executeQuery("SELECT * FROM lance WHERE loteId = '$loteId'");
            if(mysqli_num_rows($lanceExistente) > 0){
                toastr('error', 'Já foi dado lance nesse lote, não é possivel remove-lo.');
                $redirect = false;
            }
            else
                executeQuery("DELETE FROM lote WHERE `loteId` = '$loteId'");
        }
        if(isset($_POST["adicionar"])){
            $veiculoExistente = executeQuery("SELECT * FROM lote WHERE veiculoId = '$veiculoId' and leilaoId = '$leilaoId'");
            if(mysqli_num_rows($veiculoExistente) > 0){
                toastr('error', 'Veiculo já cadastrado em um lote.');
                $redirect = false;
            }
            else{
                executeQuery("INSERT INTO lote( leilaoId, valorInicial, valorIncremento, financeiraId, veiculoId) VALUES ('$leilaoId','$valorInicial','$valorIncremento','$financeiraId','$veiculoId')");
                echo "<script>console.log('$frontalBlob')</script>";
                executeQuery("INSERT INTO imagemveiculo (veiculoId, imagem, tipoImagem) VALUES ('$veiculoId', '$frontalBlob', 1)");
                executeQuery("INSERT INTO imagemveiculo (veiculoId, imagem, tipoImagem) VALUES ('$veiculoId', '$traseiraBlob', 2)");
                executeQuery("INSERT INTO imagemveiculo (veiculoId, imagem, tipoImagem) VALUES ('$veiculoId', '$lateralEsquerdaBlob', 3)");
                executeQuery("INSERT INTO imagemveiculo (veiculoId, imagem, tipoImagem) VALUES ('$veiculoId', '$lateralDireitaBlob', 4)");
                executeQuery("INSERT INTO imagemveiculo (veiculoId, imagem, tipoImagem) VALUES ('$veiculoId', '$interiorBlob', 5)");
                executeQuery("INSERT INTO imagemveiculo (veiculoId, imagem, tipoImagem) VALUES ('$veiculoId', '$painelBlob', 6)");
                executeQuery("INSERT INTO imagemveiculo (veiculoId, imagem, tipoImagem) VALUES ('$veiculoId', '$motorBlob', 7)");

            }
        }
        if(isset($_POST["salvar"])){
            $veiculoExistente = executeQuery("SELECT * FROM lote WHERE veiculoId = '$veiculoId' and loteId != '$loteId'");
            if(mysqli_num_rows($veiculoExistente) > 0){
                toastr('error', 'Veiculo já cadastrado em um lote.');
                $redirect = false;
            }
            else{
                executeQuery("UPDATE lote SET leilaoId='$leilaoId',valorInicial='$valorInicial',valorIncremento='$valorIncremento',financeiraId='$financeiraId',veiculoId='$veiculoId' WHERE `loteId` = '$loteId'");
                executeQuery("UPDATE imagemveiculo SET imagem='$frontalBlob' WHERE `veiculoId` = '$veiculoId' and `tipoImagem` = 1");
                executeQuery("UPDATE imagemveiculo SET imagem='$traseiraBlob' WHERE `veiculoId` = '$veiculoId' and `tipoImagem` = 2");
                executeQuery("UPDATE imagemveiculo SET imagem='$lateralEsquerdaBlob' WHERE `veiculoId` = '$veiculoId' and `tipoImagem` = 3");
                executeQuery("UPDATE imagemveiculo SET imagem='$lateralDireitaBlob' WHERE `veiculoId` = '$veiculoId' and `tipoImagem` = 4");
                executeQuery("UPDATE imagemveiculo SET imagem='$interiorBlob' WHERE `veiculoId` = '$veiculoId' and `tipoImagem` = 5");
                executeQuery("UPDATE imagemveiculo SET imagem='$painelBlob' WHERE `veiculoId` = '$veiculoId' and `tipoImagem` = 6");
                executeQuery("UPDATE imagemveiculo SET imagem='$motorBlob' WHERE `veiculoId` = '$veiculoId' and `tipoImagem` = 7");
            }
        }
        
        
        if ($redirect)
            header("Location: http://localhost/picareta_leiloes/pages/cadastroLote/cadastroLote.php");
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
                <h2>Cadastro de Lote</h2>
            </div>

            <form class="row d-flex justify-content-center" id="form" action="" method="POST" enctype="multipart/form-data">

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
                    <div class="col-4 col-lg-4">
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
                                echo "<option $selected value='" . $row['descricao'] . "'>" . $row['descricao'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-model">Informe um modelo válido.</div>
                    </div>
                    <div class="col-4 col-lg-2">
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
                                echo "<option $selected value='" . $row['anoModelo'] . "'>" . $row['anoModelo'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-year">Informe um ano modelo válido.</div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                <div class="col-4 col-lg-3">
                    <?php 
                        $anoModelo = $_GET['anoModelo'] ?? -1;
                        $modeloCorId = $_GET['modeloCorId'] ?? -1;
                        $disabled = $anoModelo == -1 ? "disabled" : "";
                       echo "<select class='form-select' id='color' name='modeloCorId' $disabled onblur='validateInput(this)' onchange='parameterURL(\"modeloCorId\", this.value)' required>";
                            $marcaId = $_GET['marcaId'] ?? -1;
                            $descricaoModelo = $_GET['descricaoModelo'] ?? -1;
                            $corId = $_GET['corId'] ?? -1;
                            $selected = $corId == -1 ? "selected" : "";
                            echo "<option value='' disabled $selected hidden>Cor*</option>";
                            $selectCoresModelo = executeQuery('SELECT mc.modeloCorId, c.descricao as descricaoCor FROM modelocor mc inner join modelo m on m.modeloId = mc.modeloId inner join cor c on mc.corId = c.corId where m.descricao = "' . $descricaoModelo . '" and m.marcaId = ' . $marcaId . ' and m.anoModelo = ' . $anoModelo . '');
                            while ($row = mysqli_fetch_assoc($selectCoresModelo)) {
                                $selected = $modeloCorId == $row['modeloCorId'] ? "selected" : "";
                                echo "<option $selected value='" . $row['modeloCorId'] . "'>" . $row['descricaoCor'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-color">Informe uma cor válida.</div>
                    </div>
                    <div class="col-3 col-lg-3">
                    <?php 
                        $modeloCorId = $_GET['modeloCorId'] ?? -1;
                        $disabled = $modeloCorId == -1 ? "disabled" : "";
                       echo "<select class='form-select' id='licensePlateSelect' name='veiculo' $disabled onblur='validateInput(this)' onchange='parameterURL(\"veiculoId\", this.value)' required>";
                            $veiculoId = $_GET['veiculoId'] ?? -1;
                            $selected = $veiculoId == -1 ? "selected" : "";
                            echo "<option value='' disabled $selected hidden>Placa*</option>";
                            $selectPlacas = executeQuery('SELECT v.veiculoId, v.placa FROM veiculo v inner join modelocor mc on v.modeloCorId = mc.modeloCorId where mc.modeloCorId = ' . $modeloCorId . '');
                            while ($row = mysqli_fetch_assoc($selectPlacas)) {
                                $selected = $veiculoId == $row['veiculoId'] ? "selected" : "";
                                echo "<option $selected value='" . $row['veiculoId'] . "'>" . $row['placa'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-licensePlateSelect">Informe uma placa válida.</div>
                    </div>
                    <div class="col-5 col-lg-3">
                    <?php 
                            $loteId = $_GET['id'] == '' ? -1 : $_GET['id'];
                            $lote  = executeQuery('SELECT * FROM lote where loteId = ' . $loteId . '');
                            $lote = mysqli_fetch_assoc($lote);

                            echo "<select class='form-select' id='auctionDateSelect' name='leilao' onblur='validateInput(this)' required>";
                            
                            $selected = $loteId == -1 ? "selected" : "";
                            echo "<option value='' disabled $selected hidden>Leilao*</option>";
                            $selectLeiloes = executeQuery('SELECT leilaoId, DATE_FORMAT(dataLeilao, "%d/%m/%Y %H:%i:%s") as dataLeilao from leilao');
                            while ($row = mysqli_fetch_assoc($selectLeiloes)) {
                                $selected = $lote['leilaoId'] == $row['leilaoId'] ? "selected" : "";
                                echo "<option $selected value='" . $row['leilaoId'] . "'>" . "L." . $row['leilaoId'] . " " . $row['dataLeilao'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-auctionDateSelect">Informe uma data do leilão válida.</div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                <div class="col-6 col-lg-3">
                            <?php
                                $loteId = $_GET['id'] == '' ? -1 : $_GET['id'];
                                $lote  = executeQuery('SELECT * FROM lote where loteId = ' . $loteId . '');
                                $lote = mysqli_fetch_assoc($lote);

                                echo "<select class='form-select' id='financial' name='financeira' onblur='validateInput(this)' required>";
                            
                            $selected = $loteId == -1 ? "selected" : "";
                            echo "<option value='' disabled $selected hidden>Financeira*</option>";
                            $selectFinanceiras = executeQuery('SELECT * from financeira');
                            while ($row = mysqli_fetch_assoc($selectFinanceiras)) {
                                $selected = $lote['financeiraId'] == $row['financeiraId'] ? "selected" : "";
                                echo "<option $selected value='" . $row['financeiraId'] . "'>" . $row['descricaoFinanceira'] . "</option>";
                            }
                            ?>

                            
                        </select>
                        <div class="invalid-feedback" id="invalid-message-financial">Informe uma Financeira válida.</div>
                    </div>
                    <div class="col-3 col-lg-3">
                        <input type="text" id="initialValue" name='inicialValue' class="form-control" placeholder="Valor Inicial*" value="<?php 
                            $loteId = $_GET['id'] == '' ? -1 : $_GET['id'];
                            $lote  = executeQuery('SELECT * FROM lote where loteId = ' . $loteId . '');
                            $lote = mysqli_fetch_assoc($lote);

                            if ($loteId != -1) {
                                echo "R$" . str_replace(".", ",", $lote['valorInicial']);
                            }
                         ?>"
                          onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-initialValue">Informe um valor inicial válido.<br> <em>Ex: R$1000</em></div>
                    </div>
                    <div class="col-3 col-lg-3">
                        <input type="text" id="incrementalValue" name='incrementValue' class="form-control" placeholder="Valor Incremento*" value="<?php 
                            $loteId = $_GET['id'] == '' ? -1 : $_GET['id'];
                            $lote  = executeQuery('SELECT * FROM lote where loteId = ' . $loteId . '');
                            $lote = mysqli_fetch_assoc($lote);

                            if ($loteId != -1) {
                                echo "R$" . str_replace(".", ",", $lote['valorIncremento']);
                            }
                         ?>" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-incrementalValue">Informe um valor incremento válido.<br> <em>Ex: R$1000</em></div>
                    </div>
                    
                </div>
                 <div class="row justify-content-center mb-5 gap-4">
                    <div class="col-3 col-lg-2 col-lg-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="frontal" id="frontalFoto" accept="image/*" <?php echo     isset($_GET['id']) ? '' : 'required';  ?> >
                            <label class="custom-file-label" for="frontalFoto">Frontal</label>
                        </div>
                    </div>
                    <div class="col-3 col-lg-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="traseira" id="traseiraFoto" accept="image/*">
                            <label class="custom-file-label" for="traseiraFoto">Traseira</label>
                        </div>
                    </div>
                    <div class="col-3 col-lg-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="lateralEsquerda" id="lateralEsquerdaFoto" accept="image/*">
                            <label class="custom-file-label" for="lateralEsquerdaFoto">Lateral Esquerda</label>
                        </div>
                    </div>
                    <div class="col-3 col-lg-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="lateralDireita" id="lateralDireitaFoto" accept="image/*">
                            <label class="custom-file-label" for="lateralDireitaFoto">Lateral Direita</label>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5 gap-4">
                    <div class="col-3 col-lg-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="interior" id="interiorFoto" accept="image/*">
                            <label class="custom-file-label" for="interiorFoto">Interior</label>
                        </div>
                    </div>
                    <div class="col-3 col-lg-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="painel" id="painelFoto" accept="image/*">
                            <label class="custom-file-label" for="painelFoto">Painel</label>
                        </div>
                    </div>
                    <div class="col-3 col-lg-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="motor" id="motorFoto" accept="image/*">
                            <label class="custom-file-label" for="motorFoto">Motor</label>
                        </div>
                    </div>
                </div>
                
                <?php 
                    if (isset($_GET["id"])) {
                 
                        $id = $_GET["id"];

                        if (isset($id) && $id != "") {
                            echo "

                            <div class='col-6 col-lg-3 mx-auto my-3 d-flex justify-content-around'>
                                
                            <!-- Button trigger modal -->
                                <button type='button' class='btn btn-outline-danger col-5' data-toggle='modal' data-target='#exampleModal'>
                                Deletar
                                </button>

                                <!-- Modal -->
                                <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLabel'>Excluir Lote</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Cancelar'>
                                        <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                        Tem certeza que deseja excluir o lote selecionado?
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='submit' value='deletar' name='deletar' class='btn btn-outline-danger'>Deletar</button>
                                        <button type='button' class='btn btn-primary' data-dismiss='modal'>Cancelar</button>
                                    </div>
                                    </div>
                                </div>
                                </div>

                                <button type='submit' value='salvar' name='salvar' class='btn btn-outline-success col-5' onclick=\"checkAllFields('form')\">Salvar</button>
                            </div>
                            ";
                        } else {
                            echo "
                            <div class='col-6 col-lg-3 mx-auto d-flex justify-content-around'>
                                <button type='button' value='cancelar' name='cancelar' class='btn btn-outline-danger col-5' onclick=\"window.location.href='http://localhost/picareta_leiloes/pages/cadastroLote/cadastroLote.php'\">Cancelar</button>
                                <button type='submit' value='adicionar' name='adicionar' class='btn btn-outline-success col-5' onclick=\"checkAllFields('form')\">Adicionar</button>
                            </div>
                            ";
                        }
                    }
                    $id = $_GET['id'];
                    if($id != '') {
                        if (!isset($_GET['marcaId'])) {
                            $lote = executeQuery('SELECT mo.marcaId, ma.descricao as marcaDescricao, mo.descricao, mo.anoModelo, mc.modeloCorId, ve.veiculoId FROM lote lo INNER JOIN veiculo ve on ve.veiculoId = lo.veiculoId inner join modelocor mc on mc.modeloCorId = ve.modeloCorId inner join modelo mo on mo.modeloId = mc.modeloId inner join marca ma on ma.marcaId = mo.marcaId where lo.loteId =  ' . $_GET['id']);
                            $lote = mysqli_fetch_assoc($lote);
                            header("Location: http://localhost/picareta_leiloes/pages/cadastroLote/cadastroLoteForm.php?id=$id&marcaId=" . $lote['marcaId'] . "&descricaoModelo=" . $lote['descricao'] . "&anoModelo=" . $lote['anoModelo'] . "&modeloCorId=" . $lote['modeloCorId'] . "&veiculoId=" . $lote['veiculoId'] . "");
                        }
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