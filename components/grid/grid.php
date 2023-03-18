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
    global $urlAtual;
    global $paginaAtual;
    $urlAtualComFiltros = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $urlAtual = substr($urlAtualComFiltros, 0, strpos($urlAtualComFiltros, '?'));

    $paginaAtual = isset($_GET['id']) ? $_GET['id'] : 0;

    function gerarGrid($listaNomes, $dados, $resultadosPorPagina) {
        global $paginaAtual;
        global $paginaMaxima;


        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["busca"])) {
            $busca = $_GET["busca"];
            $dados = array_filter($dados, function($carro) use ($busca) {
                return strpos(strtolower(implode(" ", $carro)), strtolower($busca)) !== false;
            });
          }

        $paginaMaxima = ceil(count($dados) / $resultadosPorPagina);

        $dados = array_slice($dados, $paginaAtual * 10, $resultadosPorPagina);

        echo "<div class='grid row'>";

        criarCampoBusca();
        
        echo "<table class='table table-hover table-responsive table-light table-striped mb-0'>";

        criarTableHeader($listaNomes);
        criarTableBody($dados);
      
        echo "</table>";

        if (empty($dados)) {
            echo "<div class='alert alert-danger' role='alert'>Nenhum resultado encontrado.</div>";
        }

        criarPaginacao();

        echo "</div>";
    }

    function criarTableHeader($listaNomes) {
        echo "<thead>";
        echo "<tr class='text-center'>";
        foreach ($listaNomes as $nome) {
            echo "<th scope='col'>$nome</th>";
        }
        echo "</tr>";
        echo "</thead>";
    }

    function criarTableBody($dados) {
        echo "
        <tbody>";

        foreach ($dados as $dado) {
            echo "<tr class='text-center'>";

            foreach ($dado as $col) {
                echo "<td>" . $col . "</td>";
            }

            echo "</tr>";
        }

        echo "
        </tbody>";
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

        $minimoPaginas = $paginaAtual <= 2 ? 0 : $paginaAtual - 2;
        $maximoPaginas = $paginaAtual <= 2 ? 5 : $paginaAtual + 3;
        $maximoPaginas = $maximoPaginas >= $paginaMaxima ? $paginaMaxima : $maximoPaginas;
        if ($maximoPaginas > $paginaMaxima && $minimoPaginas != 0 )
            $minimoPaginas = $paginaMaxima - 5;

        for ($i = $minimoPaginas; $i < $maximoPaginas; $i ++) {
            echo "
            <li class='page-item " . ($paginaAtual == $i ? "active" : null) . "'>
                <a class='page-link' href='" . montarParametrosPaginacao($i) ."'>" . $i + 1 . "</a>
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

    function criarCampoBusca() {
        echo "
        <form action='?id=0' class='formPesquisa' method='GET'>
            <div class='float-end'>
                <div class='input-group d-flex'>
                    <input type='text' name='busca' id='busca' class='input-group-text' placeholder='Informe a busca...' change='this.form.submit()'  value='" . (isset($_GET["busca"]) ? $_GET["busca"] : '') . "' " . (isset($_GET["busca"]) ? 'autofocus' : null) . ">
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