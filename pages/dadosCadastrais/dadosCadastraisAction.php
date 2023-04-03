<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dadosCadastrais.scss">
    <link rel="stylesheet" href="dadosCadastraisAction.scss">
    <script type="text/javascript" src="./dadosCadastraisAction.js"></script>
    <title>Dados Cadastrais Registrados</title>
</head>

<body>
    <?php
    include './../../components/header/header.html';
    ?>

    <div class="content">

        <div class="right">

            <div class="d-flex justify-content-center my-5">
                <h2>Dados Registrados</h2>
            </div>

            <table class="user-info table-responsive">
                <script language=javascript>

                    var params = new Array();
                    params = getParameters();
                    for (let [key, value] of Object.entries(params)) {
                        document.write("<tr><td style='text-align: left; width:250px;'><b>" + key + "</b></td><td>" + value + "</td></tr>");
                    }

                </script>
            </table>

            <div class="col-6 col-lg-3 mx-auto d-flex justify-content-center">
                <button type="submit" value="voltar" class="btn btn-outline-success col-6" onclick="window.location.href='dadosCadastrais.php'">Voltar</button>
            </div>

        </div>
    </div>

    <?php
    include './../../components/footer/footer.html';
    ?>
    
</body>
</html>