<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contato.scss">
    <script type="module" src="./contato.js"></script>
    <title>Contato</title>
</head>
<body>

    <?php
    include './../../components/header/header.php';
    ?>

    <div class="d-flex justify-content-center content">

        <section class="mb-4">

        <h2 class="h1-responsive font-weight-bold text-center my-4">Fale Conosco!</h2>
        <p class="text-center w-responsive mx-auto mb-5">Possui alguma dúvida? Por favor não hesite em nos contatar. Nosso time está a postos para responder o mais breve possível!</p>

        <div class="row">

            <div class="col-md-8 mb-md-0 mb-5">

                <form id="contact-form" name="contact-form" action="" method="POST">

                    <div class="row justify-content-center mb-5">

                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <label for="name" class="">Nome</label>
                                <input type="text" id="name" class="form-control" onblur="validateInput(this)" required>
                                <div class="invalid-feedback" id="invalid-message-name">Informe um nome válido.<br> <em>Ex: Tyler Durden</em></div>
                           </div>
                        </div>

                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <label for="email" class="">E-mail</label>
                                <input type="text" id="email" name="email" class="form-control" onblur="validateInput(this)" required>
                                <div class="invalid-feedback" id="invalid-message-email">Informe um e-mail válido.<br> <em>Ex: nome@dominio.com</em></div>
                            </div>
                        </div>

                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                                <label for="subject">Título</label>
                                <input type="text" id="name" name="title" class="form-control" onblur="validateInput(this)" required>
                                <div class="invalid-feedback" id="invalid-message-email">Título não pode ser vazio.</div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">

                        <div class="col-md-12">

                            <div class="md-form">
                                <label for="message">Sua mensagem</label>
                                <textarea type="text" id="name" name="message" rows="2" class="form-control md-textarea" onblur="validateInput(this)" required></textarea>
                                <div class="invalid-feedback" id="invalid-message-email">Mensagem não pode ser vazio.</div>
                            </div>

                        </div>
                    </div>

                </form>

                <div class="col-6 col-lg-3 mx-auto d-flex justify-content-center mt-5">
                    <button type="submit" value="salvar" class="btn btn-outline-success col-6" onclick="checkAllFields('contact-form')">Enviar</button>
                </div>
            </div>

            <div class="col-md-3 text-center">
                <ul class="list-unstyled mb-0">
                    <li><i class="fas fa-map-marker-alt fa-2x"></i>
                        <p>Rua Imaculada Conceição, 1155 - Prado Velho, Curitiba</p>
                    </li>

                    <li><i class="fas fa-phone mt-4 fa-2x"></i>
                        <p>(41) 3271-1555</p>
                    </li>

                    <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                        <p>contact@picaretaleiloes.com</p>
                    </li>
                </ul>
            </div>

        </div>

        </section>

    </div>

    <?php
    include './../../components/footer/footer.php';

    if (isset($_SESSION['loginId'])) {
        $nome = executeQuery("SELECT nome FROM pessoa WHERE loginId = '$loginId'");
        $email = executeQuery("SELECT email FROM login WHERE loginId = '$loginId'");

        $nomeTela = null;
        $emailTela = null;

    if (mysqli_num_rows($nome) == 1)
        $nomeTela = mysqli_fetch_assoc($nome)['nome'];

    if (mysqli_num_rows($email) == 1)
        $emailTela = mysqli_fetch_assoc($email)['email'];

    echo "
        <script>
            document.getElementById('name').value = '$nomeTela';
            document.getElementById('email').value = '$emailTela';
            document.currentScript.remove();
        </script>";
    }
    ?>
    
</body>
</html>