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
                <h2>Cadastro de Modelo Cor</h2>
            </div>

            <div class="col-12 px-5 mt-5 d-flex justify-content-center">
                <?php 
                    include './../../components/grid/grid.php';

                    $modeloCor = array();
                    $selectModeloCor = executeQuery('SELECT mc.modeloCorId, mo.marcaId, ma.descricao as marcaDescricao, mo.descricao, mo.anoModelo, c.Descricao as corDescricao FROM MODELO MO INNER JOIN MARCA MA ON MA.marcaId = MO.marcaId INNER JOIN modelocor MC ON MC.modeloId = MO.modeloId INNER JOIN cor C ON C.corId = MC.corId');
                    while($row = mysqli_fetch_assoc($selectModeloCor)){
                        $modeloCor[] = array($row['modeloCorId'], $row['marcaDescricao'], $row['descricao'] , $row['anoModelo'], $row['corDescricao']);
                    }
                
                    $titulos = array('Marca', 'Modelo', 'Ano Modelo', 'Cor');
                    $editavel = true;
                    $urlClick = "cadastroModeloCorForm.php?id=";
                
                    gerarGrid($titulos, $modeloCor, 10, $editavel, $urlClick);
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