<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.scss">
    <title>Login/Cadastro</title>
</head>
<body>

    <?php
    include './../../components/header/header.html';
    ?>

    <div class="content">

        <div class="d-flex justify-content-center my-5">
                <h2>Bem-vindo!</h2>
        </div>

        <form class="col-12 d-flex flex-column justify-content-center align-items-center" action="post">
            <div class="col-7 col-lg-3 mb-4">
                <input type="email" class="form-control" placeholder="✉" required>
            </div>
            <div class="col-7 col-lg-3 mb-5">
                <input type="password" class="form-control" placeholder="🔑" required>
            </div>
            
            <div class="col-12 col-lg-3 d-flex justify-content-center mb-3 mt-2">
                <button type="submit" value="entrar" class="btn btn-outline-info col-4">Entrar</button>
            </div>

            <div class="col-12 col-lg-3 d-flex justify-content-center">
                <button type="submit" value="cadastrar" class="btn btn-outline-success col-4">Cadastrar</button>
            </div>
        </form>

    </div>

    <?php
    include './../../components/footer/footer.html';
    ?>
    
</body>
</html>