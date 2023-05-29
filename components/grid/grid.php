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
    global $paginaAtual;
    $urlAtualComFiltros = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $urlAtual = substr($urlAtualComFiltros, 0, strpos($urlAtualComFiltros, '?'));

    $paginaAtual = isset($_GET['id']) ? $_GET['id'] : 0;

    function gerarGrid($listaNomes, $dados, $resultadosPorPagina, $editavel, $urlClick) {
        global $paginaAtual;
        global $paginaMaxima;

        if ($resultadosPorPagina == 5)
            $paginaAtual = 0;


        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["busca"])) {
            $busca = $_GET["busca"];
            $dados = array_filter($dados, function($carro) use ($busca) {
                return strpos(strtolower(implode(" ", $carro)), strtolower($busca)) !== false;
            });
        }

        $paginaMaxima = ceil(count($dados) / $resultadosPorPagina);

        $dados = array_slice($dados, $paginaAtual * $resultadosPorPagina, $resultadosPorPagina);

        echo "<div class='grid row'>";
        echo "<div class='col-12'>";

        if ($resultadosPorPagina != 5)
            criarCampoBusca($editavel, $urlClick);
        
        echo "<table class='table table-hover table-responsive table-light table-striped mb-0'>";

        criarTableHeader($listaNomes, $editavel);
        criarTableBody($dados, $editavel, $urlClick);
      
        echo "</table>";

        if (empty($dados)) {
            echo "<div class='alert alert-danger' role='alert'>Nenhum resultado encontrado.</div>";
        } else if ($resultadosPorPagina != 5) {
            criarPaginacao();
        }	

        echo "</div>";
        echo "</div>";
    }

    function criarTableHeader($listaNomes, $editavel) {
        echo "<thead>";
        echo "<tr class='text-center'>";
        foreach ($listaNomes as $nome) {
            echo "<th scope='col'>$nome</th>";
        }
        if ($editavel)
            criarHeaderEditavel();
        echo "</tr>";
        echo "</thead>";
    }

    function criarTableBody($dados, $editavel, $urlClick) {
        echo "
        <tbody>";

        foreach ($dados as $dado) {
            $contador = 0;
            if ($urlClick)
                echo "<tr class='text-center' style='cursor: pointer;'  onclick=\"window.location.href='$urlClick" . $dado[0] ."'\">";
            else
                echo "<tr class='text-center'>";
            foreach ($dado as $col) {
                if ($contador > 0) {
                    echo "<td>" . $col . "</td>";
                }   
                $contador++;
            }
            if ($editavel)
                criarEdicao();

            echo "</tr>";
        }

        echo "
        </tbody>";
    }

    function criarHeaderEditavel() {
        echo "<th scope='col'>Editar</th>";
    }

    function criarEdicao() {
        echo "<td><i class='fa-solid fa-pen-to-square'></i></td>";
    }

    function criarPaginacao() {
        echo "
            <nav class='paginacao'>
                <ul class='pagination'>";

                criarBotaoPrimeiraPagina();
                criarBotaoPaginacaoAnterior();
                criarBotoesPaginacao();
                criarBotaoProximaPaginacao();
                criarBotaoUltimaPagina();

                echo "
                </ul>
            </nav>";
    }

    function criarBotaoPrimeiraPagina() {
        echo "
        <li class='page-item'>
            <a class='page-link' href='" . calcularPrimeiraPagina() . "' aria-label='Previous'>
                <span aria-hidden='true'>&laquo;</span>
            </a>
        </li>";
    }

    function criarBotaoPaginacaoAnterior() {
        echo "
        <li class='page-item'>
            <a class='page-link' href='" . calcularPaginas(false) . "' aria-label='Previous'>
                <span aria-hidden='true'>&lsaquo;</span>
            </a>
        </li>";
    }

    function criarBotoesPaginacao() {
        global $paginaAtual;
        global $paginaMaxima;

        $botoesNaFrente = $paginaAtual <= 2 ? 5 : $paginaAtual + 3;
        $botoesNaFrente = $botoesNaFrente >= $paginaMaxima ? $paginaMaxima : $botoesNaFrente;

        

        if ($paginaAtual <= 2) {
            $botoesAtras = 0;
            $botoesNaFrente = $paginaMaxima <= 5 ? $paginaMaxima : 5;
        } else if ($botoesNaFrente == $paginaMaxima){
            $botoesAtras = $paginaMaxima - 5;
        } else if ($botoesNaFrente > $paginaMaxima && $botoesAtras != 0 ){
            $botoesAtras = $paginaMaxima - 5;
        } else {
            $botoesAtras = $paginaAtual - 2;
            $botoesNaFrente = $paginaAtual + 3;
        }
        
        if($botoesAtras < 0)
        $botoesAtras = 0;
        
        for ($i = $botoesAtras; $i < $botoesNaFrente; $i ++) {
            echo "
            <li class='page-item " . ((int)$paginaAtual == (int)$i ? "active" : null) . "'>
                <a class='page-link' href='" .  ((int)$paginaAtual == (int)$i ? '#' : montarParametrosPaginacao((int)$i)) . "'>" . $i + 1 . "</a>
            </li>";
        }
    }

    function criarBotaoProximaPaginacao() {
        echo "
        <li class='page-item'>
            <a class='page-link' href='" . calcularPaginas(true) . "' aria-label='Next'>
                <span aria-hidden='true'>&rsaquo;</span>
            </a>
        </li>";
    }

    function criarBotaoUltimaPagina() {
        echo "
        <li class='page-item'>
            <a class='page-link' href='" . calcularUltimaPagina() . "' aria-label='Next'>
                <span aria-hidden='true'>&raquo;</span>
            </a>
        </li>";
    }

    function criarCampoBusca($editavel, $urlClick) {
        echo "
        <form action='?id=0' class='formPesquisa' method='GET'>";
            if ($editavel)
                echo "
                <div class='float-start'>
                    <button type='button' class='btn btn-success col-12' onclick=\"window.location.href='$urlClick'\">Novo</button>
                </div>
                ";

            echo " <div class='float-end'>
                <div class='input-group d-flex'>
                    <input type='text' name='busca' id='busca' class='input-group-text' placeholder='Informe a busca...' change='this.form.submit()'  value='" . (isset($_GET["busca"]) ? $_GET["busca"] : '') . "'>
                    <button type='submit' class='btn btn-primary search-icon' aria-label='Pesquisar'>
                        <i class='fas fa-search'></i>
                    </button>
                </div>
            </div>
        </form>";
        focusNoFinalDoInput();
    }

    function focusNoFinalDoInput() {
        echo "
            <script>
            var input = document.getElementById('busca');
            input.focus();
            var length = input.value.length;
            input.setSelectionRange(length, length);
            </script>";
    }

    function montarParametrosPaginacao($numeroPagina) {
        global $urlAtual;
        $resultado = "$urlAtual?id=$numeroPagina" . (isset($_GET["busca"]) ? "&busca=" . $_GET["busca"] : null);
        $resultado = (isset($_GET["leilaoId"])) ? $resultado . "&leilaoId=" . $_GET["leilaoId"] : $resultado;
        return $resultado;
    }

    function calcularPrimeiraPagina() {
        global $paginaAtual;
        global $paginaMaxima;

        return $paginaAtual == 0 ? '#' : montarParametrosPaginacao(0);
    }

    function calcularUltimaPagina() {
        global $paginaAtual;
        global $paginaMaxima;

        return $paginaAtual + 1 == $paginaMaxima ? '#' : montarParametrosPaginacao($paginaMaxima - 1);
    }

    function calcularPaginas($positivo) {
        global $paginaAtual;
        global $paginaMaxima;

        if ($positivo) {
            return $paginaAtual + 1 >= $paginaMaxima ?  '#' : montarParametrosPaginacao($paginaAtual + 1);
        } else {
            return $paginaAtual - 1 < 0 ?  '#' : montarParametrosPaginacao($paginaAtual - 1);
        }
    }

    function console_log( $data ) {
        $output  = "<script>console.log( 'PHP debugger: ";
        $output .= json_encode(print_r($data, true));
        $output .= "' );</script>";
        echo $output;
    }
    ?>
    
</body>
</html>