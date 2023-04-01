<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastroModeloCor.scss">
    <title>Cadastro de Modelo Cor</title>
</head>
<body>

    <?php
    include './../../components/header/header.html';
    ?>
    
    <div class="content">

        <div class="left">
            <?php
            include './../../components/sidebar/sidebar.html';
            ?>
        </div>

        <div class="right">

            <div class="d-flex justify-content-center mt-5">
                <h2>Cadastro de Modelo Cor</h2>
            </div>

            <div class="col-12 px-5 mt-5 d-flex justify-content-center">
                <?php 
                    include './../../components/grid/grid.php';
                    $produtos = array(
                        array("1", "FORD", "FIESTA", "2010", "PRETO"),
                        array("2", "BMW", "X1", "2015", "PRETO"),
                        array("3", "FIAT", "UNO", "2018", "VERMELHO"),
                        array("4", "VOLKSWAGEN", "GOL", "2019", "PRATA"),
                        array("5", "CHEVROLET", "ONIX", "2018", "BRANCO"),
                    );
                
                    $titulos = array('Marca', 'Modelo', 'Ano Modelo', 'Cor');
                    $editavel = true;
                    $urlClick = "cadastroModeloCorForm.php?id=";
                
                    gerarGrid($titulos, $produtos, 10, $editavel, $urlClick);
                ?>
            </div>

        </div>

    </div>

    <?php
    include './../../components/footer/footer.html';
    ?>
    
</body>
</html>