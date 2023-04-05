<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="leiloes.scss">
    <title>Leilões</title>
</head>
<body>

    <?php
    include './../../components/header/header.html';
    ?>

    <h2 class="h1-responsive font-weight-bold text-center my-4">Leilões</h2>

    <div class="mb-2">
        <div class="row mid g-3">
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Leilão Presencial/Online N.º1</h5>
                    </div>
                    <div class="card-body">
                        <i class='fas fa-map-marker-alt'></i>
                        <p class='card-text'>Rua Imaculada Conceição, 1155 - Prado Velho, Curitiba</p>
                        <i class="fas fa-calendar-alt"></i>
                        <p class='card-text'>18/07/2023</p>
                        <div class="justify-content-center d-flex">
                            <button onclick="window.location.href = './../../pages/lotes/lotes.php?id=2'"; class="btn btn-outline-success col-6">Acessar Leilão</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Leilão Presencial/Online N.º2</h5>
                    </div>
                    <div class="card-body">
                        <i class='fas fa-map-marker-alt'></i>
                        <p class='card-text'>Rua Imaculada Conceição, 1155 - Prado Velho, Curitiba</p>
                        <i class="fas fa-calendar-alt"></i>
                        <p class='card-text'>18/07/2023</p>
                        <div class="justify-content-center d-flex">
                            <button onclick="window.location.href = './../../pages/lotes/lotes.php?id=2'"; class="btn btn-outline-success col-6">Acessar Leilão</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Leilão Presencial/Online N.º3</h5>
                    </div>
                    <div class="card-body">
                        <i class='fas fa-map-marker-alt'></i>
                        <p class='card-text'>Rua Imaculada Conceição, 1155 - Prado Velho, Curitiba</p>
                        <i class="fas fa-calendar-alt"></i>
                        <p class='card-text'>18/07/2023</p>
                        <div class="justify-content-center d-flex">
                            <button onclick="window.location.href = './../../pages/lotes/lotes.php?id=3'"; class="btn btn-outline-success col-6">Acessar Leilão</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include './../../components/footer/footer.html';
    ?>
    
</body>
</html>