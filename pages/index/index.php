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

    <div class="container d-flex flex-column gap-3">
        <div class="row m-3">
            <div class="col-md-6">
                <img src="./images/sell.jpg" width="450" alt="Imagem">
            </div>
            <div class="col-md-6 mt-2">
                <h2>Nossa História</h2>
                <p>
                    O Picareta Leilões surgiu a partir do trabalho árduo, dedicação e paixão. 
                    Começou com uma pequena equipe dedicada de funcionários, incluindo um 
                    leiloeiro experiente e um grupo de mecânicos habilidosos para garantir 
                    que os carros estivessem em boas condições antes de irem para o leilão. 
                    Em pouco tempo de mercado, conquistamos a confiança dos clientes, garantindo
                    qualidade, honestidade e integridade nos negócios.
                </p>
            </div>
        </div>

        <div class="row m-3">
            <div class="col-md-6 mr-2">
                <h2>O que fazemos?</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel velit in leo blandit blandit. Praesent mauris risus, rutrum a pellentesque non, feugiat nec libero. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse ut justo consectetur, tempor felis et, tincidunt diam. Etiam sit amet molestie neque, cursus pellentesque nisi. Duis at efficitur lorem, vitae faucibus velit. Proin orci neque, iaculis sed orci sed, aliquam scelerisque odio. Duis quis ex vitae risus suscipit hendrerit. Nunc id facilisis ante, at pulvinar ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed eleifend nisl tortor, ut cursus diam imperdiet sed. Nulla a dolor ac eros luctus viverra quis et leo.
                </p>
            </div>

            <div class="col-md-6">
                <img src="./images/carro1.jpg" width="500" alt="Imagem">
            </div>
        </div>

        <div class="col-md-12 m-3">
            <h2 class="d-flex justify-content-center">Como funciona</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel velit in leo blandit blandit. Praesent mauris risus, rutrum a pellentesque non, feugiat nec libero. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse ut justo consectetur, tempor felis et, tincidunt diam. Etiam sit amet molestie neque, cursus pellentesque nisi. Duis at efficitur lorem, vitae faucibus velit. Proin orci neque, iaculis sed orci sed, aliquam scelerisque odio. Duis quis ex vitae risus suscipit hendrerit. Nunc id facilisis ante, at pulvinar ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed eleifend nisl tortor, ut cursus diam imperdiet sed. Nulla a dolor ac eros luctus viverra quis et leo.
            </p>
        </div>

        <div class="row m-2">
            <div class="col-md-6 mt-2">
                <h2>O Leiloeiro</h2>
                <h4>Alcides Carvalho</h4>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel velit in leo blandit blandit. Praesent mauris risus, rutrum a pellentesque non, feugiat nec libero. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse ut justo consectetur, tempor felis et, tincidunt diam. Etiam sit amet molestie neque, cursus pellentesque nisi. Duis at efficitur lorem, vitae faucibus velit. Proin orci neque, iaculis sed orci sed, aliquam scelerisque odio. Duis quis ex vitae risus suscipit hendrerit. Nunc id facilisis ante, at pulvinar ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed eleifend nisl tortor, ut cursus diam imperdiet sed. Nulla a dolor ac eros luctus viverra quis et leo.
                </p>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <img src="./images/leiloeiro.jpg" width="300" alt="Imagem">
            </div>
        </div>

    </div>

    <?php
    include './../../components/footer/footer.html';
    ?>


</body>
</html>