<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loteVeiculo.scss">
    
    <title>Lotes</title>
</head>
<body>

    <?php
    include './../../components/header/header.php';
    ?>

    <div class="h-100">
        <div class="d-flex justify-content-center align-items-center col-12 my-4">
        <div class="col-1 d-flex justify-content-center" >
            <i class="fa-sharp fa-solid fa-circle-arrow-left pointer" style="color: #3065ac; font-size: 20px;"></i>
        </div>
        <div class="col-1 d-flex justify-content-center align-items-center">
        <div class="d-flex flex-column justify-content-center ">
        <span class="font-avancar">Lote <?php if(isset($_GET["id"]))
                    echo $_GET["id"];
                    ?></h2> </span>
        </div>
    </div>
        <div class="col-1 d-flex justify-content-center">   
            <i class="fa-sharp fa-solid fa-circle-arrow-right pointer" style="color: #3065ac; font-size: 20px;"></i>             
        </div>
    </div>
        <div class="card mx-5">

            <div class="card-body col-12">
                <div class="card-header text-center text-uppercase"><h2>Mitsubishi <span class="text-blue">Eclipse</span></h2> </div>
                <div class="row">
                    <div class="col-6">
                        <img  class="img-fluid h-100" src="./../loteVeiculo/images/eclipse-direita.jpg"  >
                    </div>
                    <div class="col-6 mt-3">
                        <div class="row">
                            <div class="col-4">
                                <h4 class="font-label">Lance Atual</h4>
                                <h2 class="font-info" style="font-size: 20px;">R$45.000,00</h2>
                            </div>
                            <div class="col-4">
                                <h4 class="font-label">Financeira</h4>
                                <h3 class="font-info" style="font-size: 20px;">Bradesco</h3>
                            </div>
                            
                            <div class="col-4">
                                <h4 class="font-label">Ano</h4>
                                <h3 class="font-info">1998/1998</h3>
                            </div>
                            <div class="col-4">
                                <h4 class="font-label">Odômetro</h4>
                                <h3 class="font-info">80.000</h3>
                            </div>

                            <div class="col-4">
                                <h4 class="font-label">Câmbio</h4>
                                <h3 class="font-info">Manual</h3>
                            </div>

                            <div class="col-4">
                                <h4 class="font-label">Combustível</h4>
                                <h3 class="font-info">Gasolina</h3>
                            </div>

                            <div class="col-4">
                                <h4 class="font-label">Direção</h4>
                                <h3 class="font-info">Hidráulica</h3>
                            </div>

                            <div class="col-4">
                                <h4 class="font-label">Despesas Administrativas</h4>
                                <h3 class="font-info">R$1.450,00</h3>
                            </div>

                            <div class="col-4">
                                <h4 class="font-label">Ar Condicionado</h4>
                                <h3 class="font-info">Sim</h3>
                            </div>
                            <div class="col-4">
                                <h4 class="font-label">Vidro Elétrico</h4>
                                <h3 class="font-info">Sim</h3>
                            </div>

                            <div class="col-4">
                                <h4 class="font-label">Sinistro</h4>
                                <h3 class="font-info">Não</h3>
                            </div>

                            <div class="col-4">
                                <h4 class="font-label">IPVA Quitado</h4>
                                <h3 class="font-info">Sim</h3>
                            </div>
                            <div class="col-4">
                                <h4 class="font-label">Doc p/ Rodar</h4>
                                <h3 class="font-info">Sim</h3>
                            </div>

                            <div class="mt-3 float-right text-center">
                                <button class="btn btn-success"> Incrementar R$500,00</button>
                            </div>

                            <div class="card mt-3">
                                <div class="card-body"> 
                                <?php 
                        include './../../components/grid/grid.php';
                        $produtos = array(
                            array("5", "R$45.000,00", "231442"),
                            array("4", "R$44.500,00", "284875"),
                            array("3", "R$44.000,00", "231442"),
                            array("2", "R$43.500,00", "284875"),
                            array("1", "R$43.000,00", "231442"),
                        
                        );
                    
                        $titulos = array('Lance', 'Usuário');
                    
                        $editavel = false;
                        $urlClick = "";

                        gerarGrid($titulos, $produtos, 5, $editavel,  $urlClick);
                    ?>
                                </div>
                            </div>

                            
                        </div>
                        
                    </div>
                </div>

            
            </div>

        </div>
    </div>

    <?php include './../../components/footer/footer.php'; ?>
    
</body>
</html>