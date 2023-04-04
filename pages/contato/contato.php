<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contato.scss">
    <title>Contato</title>
</head>
<body>

    <?php
    include './../../components/header/header.html';
    ?>

    <div class="d-flex justify-content-center content">

        <section class="mb-4">

        <h2 class="h1-responsive font-weight-bold text-center my-4">Fale Conosco!</h2>
        <p class="text-center w-responsive mx-auto mb-5">Possui alguma dúvida? Por favor não hesite em nos contatar. Nosso time está a postos para responder o mais breve possível!</p>

        <div class="row">

            <div class="col-md-9 mb-md-0 mb-5">
                <form id="contact-form" name="contact-form" action="mail.php" method="POST">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <input type="text" id="name" name="name" class="form-control">
                                <label for="name" class="">Nome</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <input type="text" id="email" name="email" class="form-control">
                                <label for="email" class="">E-mail</label>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                                <input type="text" id="subject" name="subject" class="form-control">
                                <label for="subject" class="">Título</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="md-form">
                                <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                <label for="message">Sua mensagem</label>
                            </div>

                        </div>
                    </div>

                </form>

                <div class="col-6 col-lg-3 mx-auto d-flex justify-content-center">
                    <button type="submit" value="salvar" class="btn btn-outline-success col-6" onclick="checkAllFields('form')">Enviar</button>
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
    include './../../components/footer/footer.html';
    ?>
    
</body>
</html>