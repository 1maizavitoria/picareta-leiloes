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

            <form class="row d-flex justify-content-center" id="form" action="" method="POST">

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <select class="form-select" id="brand" name="marca" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Marca*</option>
                            <!-- <option value="1">FORD</option>
                            <option value="2">BMW</option>
                            <option value="3">FIAT</option>
                            <option value="4">VOLKSWAGEN</option>
                            <option value="5">CHEVROLET</option> -->

                            <?php
                                $getModels = executeQuery('SELECT * FROM `marca`');
                                while($row = mysqli_fetch_assoc($getModels)){
                                    $getId = $row["marcaId"];
                                    $getName = $row["descricao"];

                                    echo "<option value='$getId'>$getName</option>";
                                }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-brand">Informe uma marca válida.</div>
                    </div>
                    <div class="col-5 col-lg-4">
                        <select class="form-select" id="model" name="modelo" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Modelo*</option>
                            <!-- <option value="1">FIESTA</option>
                            <option value="2">X1</option>
                            <option value="3">UNO</option>
                            <option value="4">GOL</option>
                            <option value="5">ONIX</option> -->

                            <?php
                                $getModels = executeQuery('SELECT * FROM `modelo`');
                                while($row = mysqli_fetch_assoc($getModels)){
                                    $getId = $row["modeloId"];
                                    $getName = $row["descricao"];

                                    echo "<option value='$getId'>$getName</option>";
                                }
                            ?>


                        </select>
                        <div class="invalid-feedback" id="invalid-message-model">Informe um modelo válido.</div>
                    </div>
                    <div class="col-3 col-lg-2">
                        <select class="form-select" id="year" name="ano" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Ano Modelo*</option>
                            <!-- <option value="2010">2010</option>
                            <option value="2012">2012</option>
                            <option value="2014">2014</option>
                            <option value="2016">2016</option>
                            <option value="2020">2020</option> -->

                            <?php
                                $getModels = executeQuery('SELECT * FROM `modelo`');
                                while($row = mysqli_fetch_assoc($getModels)){
                                    $getId = $row["modeloId"];
                                    $getName = $row["anoModelo"];

                                    echo "<option value='$getName'>$getName</option>";
                                }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-year">Informe um ano modelo válido.</div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <select class="form-select" id="color" name="cor" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Cor*</option>
                            <!-- <option value="1">PRETO</option>
                            <option value="2">VERMELHO</option>
                            <option value="3">BRANCO</option>
                            <option value="4">ROSA</option>
                            <option value="5">PRATA</option> -->

                            <?php
                                $getModels = executeQuery('SELECT * FROM `cor`');
                                while($row = mysqli_fetch_assoc($getModels)){
                                    $getId = $row["corId"];
                                    $getName = $row["Descricao"];

                                    echo "<option value='$getId'>$getName</option>";
                                }
                            ?>
                            
                        </select>
                        <div class="invalid-feedback" id="invalid-message-color">Informe uma cor válida.</div>
                    </div>
                    <div class="col-4 col-lg-3">
                        <select class="form-select" id="licensePlateSelect" name="placa" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Placa*</option>
                            <!-- <option value="1">AAA-0000</option>
                            <option value="2">AAA-1111</option>
                            <option value="3">AAA-2222</option>
                            <option value="4">AAA-3333</option>
                            <option value="5">AAA-4444</option> -->

                            <?php
                                $getModels = executeQuery('SELECT * FROM `veiculo`');
                                while($row = mysqli_fetch_assoc($getModels)){
                                    $getId = $row["veiculoId"];
                                    $getName = $row["placa"];

                                    echo "<option value='$getId'>$getName</option>";
                                }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-licensePlateSelect">Informe uma placa válida.</div>
                    </div>
                    <div class="col-4 col-lg-3">
                        <select class="form-select" id="auctionDateSelect" name="dataLeilao" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Data do leilão*</option>
                            <!-- <option value="23/03/2023">23/03/2023</option>
                            <option value="24/03/2023">24/03/2023</option>
                            <option value="25/03/2023">25/03/2023</option>
                            <option value="26/03/2023">26/03/2023</option>
                            <option value="27/03/2023">27/03/2023</option> -->


                            <?php
                                $getModels = executeQuery('SELECT * FROM `leilao`');
                                while($row = mysqli_fetch_assoc($getModels)){
                                    $getId = $row["leilaoId"];
                                    $getName = $row["dataLeilao"];

                                    echo "<option value='$getId'>$getName</option>";
                                }
                            ?>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-auctionDateSelect">Informe uma data do leilão válida.</div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                <div class="col-4 col-lg-3">
                        <select class="form-select" id="financial"  name="financeira" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Financeira*</option>
                            <!-- <option value="1">Santander</option>
                            <option value="2">Itaú</option>
                            <option value="3">Pan</option> -->

                            <?php
                                $getModels = executeQuery('SELECT * FROM `financeira`');
                                while($row = mysqli_fetch_assoc($getModels)){
                                    $getId = $row["financeiraId"];
                                    $getName = $row["descricaoFinanceira"];

                                    echo "<option value='$getId'>$getName</option>";
                                }
                            ?>

                            
                        </select>
                        <div class="invalid-feedback" id="invalid-message-financial">Informe uma Financeira válida.</div>
                    </div>
                    <div class="col-3">
                        <input type="text" id="initialValue" name='inicialValue' class="form-control" placeholder="Valor Inicial*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-initialValue">Informe um valor inicial válido.<br> <em>Ex: R$1000</em></div>
                    </div>
                    <div class="col-3">
                        <input type="text" id="incrementalValue" name='incrementValue' class="form-control" placeholder="Valor Incremento*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-incrementalValue">Informe um valor incremento válido.<br> <em>Ex: R$1000</em></div>
                    </div>
                </div>
                
                <?php 
                    if (isset($_GET["id"])) {
                 
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
                                <button type='button' value='cancelar' name='cancelar' class='btn btn-outline-danger col-5' onclick=\"window.history.back()\">Cancelar</button>
                                <button type='submit' value='adicionar' name='adicionar' class='btn btn-outline-success col-5' onclick=\"checkAllFields('form')\">Adicionar</button>
                            </div>
                            ";
                        }
                    }

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        if(isset($_POST["deletar"])){
                            executeQuery("DELETE FROM `lote` WHERE `loteId` = '$id'");
                        }

                        if (isset($_POST["adicionar"])){

                            $getMarca = trim($_POST["marca"]);

                            $getModelo = trim($_POST["modelo"]);


                            $getCor = trim($_POST["cor"]);

                            $getPlaca = trim($_POST["placa"]);

                            $getDataLeilao = trim($_POST["dataLeilao"]);

                            $getfinanceira = trim($_POST["financeira"]);

                            $getInicialValue = trim($_POST["inicialValue"]);


                            $getIncrementValue = trim($_POST["incrementValue"]);

                            // echo "inicialValue $getInicialValue";
                            // echo "incrementValue $getIncrementValue";
                            // echo "marca $getMarca";
                            // echo "modelo $getModelo";
                            // echo "cor $getCor";
                            // echo "placa $getPlaca";
                            // echo "getDataLeilao $getDataLeilao";
                            // echo "getfinanceira $getfinanceira";

                            executeQuery("
                            INSERT INTO `lote`( leilaoId, valorInicial, valorIncremento, financeiraId, veiculoId) VALUES
                             ('$getDataLeilao','$getInicialValue','$getIncrementValue','$getfinanceira','$getPlaca')"
                            );
                        }

                        if (isset($_POST["salvar"])){

                            $getMarca = trim($_POST["marca"]);
                            $getModelo = trim($_POST["modelo"]);
                            $getCor = trim($_POST["cor"]);
                            $getPlaca = trim($_POST["placa"]);
                            $getDataLeilao = trim($_POST["dataLeilao"]);
                            $getfinanceira = trim($_POST["financeira"]);
                            $getInicialValue = trim($_POST["inicialValue"]);
                            $getIncrementValue = trim($_POST["incrementValue"]);

                            executeQuery("UPDATE `lote` SET `leilaoId`='$getDataLeilao',`valorInicial`='$getInicialValue',`valorIncremento`='$getIncrementValue',`financeiraId`='$getfinanceira',`veiculoId`='$getPlaca' WHERE `loteId` = '$id'");
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