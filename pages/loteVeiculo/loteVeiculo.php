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
    include './../../components/toastr/toastr.php';
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST["incrementar"])) {
            $selectLote = executeQuery("SELECT lo.valorInicial, lo.loteId from lote lo where lo.loteId = '$id'");
            $selectLote = mysqli_fetch_assoc($selectLote);
            $lanceAtual = executeQuery("select la.valorLance from lance la where la.loteId = '$id' and la.lanceId = (SELECT MAX(lanceId)FROM lance WHERE loteId = '$id' ) ");
            $lanceAtual = mysqli_fetch_assoc($lanceAtual);
            $lanceAtual = ($lanceAtual == null ? $selectLote["valorInicial"] : $lanceAtual["valorLance"]);
            $lote = executeQuery("SELECT lo.leilaoId, lo.loteId, lo.valorIncremento from lote lo  where lo.loteId = '$id'");
            $lote = mysqli_fetch_assoc($lote);
            $loteId = $lote["loteId"];
            $leilaoId = $lote["leilaoId"];
            $valorIncremento = $lote["valorIncremento"];
            $valorLance = $lanceAtual + $valorIncremento;
            $loginId = $_SESSION['loginId'] ?? -1;
            $tipoUsuario = $_SESSION['tipoUsuario'] ?? -1;

       
            $cadastroCompleto = executeQuery("SELECT * FROM pessoa WHERE loginId = $loginId");
            $cadastroCompleto = mysqli_fetch_assoc($cadastroCompleto);

            if ($loginId == -1) {
               toastr('error', 'Você precisa estar logado para dar um lance.');
            } else if ($tipoUsuario != 1) {
                toastr('error', 'Você precisa ser um usuário comum para dar um lance.');
            } else if ($cadastroCompleto == null) {
                toastr('error', 'Você precisa completar seu cadastro para dar um lance.');
            }
            } else {
                executeQuery("INSERT INTO lance( dataLance, leilaoId, valorLance, loteId, loginId) VALUES (CURRENT_TIMESTAMP() ,'$leilaoId','$valorLance','$loteId','$loginId')");
                header("Location: http://localhost/picareta_leiloes/pages/loteVeiculo/loteVeiculo.php?id=$id");
            }
    

        }
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
        $selectLote = executeQuery("SELECT lo.leilaoId, le.dataLeilao > NOW() as vigente, mo.anoModelo, lo.veiculoId, lo.valorIncremento, lo.valorInicial, v.kitGnv, v.documentoParaRodar, v.kitMultimidia, v.sinistro, v.ipvaQuitado, v.cambioAutomatico, v.direcao, v.tipoCombustivel, v.valorDespesas, CASE WHEN v.arCondicionado = 1 THEN 'Sim' ELSE 'Não' end as arCondicionado, CASE WHEN v.vidroEletrico = 1 THEN 'Sim' ELSE 'Não' end as vidroEletrico,  v.hodometro, v.anoFabricacao, fi.descricaoFinanceira as financeira, ma.descricao as descricaoMarca, mo.descricao as descricaoModelo from lote lo inner join financeira fi on fi.financeiraId = lo.financeiraId  inner join veiculo v on v.veiculoId = lo.veiculoId inner join modelocor mc on mc.modeloCorId = v.modeloCorId inner join modelo mo on mo.modeloId = mc.modeloId inner join marca ma on ma.marcaId = mo.marcaId inner join leilao le on le.leilaoId = lo.leilaoId where lo.loteId = '$id'");
        $selectLote = mysqli_fetch_assoc($selectLote);
        $tipoCombustivel; 
        $direcao;
        $lanceAtual = executeQuery("select la.valorLance from lance la where la.loteId = '$id' and la.lanceId = (SELECT MAX(lanceId)FROM lance WHERE loteId = '$id' ) ");
        $lanceAtual = mysqli_fetch_assoc($lanceAtual);
        $lanceAtual = ($lanceAtual == null ? $selectLote["valorInicial"] : $lanceAtual["valorLance"]);
        $imagens = executeQuery("SELECT iv.imagem FROM imagemVeiculo iv WHERE iv.tipoImagem in(1,2, 3, 4, 5, 6,  7) and iv.veiculoId = '. $selectLote["veiculoId"]. ' ");
        $imagens = mysqli_fetch_array($imagens, MYSQLI_NUM);
 
        switch($selectLote["tipoCombustivel"]){
            case 1 : 
                $tipoCombustivel = "Álcool";
                break;
            case 2 :
                $tipoCombustivel = "Gasolina";
                break;
            case 3 :
                $tipoCombustivel = "Flex";
                break;
            case 4 : 
                $tipoCombustivel = "Diesel";
                break;
            case 5 : 
                $tipoCombustivel = "Híbrido";
                break;
            case 6 : 
                $tipoCombustivel = "Elétrico";
                break;
        }
        
        switch($selectLote["direcao"]){
            case 1 : 
                $direcao = "Mecânica";
                break;
            case 2 :
                $direcao = "Hidráulica";
                break;

            case 3 :
                $direcao = "Assistida";
                break;

            case 4 : 
                $direcao = "Elétrica";
                break;

        }
 
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
                        'foreach ($imagens as $imagem) {
                            echo '<div class="carousel-item active">
                            <img  class=" d-block w-100 h-100" src="data:image/gif;base64,' . base64_encode($imagem["imagem"]). '""  >
                            </div>';
                        }'
                           
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
                                <h2 class="font-info" style="font-size: 20px;">R$' . number_format($lanceAtual, 2, ',', '.') . '</h2>
                            </div>
                            <div class="col-4">
                                <h4 class="font-label">Financeira</h4>
                                <h3 class="font-info" style="font-size: 20px;">' . $selectLote["financeira"] . '</h3>
                            </div>
                            
                            <div class="col-4">
                                <h4 class="font-label"> Ano/Modelo </h4>
                                <h3 class="font-info">' . $selectLote["anoFabricacao"] . '/' . $selectLote["anoModelo"] .'</h3>
                            </div>
                            <div class="col-4">
                                <h4 class="font-label">Hodômetro</h4>
                                <h3 class="font-info">' . number_format($selectLote["hodometro"], 0, ',', '.') . ' Km' . '</h3>
                            </div>

                            <div class="col-4">
                                <h4 class="font-label">Câmbio</h4>
                                <h3 class="font-info">' . ($selectLote["cambioAutomatico"] ? "Automático" : "Manual" ) . '</h3>
                            </div>

                            <div class="col-4">
                                <h4 class="font-label">Combustível</h4>
                                <h3 class="font-info">' . $tipoCombustivel .'</h3>
                            </div>

                            <div class="col-4">
                                <h4 class="font-label">Direção</h4>
                                <h3 class="font-info">' . $direcao .'</h3>
                            </div>

                            <div class="col-4">
                                <h4 class="font-label">Despesas Administrativas</h4>
                                <h3 class="font-info">R$' . number_format($selectLote["valorDespesas"], 2, ',', '.') . '</h3>
                            </div>

                            <div class="col-4">
                                <h4 class="font-label">Ar Condicionado</h4>
                                <h3 class="font-info">' . $selectLote["arCondicionado"] . '</h3>
                            </div>
                            <div class="col-4">
                                <h4 class="font-label">Vidro Elétrico</h4>
                                <h3 class="font-info">' . $selectLote["vidroEletrico"] . '</h3>
                            </div>

                            <div class="col-4">
                                <h4 class="font-label">Sinistro</h4>
                                <h3 class="font-info">' . ($selectLote["sinistro"] ? "Sim" : "Não" ) . '</h3>
                            </div>

                            <div class="col-4">
                                <h4 class="font-label">IPVA Quitado</h4>
                                <h3 class="font-info">' . ($selectLote["ipvaQuitado"] ? "Sim" : "Não" ) . '</h3>
                            </div>
                            <div class="col-4">
                                <h4 class="font-label">Doc p/ Rodar</h4>
                                <h3 class="font-info">' . ($selectLote["documentoParaRodar"] ? "Sim" : "Não" ) . '</h3>
                            </div>
                            <div class="col-4">
                                <h4 class="font-label">Multimídia</h4>
                                <h3 class="font-info">' . ($selectLote["kitMultimidia"] ? "Sim" : "Não" ) . '</h3>
                            </div>
                            <div class="col-4">
                                <h4 class="font-label">GNV</h4>
                                <h3 class="font-info">' . ($selectLote["kitGnv"] ? "Sim" : "Não" ) . '</h3>
                            </div>
                            <div class="mt-3 float-right text-center">
                            ' . ($selectLote["vigente"] ? '<button class="btn btn-success" data-toggle="modal" data-target="#exampleModal"> Incrementar R$' . number_format($selectLote["valorIncremento"], 2, ',', '.') . '</button>' : '').
                            '</div>
                            <form class="row d-flex justify-content-center" id="form" action="" method="POST">

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Dar lance</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza que deseja dar um lance?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                                <button class="btn btn-success" name="incrementar"> Incrementar R$' . number_format($selectLote["valorIncremento"], 2, ',', '.') . '</button>
                                </div>
                                </div>
                            </div>
                            </div>

                        </div>
                            
                            </form>

                            <div class="card mt-3">
                                <div class="card-body">';
                        include './../../components/grid/grid.php';


                        $titulos = array('Valor lance', 'Usuário');
                        $editavel = false;
                        $lances = array();
                        $loginId = $_SESSION['loginId'] ?? -1;
                        $selectLances = executeQuery("select REPLACE(CONCAT('R$', la.valorLance), '.', ',') as valorLance, loginId, lanceId from lance la where la.loteId = '$id' order by la.valorLance desc");
                        while($row = mysqli_fetch_assoc($selectLances)){
                            $lances[] = array($row['lanceId'], $row['valorLance'], $row['loginId'] == $loginId ? $row['loginId'] . " (Eu)" : $row['loginId']);
                        }
                        
                        
                        gerarGrid($titulos, $lances, 5, $editavel, null);
                                
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