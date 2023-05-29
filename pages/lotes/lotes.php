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
    $id = $_GET['id'];
    ?>
    
    <div class="content">

        <div class="right">

            <div class="d-flex justify-content-center mt-5">
                <h2>Lotes do Leilão N.º1</h2>
            </div>

            <div class="col-10 px-5 my-3 d-flex justify-content-center">
                <?php 
                    include './../../components/grid/grid.php';
                    $marcas = array();
                    $selectMarca = executeQuery('select * from leilao le inner join lote lo on lo.leilaoId 
                    = le.leilaoId inner join veiculo v on v.veiculoId = lo.veiculoId inner join modelocor mc on mc.modeloCorId = v.modeloCorId inner join modelo mo on mo.modeloId = mc.modeloId inner join marca ma on ma.marcaId = mo.marcaId');
                    while($row = mysqli_fetch_assoc($selectMarca)){
                        $marcas[] = array($row['marcaId'], $row['descricao']);
                    }

                    $produtos = array(
                        array("1", "MITSUBISHI", "ECLIPSE", "PRETO", "1998/1998", "R$45.000,00", "BRADESCO", "15/05/2023"),
           
                    );
                
                    $titulos = array('Marca', 'Modelo do veículo', 'Cor', 'Ano do veículo', 'Valor atual', 'Financeira Responsável', 'Data resultado');
                
                    $editavel = false;
                    $urlClick = "./../../pages/loteVeiculo/loteVeiculo.php?id=";

                    gerarGrid($titulos, $produtos, 12, $editavel,  $urlClick);
                ?>
            </div>

        </div>

    </div>

    <?php include './../../components/footer/footer.php'; ?>
    
</body>
</html>