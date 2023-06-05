<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastroVeiculoForm.scss">
    <script type="module" src="./cadastroVeiculoForm.js"></script>
    <title>Cadastro de Veiculo</title>
</head>
<body>

    <?php
    include './../../components/header/header.php';
    include './../../components/toastr/toastr.php';

    $id = $_GET['id'];

    if($id != '') {
        if (!isset($_GET['marcaId'])) {
            // $veiculo = executeQuery('SELECT mo.modeloId, mo.marcaId, ma.descricao as dsMarca, mo.descricao AS dsModelo, mo.anoModelo, c.corId FROM modelo mo INNER JOIN marca ma ON MA.marcaId = MO.marcaId INNER JOIN modelocor mc ON mc.modeloId = mo.modeloId INNER JOIN cor co ON co.corId = mc.corId WHERE mc.modeloCorId = ' . $_GET['id']);

            $veiculo = executeQuery("SELECT mo.modeloId, mo.marcaId, ma.descricao AS dsMarca, mo.descricao AS dsModelo, mo.anoModelo, co.corId, co.descricao AS dsCor, ve.chassi, ve.placa, ve.hodometro, ve.observacao, ve.direcao, ve.cambioAutomatico, ve.vidroEletrico, ve.tipoCombustivel, ve.kitGnv, ve.arCondicionado, ve.kitMultimidia, ve.valorDespesas, ve.ipvaQuitado, ve.documentoParaRodar, ve.anoFabricacao, ve.sinistro FROM veiculo ve 
            INNER JOIN modelocor mc ON ve.modeloCorId = mc.modeloCorId
            INNER JOIN cor co ON mc.corId = co.corId
            INNER JOIN modelo mo ON mc.modeloId = mo.modeloId
            INNER JOIN marca ma ON mo.marcaId = ma.marcaId WHERE ve.veiculoId = " . $_GET['id']);

            // while($row = mysqli_fetch_assoc($veiculo)) {
            //     echo "<script>console.log(".json_encode($veiculo).");</script>";
            // }

            $veiculo = mysqli_fetch_assoc($veiculo);

            // echo "<script>console.log(id=$id&marcaId=" . $veiculo['marcaId'] . "&descricaoModelo=" . $veiculo['descricao'] . "&anoModelo=" . $veiculo['anoModelo'] . "&modeloId=" . $veiculo['modeloId'] . "&corId=" . $veiculo['corId'] . ");</script>";

            //id=&marcaId=1&descricaoModelo=PALIO+GS&modelIdAndYear=1a2019&colorId=1yVERMELHO+ALPISTE+DE+URUBU   &modelIdAndYear=1a2019&colorId=1yVERMELHO%20ALPISTE%20DE%20URUBU
            header("Location: http://localhost/picareta_leiloes/pages/cadastroVeiculo/cadastroVeiculoForm.php?id=$id&marcaId=" . $veiculo['marcaId'] . "&descricaoModelo=" . $veiculo['dsModelo'] . "&anoModelo=" . $veiculo['anoModelo'] . "&modeloId=" . $veiculo['modeloId'] . "&dsCor=" . $veiculo['dsCor'] . "&chassi=" . $veiculo['chassi'] . "&placa=" . $veiculo['placa'] . "&hodometro=" . $veiculo['hodometro'] . "&observacao=" . $veiculo['observacao'] . "&direcao=" . $veiculo['direcao'] . "&cambioAutomatico=" . $veiculo['cambioAutomatico'] . "&vidroEletrico=" . $veiculo['vidroEletrico'] . "&tipoCombustivel=" . $veiculo['tipoCombustivel'] . "&kitGnv=" . $veiculo['kitGnv'] . "&arCondicionado=" . $veiculo['arCondicionado'] . "&kitMultimidia=" . $veiculo['kitMultimidia'] . "&valorDespesas=" . $veiculo['valorDespesas'] . "&ipvaQuitado=" . $veiculo['ipvaQuitado'] . "&documentoParaRodar=" . $veiculo['documentoParaRodar'] . "&anoFabricacao=" . $veiculo['anoFabricacao'] . "&sinistro=" . $veiculo['sinistro'] ."&modelIdAndYear=" . $veiculo['modeloId'] . "a" . $veiculo['anoModelo'] . "&colorId=" . $veiculo['corId'] . "y" . $veiculo['dsCor']);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $modelIdAndYear = explode('[a.-]', $_GET['modelIdAndYear']);
        $modelo = $modelIdAndYear[0] ?? NULL;
        $anoModelo = $modelIdAndYear[1] ?? NULL;
        $corId = explode('[y.-]', $_GET['colorId']);
        $cor = $corId[0] ?? NULL;
        $marca = $_POST['brand'];
        $placa = $_POST['licensePlate'];
        $chassi = $_POST['chassis'];
        $hodometro = $_POST['odometer'];
        $complemento = $_POST['complement'] ?? '';
        $direcao = $_POST['steering'];
        $combustivel = $_POST['fuel'];
        $anoFabricacao = $_POST['yearFab'];
        $transmissao = isset($_POST['transmission']) ? 1 : 0;
        $vidroEletrico = isset($_POST['window']) ? 1 : 0;
        $gnv = isset($_POST['gnv']) ? 1 : 0;
        $arCondicionado = isset($_POST['air']) ? 1 : 0;
        $multimidia = isset($_POST['multimidia']) ? 1 : 0;
        $ipva = isset($_POST['ipva']) ? 1 : 0;
        $documentoParaRodar = isset($_POST['readyRode']) ? 1 : 0;
        $sinistro = isset($_POST['sinistro']) ? 1 : 0;
        $cambioAutomatico = isset($_POST['transmission']) ? 1 : 0;
        $despesas = floatval(str_replace(",", ".", str_replace("R$", "", $_POST['expenses'])));
        $veiculoExistente = executeQuery("SELECT ve.veiculoId, ve.chassi, ve.placa FROM veiculo ve WHERE ve.chassi = '$chassi' OR ve.placa = '$placa'");

        $modeloCorId = executeQuery("SELECT modeloCorId FROM modelocor WHERE modeloId = '$modelo[0]' AND corId = '$cor[0]'");
        $modeloCorId = mysqli_fetch_assoc($modeloCorId);
        $modeloCorId = implode($modeloCorId);
        echo "<script>console.log(".json_encode($modeloCorId).");</script>";

        $veiculoExistente = mysqli_fetch_assoc($veiculoExistente);
        $redirect = true;

        if (isset($_POST['adicionar'])) {
            if($veiculoExistente != null) {
                toastr('error', 'Veículo com chassi ou placa já cadastrados');
                $redirect = false;
            } else
                executeQuery("INSERT INTO veiculo (chassi, placa, modeloCorId,  hodometro, observacao, direcao, cambioAutomatico, vidroEletrico, tipoCombustivel, kitGnv, arCondicionado, kitMultimidia, valorDespesas, ipvaQuitado, documentoParaRodar, anoFabricacao, sinistro) 
                VALUES ('$chassi', '$placa', '$modeloCorId', $hodometro, '$complemento', '$direcao', '$transmissao', '$vidroEletrico', '$combustivel', '$gnv', '$arCondicionado', '$multimidia', '$despesas', '$ipva', '$documentoParaRodar', '$anoFabricacao', '$sinistro')");
        }

        if (isset($_POST['salvar'])) {
            if($veiculoExistente != null && $veiculoExistente['veiculoId'] != $_GET['id']) {
                toastr('error', 'Veículo já cadastrado');
                $redirect = false;
            } else
                executeQuery("UPDATE veiculo SET chassi = '$chassi', placa = '$placa', modeloCorId = '$modeloCorId',  hodometro = '$hodometro', observacao = '$complemento', direcao = '$direcao', cambioAutomatico = '$cambioAutomatico', vidroEletrico = '$vidroEletrico', tipoCombustivel = '$combustivel', kitGnv = '$gnv', arCondicionado = '$arCondicionado', kitMultimidia = '$multimidia', valorDespesas = '$despesas', ipvaQuitado = '$ipva', documentoParaRodar = '$documentoParaRodar', anoFabricacao = '$anoFabricacao', sinistro = '$sinistro' WHERE veiculoId = '$id'");

                echo "<script>console.log(".json_encode($id).");</script>";

        }

        if (isset($_POST['deletar'])) {

            echo "<script>console.log('deletado');</script>";

            $veiculoSelecionado = executeQuery("SELECT v.veiculoId FROM veiculo v INNER JOIN lote lo ON v.veiculoId = lo.veiculoId WHERE v.veiculoId = '$id'");
            if($veiculoSelecionado -> num_rows > 0) {
                $veiculoId = $veiculoSelecionado -> fetch_assoc();
            }
            
            if(isset($veiculoId)){
                toastr('error', 'Este veículo está vinculado a um lote, não é possível excluí-lo.');
                $redirect = false;

            } else{
                executeQuery("DELETE FROM veiculo WHERE veiculoId = '$id'");
                toastr('success', 'Veículo excluido');
            }
        }

        if ($redirect) {
            header("Location: http://localhost/picareta_leiloes/pages/cadastroVeiculo/cadastroVeiculo.php");
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

            <div class="d-flex justify-content-center mb-3">
                <h2>Cadastro de Veiculo</h2>
            </div>

            <form class="row d-flex justify-content-center" id="form" action="" method="POST">

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <select class="form-select" name="brand" id="brand" onblur="validateInput(this)" onchange="parameterURL('marcaId', this.value)" required>
                            <option value="" disabled selected hidden>Marca*</option>

                            <?php
                                $marcaId = $_GET['marcaId'] ?? -1;
                                $selected = $marcaId == -1 ? "selected" : "";

                                echo "<option value='' disabled $selected hidden>Marca*</option>";

                                $dadosMarca = executeQuery("SELECT marcaId, descricao AS dsMarca FROM marca");

                                while ($row = mysqli_fetch_assoc($dadosMarca)) {
                                    $selected = $marcaId == $row['marcaId'] ? "selected" : "";
                                    echo "<option $selected value='" . $row['marcaId'] . "'>" . $row['dsMarca'] . "</option>";
                                }

                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-brand">Informe uma marca válida.</div>
                    </div>
                    <div class="col-6 col-lg-4">

                            <?php

                                $marcaId = $_GET['marcaId'] ?? -1;
                                $disabled = $marcaId == -1 ? "disabled" : "";
                                echo "<select class='form-select' id='model' $disabled name='model' onblur='validateInput(this)' onchange='parameterURL(\"descricaoModelo\", this.value)' required>";

                                $descricaoModelo = $_GET['descricaoModelo'] ?? -1;
                                $selected = $descricaoModelo == -1 ? "selected" : "";

                                echo "<option value='' disabled $selected hidden>Modelo*</option>";

                                $selectModelos = executeQuery("SELECT DISTINCT descricao FROM modelo WHERE marcaId = $marcaId");
                                while ($row = mysqli_fetch_assoc($selectModelos)) {
                                    $selected = $descricaoModelo == $row['descricao'] ? "selected" : "";
                                    echo "<option $selected value='" . $row['descricao'] . "'>" . $row['descricao'] . "</option>";
                                }               
                            ?>

                        </select>
                        <div class="invalid-feedback" id="invalid-message-model">Informe um modelo válido.</div>
                    </div>
                    <div class="col-2 col-lg-2">
                            <?php
                                $dsAnoModelo = "Ano Modelo*";
                                $required = "required";

                                if(isset($_GET['anoModelo'])) {
                                    $dsAnoModelo = $_GET['anoModelo'] ?? "Ano Modelo*";
                                    $required = "";
                                }

                                if(isset($_GET['modelIdAndYear'])) {
                                    $modelo = $_GET['modelIdAndYear'] ?? -1;
                                    $dsAnoModelo = explode('a', $modelo)[1] ?? "Ano Modelo*";
                                    $required = "";
                                }

                                $descricaoModelo = $_GET['descricaoModelo'] ?? -1;
                                $disabled = $descricaoModelo == -1 ? "disabled" : "";

                                echo "<select class='form-select' id='modelIdAndYear' name='modelIdAndYear' $disabled onblur='validateInput(this)' onchange='parameterURL(\"modelIdAndYear\", this.value)' $required>";


                                // echo "<option value='' disabled $selected hidden>$dsAnoModelo</option>";
                                echo "<option value='' selected disabled hidden>$dsAnoModelo</option>";

                                $selectModelos = executeQuery('SELECT * FROM modelo WHERE descricao = "' . $descricaoModelo . '"');
                               
                                while ($row = mysqli_fetch_assoc($selectModelos)) {
                                    $selected = $anoModelo == $row['anoModelo'] ? "selected" : "";
                                    echo "<option $selected value='" . $row['modeloId'] ."a". $row['anoModelo'] . "'>" . $row['anoModelo'] . "</option>";
                                }


                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-year">Informe um ano modelo válido.</div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                            <?php
                                
                                $modeloId = -1;
                                $dsColor = "Cor*";
                                $required = "required";

                                if(isset($_GET['modeloId'])) {
                                    $modeloId = $_GET['modeloId'];
                                }

                                if(isset($_GET['modelIdAndYear'])) {
                                    $modelo = $_GET['modelIdAndYear'] ?? -1;
                                    $modeloId = explode('a', $modelo)[0];
                                }

                                if(isset($_GET['dsCor'])) {
                                    $dsColor = $_GET['dsCor'] ?? "Cor*";
                                    $required = "";
                                }

                                if(isset($_GET['colorId'])) {
                                    $color = $_GET['colorId'] ?? -1;
                                    $dsColor = explode('y', $color)[1] ?? "Cor*";
                                    $required = "";
                                }

                                $marcaId = $_GET['marcaId'] ?? -1;

                                $anoModelo = $_GET['anoModelo'] ?? -1;
                                $corId = $_GET['corId'] ?? -1;

                                $modelIdAndYear = $_GET['modelIdAndYear'] ?? -1;
                                $disabled = $modelIdAndYear == -1 && $modeloId == -1 ? "disabled" : "";

                                echo "<select class='form-select' id='color' $disabled name='color' onblur='validateInput(this)' onchange='parameterURL(\"colorId\", this.value)' $required>";

                                echo "<option value='' disabled selected hidden>$dsColor</option>";
                                $selectCoresModelo = executeQuery("SELECT co.Descricao AS dsCor, co.corId FROM modelocor mc INNER JOIN cor co ON mc.corId = co.corId WHERE mc.modeloId = $modeloId");

                                while ($row = mysqli_fetch_assoc($selectCoresModelo)) {
                                    $selected = $corId == $row['corId'] ? "selected" : "";
                                    echo "<option $selected value='" . $row['corId'] ."y". $row['dsCor'] . "'>" . $row['dsCor'] . "</option>";
                                }
                                
                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-color">Informe uma cor válida.</div>
                    </div>
                    <div class="col-3 col-lg-2">
                        
                        <?php
                                $placa = $_GET['placa'] ?? "";

                                echo "<input type='text' id='licensePlate' name='licensePlate' maxLength='8' class='form-control' placeholder='Placa*' value='".$placa."' onblur='validateInput(this)' required>";
                        ?>

                        <div class="invalid-feedback" id="invalid-message-licensePlate">Informe uma placa válida.<br> <em>Ex: AAA-0000</em></div>
                    </div>
                    <div class="col-5 col-lg-4">

                        <?php
                                $chassi = $_GET['chassi'] ?? "";

                                echo "<input type'text' id='chassis' name='chassis' maxLength='17' class='form-control' placeholder='Chassi*' value='".$chassi."' onblur='validateInput(this)' required>";
                        ?>

                        <div class="invalid-feedback" id="invalid-message-chassis">Informe um número de chassi válido.<br> <em>Ex: 9BWHE21JX24060960</em></div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="col-3 col-lg-3">

                        <?php
                                $hodometro = $_GET['hodometro'] ?? "";

                                echo "<input type='number' id='odometer' name='odometer' class='form-control' placeholder='Hodômetro*' value='".$hodometro."' onblur='validateInput(this)' required>";
                        ?>

                        <div class="invalid-feedback" id="invalid-message-odometer">Informe uma quilometragem válida.<br> <em>Ex: 1000</em></div>
                    </div>
                    <div class="col-9 col-lg-6">

                        <?php
                                $observacao = $_GET['observacao'] ?? "";

                                echo "<input type='text' id='complement' name='complement' class='form-control' placeholder='Observações' value='".$observacao."' onblur='validateInput(this)'>";
                        ?>

                        <div class="invalid-feedback" id="invalid-message-complement">Informe observações válidas.<br> <em>Ex: Falta a chave</em></div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="col-3 col-lg-2">
                        <select class="form-select" id="steering" name="steering" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Direção*</option>

                            <?php

                                $option = ['Mecânica', 'Hidráulica', 'Assistida', 'Elétrica'];

                                $value = ['1', '2', '3', '4'];
                                $direcao = $_GET['direcao'] ?? "";

                                if(in_array($direcao, $value)) {
                                    $index = array_search($direcao, $value);
                                    echo "<option selected value=$direcao>$option[$index]</option>";
                                }

                                for($i = 0; $i < count($value); $i++) {
                                    if($value[$i] != $direcao) {
                                        echo "<option value=$value[$i]>$option[$i]</option>";
                                    }
                                }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-steering">Informe uma direção válida.</div>
                    </div>
                    <div class="col-3 col-lg-2">
                        <select class="form-select" id="fuel" name="fuel" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Combustível*</option>

                            <?php

                                $option = ['Álcool', 'Gasolina', 'Flex', 'Diesel', 'Híbrido', 'Elétrico'];

                                $value = ['1', '2', '3', '4', '5', '6'];
                                $tipoCombustivel = $_GET['tipoCombustivel'] ?? "";

                                if(in_array($tipoCombustivel, $value)) {
                                    $index = array_search($tipoCombustivel, $value);
                                    echo "<option selected value='$tipoCombustivel'>$option[$index]</option>";
                                }

                                for($i = 0; $i < count($value); $i++) {
                                    if($value[$i] != $tipoCombustivel) {
                                        echo "<option value=$value[$i]>$option[$i]</option>";
                                    }
                                }
                            ?>

                        </select>
                        <div class="invalid-feedback" id="invalid-message-fuel">Informe um combustível válido.</div>
                    </div>
                    <div class="col-2">

                        <?php
                                $anoFabricacao = $_GET['anoFabricacao'] ?? "";

                                echo "<input type='number' id='year' name='yearFab' maxLength='4' class='form-control' placeholder='Ano Fabricação*' value='".$anoFabricacao."' onblur='validateInput(this)' required>";
                        ?>


                        <div class="invalid-feedback" id="invalid-message-year">Informe um ano fabricação válido.<br> <em>Ex: 2020</em></div>
                    </div>

                    <div class="col-3">

                        <?php
                            $valorDespesas = $_GET['valorDespesas'] ?? "";

                            echo "<input type='text' id='expenses' name='expenses' class='form-control' placeholder='Despesas' value='".$valorDespesas."' onblur='validateInput(this)' required>";

                        ?>


                        <div class="invalid-feedback" id="invalid-message-expenses">Informe um valor de despesa válido.<br> <em>Ex: R$1000</em></div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="form-check col-2">
                        <?php

                            $cambioAutomatico = $_GET['cambioAutomatico'] ?? "";
                            $checked = $cambioAutomatico == '1' ? 'checked' : "";

                            echo "<input class='form-check-input' id='transmission' name='transmission' type='checkbox' $checked>";

                        ?>

                        <label class="form-check-label" for="transmission">
                            Automático
                        </label>
                    </div>
                    <div class="form-check col-2">

                        <?php

                            $vidroEletrico = $_GET['vidroEletrico'] ?? "";
                            $checked = $vidroEletrico == '1' ? 'checked' : "";

                            echo "<input class='form-check-input' id='window' name='window' type='checkbox' $checked>";

                        ?>

                        <label class="form-check-label" for="window">
                            Vidro elétrico
                        </label>
                    </div>
                    <div class="form-check col-2">

                        <?php

                            $kitGnv = $_GET['kitGnv'] ?? "";
                            $checked = $kitGnv == '1' ? 'checked' : "";

                            echo "<input class='form-check-input' id='gnv' name='gnv' type='checkbox' $checked>";

                        ?>

                        <label class="form-check-label" for="gnv">
                            GNV
                        </label>
                    </div>
                    <div class="form-check col-2">

                        <?php

                            $arCondicionado = $_GET['arCondicionado'] ?? "";
                            $checked = $arCondicionado == '1' ? 'checked' : "";

                            echo "<input class='form-check-input' id='air' name='air' type='checkbox' $checked>";

                        ?>

                        <label class="form-check-label" for="air">
                            Ar condicionado
                        </label>
                    </div>
                    
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="form-check col-2">

                        <?php

                            $kitMultimidia = $_GET['kitMultimidia'] ?? "";
                            $checked = $kitMultimidia == '1' ? 'checked' : "";

                            echo "<input class='form-check-input' id='multimidia' name='multimidia' type='checkbox' $checked>";

                        ?>

                        <label class="form-check-label" for="multimidia">
                            Multimídia
                        </label>
                    </div>
                    <div class="form-check col-2">

                        <?php

                            $ipvaQuitado = $_GET['ipvaQuitado'] ?? "";
                            $checked = $ipvaQuitado == '1' ? 'checked' : "";

                            echo "<input class='form-check-input' id='ipva' name='ipva' type='checkbox' $checked>";

                        ?>

                        <label class="form-check-label" for="ipva">
                            IPVA quitado
                        </label>
                    </div>
                    <div class="form-check col-2">

                        <?php

                            $documentoParaRodar = $_GET['documentoParaRodar'] ?? "";
                            $checked = $documentoParaRodar == '1' ? 'checked' : "";

                            echo "<input class='form-check-input' id='readyRode' name='readyRode' type='checkbox' $checked>";

                        ?>

                        <label class="form-check-label" for="readyRode">
                            Pronto para rodar
                        </label>
                    </div>
                    <div class="form-check col-2">

                        <?php

                            $sinistro = $_GET['sinistro'] ?? "";
                            $checked = $sinistro == '1' ? 'checked' : "";

                            echo "<input class='form-check-input' id='sinistro' name='sinistro' type='checkbox' $checked>";

                        ?>

                        <label class="form-check-label" for="sinistro">
                            Sinistro
                        </label>
                    </div>
                </div>
                
                <!-- <div class="row justify-content-center mb-5 gap-4">
                    <div class="col-3 col-lg-2 col-lg-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="frontal" accept="image/*">
                            <label class="custom-file-label" for="frontal">Frontal</label>
                        </div>
                    </div>
                    <div class="col-3 col-lg-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="traseira" accept="image/*">
                            <label class="custom-file-label" for="traseira">Traseira</label>
                        </div>
                    </div>
                    <div class="col-3 col-lg-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="lateralEsquerda" accept="image/*">
                            <label class="custom-file-label" for="lateralEsquerda">Lateral Esquerda</label>
                        </div>
                    </div>
                    <div class="col-3 col-lg-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="lateralDireita" accept="image/*">
                            <label class="custom-file-label" for="lateralDireita">Lateral Direita</label>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5 gap-4">
                    <div class="col-3 col-lg-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="interior" accept="image/*">
                            <label class="custom-file-label" for="interior">Interior</label>
                        </div>
                    </div>
                    <div class="col-3 col-lg-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="painel" accept="image/*">
                            <label class="custom-file-label" for="painel">Painel</label>
                        </div>
                    </div>
                    <div class="col-3 col-lg-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="motor" accept="image/*">
                            <label class="custom-file-label" for="motor">Motor</label>
                        </div>
                    </div>
                </div> -->

                <?php 
                    if (isset($_GET["id"]))
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
                                        <h5 class='modal-title' id='exampleModalLabel'>Excluir Veículo</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Cancelar'>
                                        <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                        Tem certeza que deseja excluir o veículo selecionado?
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
                                <button type='button' name='cancelar' class='btn btn-outline-danger col-5' onclick=\"window.location.href='http://localhost/picareta_leiloes/pages/cadastroVeiculo/cadastroVeiculo.php'\">Cancelar</button>
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