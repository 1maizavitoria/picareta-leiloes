<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="leiloes.scss"> -->
    <!-- tamanho de 200px está influenciando a imagem da logo -->
    <title>Leilões</title>
</head>
<body>

    <?php
    include './../../components/header/header.php';
    ?>

    <h2 class="h1-responsive font-weight-bold text-center my-4">Leilões</h2>

    <div class="column align-items-center mid">
        <?php
        $leiloes = executeQuery("SELECT leilaoId, DATE_FORMAT(dataLeilao, '%d/%m/%Y %H:%i:%s') AS dataLeilao FROM leilao WHERE dataLeilao > NOW() ORDER BY leilaoId DESC");
        if (isset($_SESSION['tipoUsuario']))
            if ($_SESSION['tipoUsuario'] == 2)
                $leiloes = executeQuery("SELECT leilaoId, DATE_FORMAT(dataLeilao, '%d/%m/%Y %H:%i:%s') AS dataLeilao FROM leilao ORDER BY leilaoId DESC");

        $leiloes = mysqli_fetch_all($leiloes, MYSQLI_ASSOC);

        $timezone = new DateTimeZone('America/Sao_Paulo');
        $agora = new DateTime('now', $timezone);
        $agora = $agora->format('d/m/Y H:i:s');


        if ($leiloes != null) {
            foreach($leiloes as $leilao){
                $estado = $agora > $leilao["dataLeilao"] ? "<span class='badge bg-danger'>Encerrado</span>" : "<span class='badge bg-success'>Em andamento</span>";

                echo "<div class='col-5 mx-auto mb-5'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>Leilão Presencial/Online N.º" . $leilao["leilaoId"] . "</h5>
                            " . $estado . "
                        </div>
                        <div class='card-body'>
                            <i class='fas fa-map-marker-alt'> Local</i>
                            <p class='card-text'>Rua Imaculada Conceição, 1155 - Prado Velho, Curitiba</p>
                            <i class='fas fa-calendar-alt'> Data</i>
                            <p class='card-text'>" . $leilao["dataLeilao"] . "</p>
                            <div class='justify-content-center d-flex'>
                                <button onclick=\"window.location.href='./../../pages/lotes/lotes.php?id=" . $leilao["leilaoId"] . "'\" class='btn btn-outline-success col-6'>Acessar Leilão</button>
                            </div>
                        </div>
                    </div>
                </div>";
            }
        } else {
            echo "<h3 class='text-center mb-5 p-5'>Não há leilões disponíveis no momento.</h3>";
        }

        ?>
    </div>

    <?php
    include './../../components/footer/footer.php';
    ?>
    
</body>
</html>