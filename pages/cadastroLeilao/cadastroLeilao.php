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
                <h2>Cadastro de Leilão</h2>
            </div>

            <div class="col-12 px-5 mt-5 d-flex justify-content-center">
                <?php 
                    include './../../components/grid/grid.php';

                    $titulos = array('Data');
                    $editavel = true;
                    $urlClick = "cadastroLeilaoForm.php?id=";
                    $leiloes = array();
                    $selectLeilao = executeQuery('SELECT leilaoId, DATE_FORMAT(dataLeilao, "%d/%m/%Y %H:%i:%s") AS dataLeilao FROM leilao ORDER BY leilaoId DESC');
                    while($row = mysqli_fetch_assoc($selectLeilao)){
                        $leiloes[] = array($row['leilaoId'], $row['dataLeilao']);
                    }

                    gerarGrid($titulos, $leiloes, 10, $editavel, $urlClick);
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