<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../components/footer/footer.scss">
    <title>Footer</title>
</head>
<body>

    <footer class="col-12 w-100">

        <a href="./../../pages/contato/contato.php">Contato</a>
        <a href="./../../pages/leiloes/leiloes.php">Leilões</a>
        <a href="
            <?php 
                if(isset($_SESSION['email']))
                    if ($_SESSION['tipoUsuario'] == 1)
                        echo './../../pages/dadosCadastrais/dadosCadastrais.php';
                    else
                        echo './../../pages/cadastroMarca/cadastroMarca.php';
                else
                    echo './../../pages/login/login.php'; 
            ?>">
                    Minha Conta</a>

    </footer>
    
</body>
</html>