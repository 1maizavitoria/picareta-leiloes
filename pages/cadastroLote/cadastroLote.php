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
                    
                    $lotes = array();
                    $selectLote = executeQuery('select lo.loteId as loteId, ma.descricao as descricaoMarca, mo.descricao as descricaoModelo, c.descricao as descricaoCor, CONCAT(v.anoFabricacao,"/",mo.anoModelo) as anoModeloFabricacao,  REPLACE(CONCAT("R$", lo.valorInicial), ".", ",") as valorInicial, v.placa, DATE_FORMAT(le.dataLeilao, "%d/%m/%Y %H:%i:%s") as dataLeilao, f.descricaoFinanceira  from leilao le inner join lote lo on lo.leilaoId = le.leilaoId inner join veiculo v on v.veiculoId = lo.veiculoId inner join modelocor mc on mc.modeloCorId = v.modeloCorId inner join modelo mo on mo.modeloId = mc.modeloId inner join marca ma on ma.marcaId = mo.marcaId inner join cor c on c.corId = mc.corId left join lance la on la.loteId = lo.loteId inner join financeira f on f.financeiraId = lo.financeiraId');

                    while($row = mysqli_fetch_assoc($selectLote)){
                        $lotes[] = array($row['loteId'], $row['descricaoMarca'], $row['descricaoModelo'], $row['anoModeloFabricacao'], $row['descricaoCor'], $row['placa'], $row['valorInicial'], $row['descricaoFinanceira'], $row['dataLeilao']);
                    }

                    $titulos = array('Marca', 'Modelo', 'Ano Fabricação/Ano Modelo', 'Cor', 'Placa', 'Valor Inicial', 'Financeira', 'Data Leilão');
                    $editavel = true;
                    $urlClick = "cadastroLoteForm.php?id=";
                    gerarGrid($titulos, $lotes, 10, $editavel, $urlClick);
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