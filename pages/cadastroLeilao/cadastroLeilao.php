<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastroLeilao.scss">
    <title>Cadastro de Leilão</title>
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

            <div class="d-flex justify-content-center mt-5">
                <h2>Cadastro de Leilão</h2>
            </div>

            <div class="col-12 px-5 mt-5 d-flex justify-content-center">
                <?php 
                    include './../../components/grid/grid.php';
                    $produtos = array(
                        array("1", "15/04/2023"),
                        array("2", "27/04/2023"),
                        array("3", "01/05/2023"),
                    );
                
                    $titulos = array('Data');
                    $editavel = true;
                    $urlClick = "cadastroLeilaoForm.php?id=";
                
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