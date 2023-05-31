<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastroVeiculo.scss">
    <title>Cadastro de Veiculo</title>
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
                <h2>Cadastro de Veículo</h2>
            </div>

            <div class="col-12 px-5 mt-5 d-flex justify-content-center">
                <?php 
                    include './../../components/grid/grid.php';

                    $veiculos = array();
                    $selectVeiculo = executeQuery("SELECT ma.descricao AS dsMarca, mo.descricao AS dsModelo, mo.anoModelo, co.descricao AS dsCor, ve.placa FROM veiculo ve 
                    INNER JOIN modeloCor mc ON ve.modeloCorId = mc.modeloCorId 
                    INNER JOIN modelo mo ON mc.modeloId = mo.modeloId 
                    INNER JOIN marca ma ON mo.marcaId = ma.marcaId 
                    INNER JOIN cor co ON mc.corId = co.corId");

                    while($row = mysqli_fetch_assoc($selectVeiculo)) {
                        echo "<script>console.log(".json_encode($row).");</script>";

                        $veiculos[] = array(NULL, $row['dsMarca'], $row['dsModelo'], $row['anoModelo'], $row['dsCor'], $row['placa']);
                    }
                
                    $titulos = array('Marca', 'Modelo', 'Ano Modelo', 'Cor', 'Placa');
                    $editavel = true;
                    $urlClick = "cadastroVeiculoForm.php?id=";
                
                    gerarGrid($titulos, $veiculos, 10, $editavel, $urlClick);
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