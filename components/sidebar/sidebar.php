<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../components/sidebar/sidebar.scss">
    <script src="./../../components/sidebar/sidebar.js"></script>
    <title>Sidebar</title>
</head>
<body>

    <div class="sidebar opened" id="sidebar">

        <div class="buttonsSidebar">

            <?php 
                $tipoUsuario = $_SESSION['tipoUsuario'];
                if ($tipoUsuario == 1) {
                    echo "
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/dadosCadastrais/dadosCadastrais.php'\">
                        <p>Dados cadastrais</p>
                        <hr class='hrSidebar'>
                    </div>
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/historicoLances/historicoLances.php'\">
                        <p>Histórico de lances</p>
                        <hr class='hrSidebar'>
                    </div>
                    ";
                } else {
                    echo "
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/cadastroMarca/cadastroMarca.php'\">
                        <p>Cadastro de marca</p>
                        <hr class='hrSidebar'>
                    </div>
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/cadastroCor/cadastroCor.php'\">
                        <p>Cadastro de cor</p>
                        <hr class='hrSidebar'>
                    </div>
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/cadastroModelo/cadastroModelo.php'\">
                        <p>Cadastro de modelo</p>
                        <hr class='hrSidebar'>
                    </div>
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/cadastroModeloCor/cadastroModeloCor.php'\">
                        <p>Cadastro de modelo cor</p>
                        <hr class='hrSidebar'>
                    </div>
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/cadastroVeiculo/cadastroVeiculo.php'\">
                        <p>Cadastro de veiculo</p>
                        <hr class='hrSidebar'>
                    </div>
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/cadastroLeilao/cadastroLeilao.php'\">
                        <p>Cadastro de leilao</p>
                        <hr class='hrSidebar'>
                    </div>
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/cadastroFinanceira/cadastroFinanceira.php'\">
                        <p>Cadastro de financeira</p>
                        <hr class='hrSidebar'>
                    </div>
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/cadastroLote/cadastroLote.php'\">
                        <p>Cadastro de lote</p>
                        <hr class='hrSidebar'>
                    </div>
                    ";
                }
            ?>
        </div>

        <div>
            <button class="btn btn-secondary col-12" onclick="toggleSidebar()"><i class="fa-solid fa-arrow-right-arrow-left"></i></i></button>
        </div>

    </div>
    
</body>
</html>