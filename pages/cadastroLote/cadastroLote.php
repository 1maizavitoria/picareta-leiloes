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
                    $getLote = executeQuery('SELECT * FROM `lote`');

                    $titulos = array('Marca', 'Modelo', 'Ano Modelo', 'Cor', 'Placa', 'Valor', 'Data Leilão');
                    while($row = mysqli_fetch_assoc($getLote)){

                        $getVeiculo = $row["veiculoId"];
                        $searchVeiculo = mysqli_fetch_assoc(executeQuery("SELECT * FROM `veiculo` WHERE `veiculoId`=$getVeiculo"));

                        $getModeloId = $searchVeiculo["modeloId"];
                        $searchModelo =  mysqli_fetch_assoc(executeQuery("SELECT * FROM `modelo` WHERE `modeloId`=$getModeloId"));
                        
                        $getMarcaId = $searchModelo["marcaId"];
                        $searchMarca = mysqli_fetch_assoc(executeQuery("SELECT * FROM `marca` WHERE `marcaId`=$getMarcaId"));


                        $getLeilaoId = $row["leilaoId"];
                        $searchLeilao = mysqli_fetch_assoc(executeQuery("SELECT * FROM `leilao` WHERE `leilaoId`=$getLeilaoId"));

                        // $getModeloId = $row["modeloId"];
                        // $getModelo = mysqli_fetch_assoc(executeQuery("SELECT * FROM `modelo` WHERE `modeloId`=$getModeloId"));

                        // $getMarcaId = $getModelo["marcaId"];
                        // $getMarca= mysqli_fetch_assoc(executeQuery("SELECT * FROM `marca` WHERE `marcaId`=$getMarcaId"));

                        $cadLote[] = array($row["loteId"],$searchMarca["descricao"], $searchModelo["descricao"], $searchModelo["anoModelo"], "null", $searchVeiculo["placa"], $row["valorInicial"] , $searchLeilao['dataLeilao']);
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