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
                    $selectLote = executeQuery('select lo.loteId as loteId, ma.descricao as descricaoMarca, mo.descricao as descricaoModelo, c.descricao as descricaoCor, CONCAT(v.anoFabricacao,"/",mo.anoModelo) as anoModeloFabricacao,  REPLACE(CONCAT("R$", COALESCE(la.valorLance, lo.valorInicial)), ".", ",") as valorAtual, f.descricaoFinanceira, DATE_FORMAT(le.dataLeilao, "%d/%m/%Y %H:%i:%s") as dataLeilao  from leilao le inner join lote lo on lo.leilaoId = le.leilaoId inner join veiculo v on v.veiculoId = lo.veiculoId inner join modelocor mc on mc.modeloCorId = v.modeloCorId inner join modelo mo on mo.modeloId = mc.modeloId inner join marca ma on ma.marcaId = mo.marcaId inner join cor c on c.corId = mc.corId left join lance la on la.loteId = lo.loteId inner join financeira f on f.financeiraId = lo.financeiraId where le.leilaoId = ' . $id . ' order by la.sequencia desc limit 1');

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