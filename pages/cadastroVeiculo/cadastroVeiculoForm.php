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
    include './../../components/header/header.html';
    ?>
    
    <div class="content">

        <div class="left">
            <?php
            include './../../components/sidebar/sidebar.php';
            ?>
        </div>

        <div class="right">

            <div class="d-flex justify-content-center my-5">
                <h2>Cadastro de Veiculo</h2>
            </div>

            <form class="row d-flex justify-content-center" id="form" action="" method="POST">

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <select class="form-select" id="brand" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Marca*</option>
                            <option value="1">FORD</option>
                            <option value="2">BMW</option>
                            <option value="3">FIAT</option>
                            <option value="4">VOLKSWAGEN</option>
                            <option value="5">CHEVROLET</option>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-brand">Informe uma marca válida.</div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <select class="form-select" id="model" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Modelo*</option>
                            <option value="1">FIESTA</option>
                            <option value="2">X1</option>
                            <option value="3">UNO</option>
                            <option value="4">GOL</option>
                            <option value="5">ONIX</option>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-model">Informe um modelo válido.</div>
                    </div>
                    <div class="col-2 col-lg-2">
                        <select class="form-select" id="year" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Ano Modelo*</option>
                            <option value="1">2010</option>
                            <option value="2">2012</option>
                            <option value="3">2014</option>
                            <option value="4">2016</option>
                            <option value="5">2020</option>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-year">Informe um ano modelo válido.</div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="col-4 col-lg-3">
                        <select class="form-select" id="color" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Cor*</option>
                            <option value="1">PRETO</option>
                            <option value="2">VERMELHO</option>
                            <option value="3">BRANCO</option>
                            <option value="4">ROSA</option>
                            <option value="5">PRATA</option>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-color">Informe uma cor válida.</div>
                    </div>
                    <div class="col-3 col-lg-2">
                        <input type="text" id="licensePlate" maxLength="8" class="form-control" placeholder="Placa*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-licensePlate">Informe uma placa válida.<br> <em>Ex: AAA-0000</em></div>
                    </div>
                    <div class="col-5 col-lg-4">
                        <input type="text" id="chassis" maxLength="17" class="form-control" placeholder="Chassi*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-chassis">Informe um número de chassi válido.<br> <em>Ex: 9BWHE21JX24060960</em></div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="col-3 col-lg-3">
                        <input type="number" id="odometer" class="form-control" placeholder="Hodômetro*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-odometer">Informe uma quilometragem válida.<br> <em>Ex: 1000</em></div>
                    </div>
                    <div class="col-9 col-lg-6">
                        <input type="text" id="complement" class="form-control" placeholder="Observações" onblur="validateInput(this)">
                        <div class="invalid-feedback" id="invalid-message-complement">Informe observações válidas.<br> <em>Ex: Falta a chave</em></div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="col-3 col-lg-2">
                        <select class="form-select" id="steering" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Direção*</option>
                            <option value="1">Mecânica</option>
                            <option value="2">Hidráulica</option>
                            <option value="3">Assistida</option>
                            <option value="4">Elétrica</option>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-steering">Informe uma direção válida.</div>
                    </div>
                    <div class="col-3 col-lg-2">
                        <select class="form-select" id="fuel" onblur="validateInput(this)" required>
                            <option value="" disabled selected hidden>Combustível*</option>
                            <option value="1">Álcool</option>
                            <option value="2">Gasolina</option>
                            <option value="3">Flex</option>
                            <option value="4">Diesel</option>
                            <option value="5">Híbrido</option>
                            <option value="6">Elétrico</option>
                        </select>
                        <div class="invalid-feedback" id="invalid-message-fuel">Informe um combustível válido.</div>
                    </div>
                    <div class="col-2">
                        <input type="number" id="year" maxLength="4" class="form-control" placeholder="Ano Fabricação*" onblur="validateInput(this)" required>
                        <div class="invalid-feedback" id="invalid-message-year">Informe um ano fabricação válido.<br> <em>Ex: 2020</em></div>
                    </div>

                    <div class="col-3">
                        <input type="text" id="expenses" class="form-control" placeholder="Despesas" onblur="validateInput(this)">
                        <div class="invalid-feedback" id="invalid-message-expenses">Informe um valor de despesa válido.<br> <em>Ex: R$1000</em></div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="form-check col-2">
                        <input class="form-check-input" type="checkbox" value="false" id="transmission">
                        <label class="form-check-label" for="transmission">
                            Automático*
                        </label>
                    </div>
                    <div class="form-check col-2">
                        <input class="form-check-input" type="checkbox" value="false" id="window">
                        <label class="form-check-label" for="window">
                            Vidro elétrico*
                        </label>
                    </div>
                    <div class="form-check col-2">
                        <input class="form-check-input" type="checkbox" value="false" id="window">
                        <label class="form-check-label" for="window">
                            GNV*
                        </label>
                    </div>
                    <div class="form-check col-2">
                        <input class="form-check-input" type="checkbox" value="false" id="window">
                        <label class="form-check-label" for="window">
                            Ar condicionado*
                        </label>
                    </div>
                    
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="form-check col-2">
                        <input class="form-check-input" type="checkbox" value="false" id="window">
                        <label class="form-check-label" for="window">
                            Multimídia*
                        </label>
                    </div>
                    <div class="form-check col-2">
                        <input class="form-check-input" type="checkbox" value="false" id="window">
                        <label class="form-check-label" for="window">
                            IPVA quitado*
                        </label>
                    </div>
                    <div class="form-check col-2">
                        <input class="form-check-input" type="checkbox" value="false" id="window">
                        <label class="form-check-label" for="window">
                            Pronto para rodar*
                        </label>
                    </div>
                    <div class="form-check col-2">
                        <input class="form-check-input" type="checkbox" value="false" id="window">
                        <label class="form-check-label" for="window">
                            Sinistro*
                        </label>
                    </div>
                </div>
                
                <div class="row justify-content-center mb-5 gap-4">
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
                </div>

                <?php 
                    if (isset($_GET["id"]))
                        $id = $_GET["id"];

                        if (isset($id) && $id != "") {
                            echo "
                            <div class='col-6 col-lg-3 mx-auto my-3 d-flex justify-content-around'>
                                <button type='submit' value='deletar' class='btn btn-outline-danger col-5'>Deletar</button>
                                <button type='submit' value='salvar' class='btn btn-outline-success col-5' onclick=\"checkAllFields('form')\">Salvar</button>
                            </div>
                            ";
                        } else {
                            echo "
                            <div class='col-6 col-lg-3 mx-auto my-3 d-flex justify-content-around'>
                                <button type='button' value='cancelar' class='btn btn-outline-danger col-5' onclick=\"window.history.back()\">Cancelar</button>
                                <button type='submit' value='adicionar' class='btn btn-outline-success col-5' onclick=\"checkAllFields('form')\">Adicionar</button>
                            </div>
                            ";
                        }
                ?>

            </form>

        </div>

    </div>

    <?php
    include './../../components/footer/footer.html';
    ?>
    
</body>
</html>