<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../components/header/header.scss">
    <title>Header</title>
</head>
    <body>
    <?php 
    session_start(); 

    if (isset($_SESSION['expire']))
        if ($_SESSION['expire'] < time()) {
            session_destroy();
            header("Location: ./../../pages/login/login.php?expired=true");
        }

    ob_start();
    ?>
        <nav class="navbar d-flex justify-content-between sticky-top navbar-expand-lg bg-info gap-4">
            <div class="container d-flex justify-content-around align-items-center">
            
                <a class="navbar-brand button" onclick="window.location.href='./../../pages/index/index.php'">
                    <img class="w-100" src="./../../components/header/logo.svg" alt="">
                </a>

                <button class="navbar-toggler" type="button" style="color: #ffffff;" data-toggle="collapse" data-target="#navbarSupportedContent">
                    <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto d-flex justify-content-around align-items-center gap-4">
                        <div class="button mx-2 m-2" onclick="window.location.href='./../../pages/index/index.php'">
                            <p>Home</p>
                            <hr>
                        </div>

                        <div class="button mx-2 m-2" onclick="window.location.href='./../../pages/contato/contato.php'">
                            <p>Contato</p>
                            <hr>
                        </div>

                        <div class="button mx-2 m-2" onclick="window.location.href='./../../pages/leiloes/leiloes.php'">
                            <p>Leilões</p>
                            <hr>
                        </div>                       
                    </ul>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="w-100 navbar-nav justify-content-end d-flex">               
                    <div class="button mt-2 d-flex flex-row" onclick=<?php 
                        if(isset($_SESSION['email']))
                            if ($_SESSION['tipoUsuario'] == 1)
                                echo 'window.location.href=\'./../../pages/dadosCadastrais/dadosCadastrais.php\'';
                            else
                                echo 'window.location.href=\'./../../pages/cadastroMarca/cadastroMarca.php\'';
                        else
                            echo 'window.location.href=\'./../../pages/login/login.php\''; 
                    ?>>
                        <p class="userName">
                            <?php 
                            if(isset($_SESSION['email']))
                                echo $_SESSION['email'];
                            else
                                echo 'Entrar'; 
                            ?>
                        </p>
                        <?php
                            include './../../libs/databaseQuery.php';
                            if (isset($_SESSION['loginId'])) {
                                $loginId = $_SESSION['loginId'];
                                $foto = executeQuery("SELECT foto FROM pessoa WHERE loginId = '$loginId'");
                                $fotoVerificacao = mysqli_fetch_assoc($foto);
                                $fotoConverter = executeQuery("SELECT foto FROM pessoa WHERE loginId = '$loginId'");
                                if ($fotoVerificacao == null || mysqli_fetch_array($fotoConverter, MYSQLI_NUM)[0] == null || $fotoVerificacao == '') 
                                    echo '<i class="fa-solid fa-circle-user fa-2xl" style="color: #ffffff;"></i>';
                                else {
                                    $fotoConverter = executeQuery("SELECT foto FROM pessoa WHERE loginId = '$loginId'");
                                    $fotoConverter = mysqli_fetch_array($fotoConverter, MYSQLI_NUM)[0];
                                    echo '<img class="userLogoImg" src="data:image/gif;base64,' . base64_encode($fotoConverter). '" />';
                                }
                            } else {
                                echo '<i class="fa-solid fa-circle-user fa-2xl" style="color: #ffffff;"></i>';
                            }
                        ?>
                    </div>
                </ul>
            </div>

        </nav>      
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    
    </body>
</html>