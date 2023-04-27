<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastroMarca.scss">
    <title>Cadastro de Marca</title>
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
                <h2>Cadastro de Marca</h2>
            </div>

            <div class="col-12 px-5 mt-5 d-flex justify-content-center">
                <?php 
                    include './../../components/grid/grid.php';
                    $marcas = executeQuery('select * from marca');

                
                    $titulos = array('Marca');
                    $editavel = true;
                    $urlClick = "cadastroMarcaForm.php?id=";
                
                    $marcas = mysqli_fetch_assoc($marcas);
                    gerarGrid($titulos, $marcas, 10, $editavel, $urlClick);

                    
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