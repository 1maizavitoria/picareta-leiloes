<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastroLote.scss">
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

            <div class="d-flex justify-content-center mt-5">
                <h2>Cadastro de Lote</h2>
            </div>

            <div class="col-12 px-5 mt-5 d-flex justify-content-center">
                <?php 
                    include './../../components/grid/grid.php';
                    
                    $cadLote = array();
                    $getVeiculo = executeQuery('SELECT * FROM `veiculo`');

                    $titulos = array('Marca', 'Modelo', 'Ano Modelo', 'Cor', 'Placa', 'Valor', 'Data Leilão');
                    while($row = mysqli_fetch_assoc($getVeiculo)){

                        $getModeloId = $row["modeloId"];
                        $getModelo = mysqli_fetch_assoc(executeQuery("SELECT * FROM `modelo` WHERE `modeloId`=$getModeloId"));

                        $getMarcaId = $getModelo["marcaId"];
                        $getMarca= mysqli_fetch_assoc(executeQuery("SELECT * FROM `marca` WHERE `marcaId`=$getMarcaId"));

                        $cadLote[] = array($row['veiculoId'], $getMarca["descricao"], $getModelo["descricao"], $row['anoFabricacao'], $row['modeloId'], $row['placa'], $row['valorDespesas'], $row['modeloId']);
                    }
                    $editavel = true;
                    $urlClick = "cadastroLoteForm.php?id=";
                    gerarGrid($titulos, $cadLote, 10, $editavel, $urlClick);
                ?>
            </div>

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