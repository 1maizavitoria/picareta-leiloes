<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.scss">
    <script type="module" src="./index.js"></script>
    <title>Home</title>
</head>
<body>

    <?php
    include './../../components/header/header.html';
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <img src="./images/carro1.jpg" width="500" alt="Imagem">
            </div>
            <div class="col-md-6">
            <h2>Título do Texto</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pulvinar, nibh eu mattis accumsan, odio enim dapibus sapien, at aliquet ipsum urna quis enim. Mauris scelerisque libero a tellus lacinia, nec elementum libero volutpat.</p>
            <p>Sed vel ante purus. Nullam imperdiet auctor arcu a lacinia. Ut vel turpis purus. Praesent at eros ac odio lobortis fringilla. Etiam quis urna eu massa varius pharetra. Donec tincidunt velit vel lectus tincidunt, a luctus felis pulvinar. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin ut elit sit amet elit aliquam eleifend nec in sapien. </p>
            </div>
        </div>
    </div>

    <?php
    include './../../components/footer/footer.html';
    ?>


</body>
</html>