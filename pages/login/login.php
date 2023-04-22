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
    include './../../components/header/header.php';
    include './../../components/toastr/toastr.php';

    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $senha = $_POST['password'];

        if (isset($_POST['entrar'])) {
            $usuario = executeQuery("SELECT loginId, tipoLogin FROM LOGIN WHERE EMAIL = '$email' AND SENHA = '$senha'");
            if (mysqli_num_rows($usuario) == 1) {
                $usuario = mysqli_fetch_assoc($usuario);
                $_SESSION['loginId'] = $usuario['loginId'];
                $_SESSION['tipoUsuario'] = $usuario['tipoLogin'];
                $_SESSION['email'] = $email;
                
                if ($_SESSION['tipoUsuario'] == 1) {
                    header('Location: ./../../pages/dadosCadastrais/dadosCadastrais.php');
                } else  {
                    header('Location: ./../../pages/cadastroMarca/cadastroMarca.php');
                }

            } else {
                toastr('error', 'Email ou senha inválidos.');
            }
        } elseif (isset($_POST['cadastrar'])) {
            $emailExistente = executeQuery("SELECT * FROM LOGIN WHERE EMAIL = '$email'");
            if (mysqli_num_rows($emailExistente) == 0) {
                executeQuery("INSERT INTO LOGIN (email, senha, tipoLogin) VALUES ('$email', '$senha', '1')");
                $loginId = executeQuery("SELECT loginId FROM LOGIN WHERE EMAIL = '$email' AND SENHA = '$senha'");
                $loginId = mysqli_fetch_assoc($loginId);
                $_SESSION['loginId'] = $loginId;
                $_SESSION['tipoUsuario'] = 1;
                $_SESSION['email'] = $email;
                header('Location: ./../../pages/dadosCadastrais/dadosCadastrais.php');
            } else {
                toastr('error', 'Email já cadastrado.');
            }
        }
    }
    ?>

    <div class="content">

        <div class="d-flex justify-content-center my-5">
                <h2>Bem-vindo!</h2>
        </div>

        <form class="col-12 d-flex flex-column justify-content-center align-items-center" action="" method="POST">
            <div class="col-7 col-lg-3 mb-4">
                <input type="email" name="email" class="form-control" placeholder="✉*" required>
            </div>
            <div class="col-7 col-lg-3 mb-5">
                <input type="password" name="password" class="form-control" placeholder="🔑*" required>
            </div>

            <div class='col-3 col-lg-2 col-xl-1 d-flex justify-content-center mb-3 mt-2'>
                <button type='submit' name='entrar' class='btn btn-outline-info col-12'>Entrar</button>
            </div>
            <div class='col-3 col-lg-2 col-xl-1 d-flex justify-content-center'>
                <button type='submit' name='cadastrar' class='btn btn-outline-success col-12'>Cadastrar</button>
            </div>
        </form>

    </div>

    <?php
    include './../../components/footer/footer.php';
    ?>
    
</body>
</html>