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
    $id = $_GET['id'];
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
        <?php
        $selectLote = executeQuery("SELECT CASE WHEN v.arCondicionado = 1 THEN 'Sim' ELSE 'Não' end as arCondicionado, CASE WHEN v.vidroEletrico = 1 THEN 'Sim' ELSE 'Não' end as vidroEletrico,  v.hodometro, v.anoFabricacao, fi.descricaoFinanceira as financeira, ma.descricao as descricaoMarca, mo.descricao as descricaoModelo from lote lo inner join financeira fi on fi.financeiraId = lo.financeiraId  inner join veiculo v on v.veiculoId = lo.veiculoId inner join modelocor mc on mc.modeloCorId = v.modeloCorId inner join modelo mo on mo.modeloId = mc.modeloId inner join marca ma on ma.marcaId = mo.marcaId where lo.loteId = '$id'");
        $selectLote = mysqli_fetch_assoc($selectLote);
        echo'
                <div class="card-header text-center text-uppercase"><h2>' . $selectLote["descricaoMarca"] . ' <span class="text-blue">' . $selectLote["descricaoModelo"] . '</span></h2> </div>
                <div class="row">
                    <div class="col-6">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img  class=" d-block w-100 h-100" src="./../loteVeiculo/images/eclipse-direita.jpg"  >
                            </div>
                            <div class="carousel-item">
                            <img  class=" d-block w-100 h-100" src="./../loteVeiculo/images/aaa.jpg"  >
                            </div>
                            <div class="carousel-item">
                            <img  class=" d-block w-100 h-100" src="./../loteVeiculo/images/eclipse-direita.jpg"  >
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    </div>
                    <div class="col-6 mt-3">
                        <div class="row">
                            <div class="col-4">
                                <h4 class="font-label">Lance Atual</h4>
                                <h2 class="font-info" style="font-size: 20px;">R$45.000,00</h2>
                            </div>
                            <div class="col-4">
                                <h4 class="font-label">Financeira</h4>
                                <h3 class="font-info" style="font-size: 20px;">' . $selectLote["financeira"] . '</h3>
                            </div>
                            
                            <div class="col-4">
                                <h4 class="font-label"> Ano/Modelo </h4>
                                <h3 class="font-info">' . $selectLote["anoFabricacao"] . '/1998</h3>
                            </div>
                            <div class="col-4">
                                <h4 class="font-label">Odômetro</h4>
                                <h3 class="font-info">' . $selectLote["hodometro"] . '</h3>
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
                                <h3 class="font-info">' . $selectLote["vidroEletrico"] . '</h3>
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
                                <div class="card-body">';
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

                        gerarGrid($titulos, $produtos, 5, $editavel,  $urlClick);'
                                </div>';
                                ?>
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