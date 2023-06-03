<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="historicoLances.scss">
    <title>Histórico de Lances</title>
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
                <h2>Histórico de lances</h2>
            </div>

            <div class="col-12 px-5 mt-5 d-flex justify-content-center">
                <?php 
                    include './../../components/grid/grid.php';
                    $titulos = array('Marca', 'Modelo do veículo', 'Cor', 'Ano do veículo', 'Valor do lance', 'Financeira Responsável', 'Data lance', 'Data resultado');
                
                    $editavel = false;
                    $urlClick = "https://www.google.com?id=";

                    $lances = array();
                    $selectLances = executeQuery("SELECT ma.descricao AS dsMarca, mo.descricao AS dsModelo, co.descricao AS dsCor, CONCAT(ve.anoFabricacao,'/', mo.anoModelo) as anoModeloFabricacao, fn.descricaoFinanceira AS dsFinanceira, la.dataLance, la.valorLance, le.dataleilao AS dtResultado FROM veiculo ve 
                        INNER JOIN modeloCor mc ON ve.modeloCorId = mc.modeloCorId 
                        INNER JOIN modelo mo ON mc.modeloId = mo.modeloId 
                        INNER JOIN marca ma ON mo.marcaId = ma.marcaId 
                        INNER JOIN cor co ON mc.corId = co.corId
                        INNER JOIN lote lo ON ve.veiculoId = lo.veiculoId
                        INNER JOIN financeira fn ON lo.financeiraId = fn.financeiraId
                        INNER JOIN lance la ON lo.loteId = la.loteId
                        INNER JOIN leilao le ON lo.leilaoId = le.leilaoId");

                    while($row = mysqli_fetch_assoc($selectLances)) {
                        $lances[] = array(NULL, $row['dsMarca'], $row['dsModelo'], $row['dsCor'], $row['anoModeloFabricacao'],  'R$' . number_format($row['valorLance']), $row['dsFinanceira'], date('d/m/Y H:i:s', strtotime($row['dataLance'])), date('d/m/Y H:i:s', strtotime($row['dtResultado'])));
                    }

                    gerarGrid($titulos, $lances, 12, $editavel,  $urlClick);
                ?>
            </div>

        </div>

    </div>

    <?php include './../../components/footer/footer.php'; ?>

    <?php
    include './../../libs/authenticator.php';
    autenticar(1);
    ?>
    
</body>
</html>