<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../components/grid/grid.scss">
    <title>Grid</title>
</head>
<body>

    <?php
    $produtos = array(
        array("FORD", "FIESTA SEDAN", "PRETO", "2012/2013", "R$17.400,00", "SANTANDER", "11/03/2023", "15/03/2023"),
        array("PEUGEOUT", "208 GRIFFE", "PRATA", "2013/2014", "R$22.800,00", "SANTANDER", "10/03/2023", "17/03/2023"),
    );
    gerarGrid(array('Marca', 'Modelo do veículo', 'cor', 'Ano do veículo', 'Valor do lance', 'Financeira Responsável', 'Data lance', 'Data resultado'), $produtos);
    

    function gerarGrid($listaNomes, $dados) {
        echo "<table class='table table-hover'>";
        ECHO "<thead>";
        echo "<tr>";
        foreach ($listaNomes as $nome) {
            echo "<th scope='col'>$nome</th>";
        }
        echo "</tr>";
        echo "</thead>";

        echo "<tbody>";
        foreach ($dados as $dado) {
            echo "<th scope='row'>";

            foreach ($dado as $col) {
                echo "<td>" . $col . "</td>";
            }

            echo "</th>";
        }
        echo "</tbody>";
        echo "</table>";
    }
    ?>

    
</body>
</html>