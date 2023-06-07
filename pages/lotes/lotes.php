<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lotes.scss">
    <title>Lotes</title>
</head>
<body>
    
    <?php
    include './../../components/header/header.php';
    ?>
    
    <div class="content">

        <div class="right">

            <div class="d-flex justify-content-center mt-5">
                <h2>Lotes do Leilão N.º<?php echo $_GET["leilaoId"] ?></h2>
            </div>

            <div class="col-10 px-5 my-3 d-flex justify-content-center">
                <?php 
                    include './../../components/grid/grid.php';
                    $id = $_GET['leilaoId'];
                    $lotes = array();
                    $selectLote = executeQuery('SELECT
                    lo.loteId AS loteId,
                    ma.descricao AS descricaoMarca,
                    mo.descricao AS descricaoModelo,
                    c.descricao AS descricaoCor,
                    CONCAT(v.anoFabricacao, "/", mo.anoModelo) AS anoModeloFabricacao,
                    REPLACE(CONCAT("R$", COALESCE(la.valorLance, lo.valorInicial)), ".", ",") AS valorAtual,
                    f.descricaoFinanceira,
                    DATE_FORMAT(le.dataLeilao, "%d/%m/%Y %H:%i:%s") AS dataLeilao
                FROM
                    leilao le
                    INNER JOIN lote lo ON lo.leilaoId = le.leilaoId
                    INNER JOIN veiculo v ON v.veiculoId = lo.veiculoId
                    INNER JOIN modelocor mc ON mc.modeloCorId = v.modeloCorId
                    INNER JOIN modelo mo ON mo.modeloId = mc.modeloId
                    INNER JOIN marca ma ON ma.marcaId = mo.marcaId
                    INNER JOIN cor c ON c.corId = mc.corId
                    LEFT JOIN (
                        SELECT loteId, valorLance
                        FROM lance
                        ORDER BY dataLance DESC
                        LIMIT 1
                    ) la ON la.loteId = lo.loteId
                    INNER JOIN financeira f ON f.financeiraId = lo.financeiraId
                WHERE
                    le.leilaoId = ' . $_GET["leilaoId"] . '
                ORDER BY
                    lo.loteId DESC
                ');

                    while($row = mysqli_fetch_assoc($selectLote)){
                        $lotes[] = array($row['loteId'], $row['descricaoMarca'], $row['descricaoModelo'], $row['descricaoCor'], $row['anoModeloFabricacao'], $row['valorAtual'], $row['descricaoFinanceira'], $row['dataLeilao']);
                    }
                    
                    $editavel = false;
                    $urlClick = "./../../pages/loteVeiculo/loteVeiculo.php?id=";
                    
                    $titulos = array('Marca', "Modelo do veículo", "Cor","Ano Fabricação/Ano Modelo", 'Valor atual','Financeira Responsável', 'Data resultado');
                    gerarGrid($titulos, $lotes, 12, $editavel,  $urlClick);
                ?>
            </div>

        </div>

    </div>

    <?php include './../../components/footer/footer.php'; ?>
    
</body>
</html>