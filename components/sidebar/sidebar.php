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

    <div class="sidebar opened bg-info" id="sidebar">

        <div class="buttonsSidebar">

            <?php 
            if (isset($_SESSION['tipoUsuario'])) {
                $tipoUsuario = $_SESSION['tipoUsuario'];
                if ($tipoUsuario == 1) {
                    echo "
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/dadosCadastrais/dadosCadastrais.php'\">
                        <div class='d-flex col-12'>
                            <i class='fa-solid fa-clipboard-user fa-2xl logo'></i>
                            <p class='mx-auto'>Dados cadastrais</p>
                        </div>
                        <hr class='hrSidebar'>
                    </div>
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/historicoLances/historicoLances.php'\">
                        <div class='d-flex col-12'>
                            <i class='fa-solid fa-clock-rotate-left fa-2xl logo'></i>
                            <p class='mx-auto'>Histórico de lances</p>
                        </div>   
                        <hr class='hrSidebar'>
                    </div>
                    ";
                } else {
                    echo "
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/cadastroMarca/cadastroMarca.php'\">
                        <div class='d-flex col-12'>    
                            <i class='fa-solid fa-copyright fa-2xl logo'></i>    
                            <p class='mx-auto'>Cadastro de marca</p>
                        </div>   
                        <hr class='hrSidebar'>
                    </div>
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/cadastroCor/cadastroCor.php'\">
                        <div class='d-flex col-12'>    
                            <i class='fa-solid fa-palette fa-2xl logo'></i>    
                            <p class='mx-auto'>Cadastro de cor</p>
                        </div>   
                        <hr class='hrSidebar'>
                    </div>
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/cadastroModelo/cadastroModelo.php'\">
                        <div class='d-flex col-12'>    
                            <i class='fa-solid fa-car-side fa-2xl logo'></i>    
                            <p class='mx-auto'>Cadastro de modelo</p>
                        </div>   
                        <hr class='hrSidebar'>
                    </div>
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/cadastroModeloCor/cadastroModeloCor.php'\">
                        <div class='d-flex col-12'>    
                            <i class='fa-solid fa-paintbrush fa-2xl logo'></i>    
                            <p class='mx-auto'>Cadastro de modelo/cor</p>
                        </div>   
                        <hr class='hrSidebar'>
                    </div>
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/cadastroVeiculo/cadastroVeiculo.php'\">
                        <div class='d-flex col-12'>    
                            <i class='fa-solid fa-car fa-2xl logo'></i>    
                            <p class='mx-auto'>Cadastro de veiculo</p>
                        </div>   
                        <hr class='hrSidebar'>
                    </div>
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/cadastroLeilao/cadastroLeilao.php'\">
                        <div class='d-flex col-12'>    
                            <i class='fa-solid fa-gavel fa-2xl logo'></i>    
                            <p class='mx-auto'>Cadastro de leilao</p>
                        </div>   
                        <hr class='hrSidebar'>
                    </div>
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/cadastroFinanceira/cadastroFinanceira.php'\">
                        <div class='d-flex col-12'>    
                            <i class='fa-solid fa-coins fa-2xl logo'></i>    
                            <p class='mx-auto'>Cadastro de financeira</p>
                        </div>   
                        <hr class='hrSidebar'>
                    </div>
                    <div class='buttonSidebar' onclick=\"window.location.href='./../../pages/cadastroLote/cadastroLote.php'\">
                        <div class='d-flex col-12'>    
                            <i class='fa-solid fa-table-list fa-2xl logo'></i>    
                            <p class='mx-auto'>Cadastro de lote</p>
                        </div>   
                        <hr class='hrSidebar'>
                    </div>
                    ";
                }
            }
            ?>
        </div>

        <div>
            <button class="btn btn-secondary col-12" onclick="toggleSidebar()"><i class="fa-solid fa-arrow-right-arrow-left"></i></i></button>
            <button class="btn btn-danger col-12" onclick="window.location.href='./../../pages/logout/logout.php'">Sair</button>
        </div>

    </div>
    
</body>
</html>