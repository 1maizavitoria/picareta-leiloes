<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lotes.scss">
    <title>Lotes</title>
</head>
<body>

    <?php
    include './../../components/header/header.html';
    ?>
    
    <div class="content">

        <div class="right">

            <div class="d-flex justify-content-center mt-5">
                <h2>Lotes do Leilão N.º<?php 
                if(isset($_GET["id"]))
                    echo $_GET["id"];
                 ?></h2>
            </div>

            <div class="col-10 px-5 my-3 d-flex justify-content-center">
                <?php 
                    include './../../components/grid/grid.php';
                    $produtos = array(
                        array("1", "FORD", "FIESTA SEDAN", "PRETO", "2012/2013", "R$17.400,00", "SANTANDER", "15/05/2023"),
                        array("2", "PEUGEOUT", "208 GRIFFE", "PRATA", "2013/2014", "R$22.800,00", "SANTANDER", "15/05/2023"),
                        array("3", "FORD", "KA", "BRANCO", "2017/2018", "R$35.000,00", "BANCO DO BRASIL", "15/05/2023"),
                        array("1", "CHEVROLET", "ONIX", "VERMELHO", "2020/2021", "R$54.900,00", "CAIXA ECONÔMICA FEDERAL", "15/05/2023"),
                        array("1", "FIAT", "UNO", "AZUL", "2015/2016", "R$20.000,00", "BRADESCO", "15/05/2023"),
                        array("1", "HYUNDAI", "HB20", "PRATA", "2018/2019", "R$45.000,00", "ITAU", "15/05/2023"),
                        array("1", "VOLKSWAGEN", "GOL", "PRETO", "2019/2020", "R$38.900,00", "SANTANDER", "15/05/2023"),
                        array("1", "RENAULT", "KWID", "BRANCO", "2019/2020", "R$29.500,00", "BANCO DO BRASIL", "15/05/2023"),
                        array("1", "TOYOTA", "COROLLA", "PRATA", "2016/2017", "R$68.000,00", "CAIXA ECONÔMICA FEDERAL", "15/05/2023"),
                        array("1", "NISSAN", "MARCH", "VERMELHO", "2014/2015", "R$22.000,00", "BRADESCO", "15/05/2023"),
                        array("1", "HONDA", "CITY", "CINZA", "2017/2018", "R$54.000,00", "ITAU", "15/05/2023"),
                        array("1", "FIAT", "PALIO", "AZUL", "2013/2014", "R$18.500,00", "SANTANDER", "15/05/2023"),
                        array("1", "MITSUBISHI", "ASX", "PRATA", "2015/2016", "R$75.000,00", "BANCO DO BRASIL", "15/05/2023"),
                        array("1", "VOLVO", "XC60", "PRETO", "2019/2020", "R$190.000,00", "CAIXA ECONÔMICA FEDERAL", "15/05/2023"),
                        array("1", "MERCEDES-BENZ", "CLASSE C", "BRANCO", "2018/2019", "R$185.000,00", "BRADESCO", "15/05/2023"),
                        array("1", "FORD", "FIESTA SEDAN", "PRETO", "2012/2013", "R$17.400,00", "SANTANDER", "15/05/2023"),
                        array("1", "PEUGEOUT", "208 GRIFFE", "PRATA", "2013/2014", "R$22.800,00", "SANTANDER", "15/05/2023"),
                        array("1", "FORD", "KA", "BRANCO", "2017/2018", "R$35.000,00", "BANCO DO BRASIL", "15/05/2023"),
                        array("1", "CHEVROLET", "ONIX", "VERMELHO", "2020/2021", "R$54.900,00", "CAIXA ECONÔMICA FEDERAL", "15/05/2023"),
                        array("1", "FIAT", "UNO", "AZUL", "2015/2016", "R$20.000,00", "BRADESCO", "15/05/2023"),
                        array("1", "HYUNDAI", "HB20", "PRATA", "2018/2019", "R$45.000,00", "ITAU", "15/05/2023"),
                        array("1", "VOLKSWAGEN", "GOL", "PRETO", "2019/2020", "R$38.900,00", "SANTANDER", "15/05/2023"),
                        array("1", "RENAULT", "KWID", "BRANCO", "2019/2020", "R$29.500,00", "BANCO DO BRASIL", "15/05/2023"),
                        array("1", "TOYOTA", "COROLLA", "PRATA", "2016/2017", "R$68.000,00", "CAIXA ECONÔMICA FEDERAL", "15/05/2023"),
                        array("1", "NISSAN", "MARCH", "VERMELHO", "2014/2015", "R$22.000,00", "BRADESCO", "15/05/2023"),
                        array("1", "HONDA", "CITY", "CINZA", "2017/2018", "R$54.000,00", "ITAU", "15/05/2023"),
                        array("1", "FIAT", "PALIO", "AZUL", "2013/2014", "R$18.500,00", "SANTANDER", "15/05/2023"),
                        array("1", "MITSUBISHI", "ASX", "PRATA", "2015/2016", "R$75.000,00", "BANCO DO BRASIL", "15/05/2023"),
                        array("1", "VOLVO", "XC60", "PRETO", "2019/2020", "R$190.000,00", "CAIXA ECONÔMICA FEDERAL", "15/05/2023"),
                        array("1", "MERCEDES-BENZ", "CLASSE C", "BRANCO", "2018/2019", "R$185.000,00", "BRADESCO", "15/05/2023"),
                        array("1", "FORD", "FIESTA SEDAN", "PRETO", "2012/2013", "R$17.400,00", "SANTANDER", "15/05/2023"),
                        array("1", "PEUGEOUT", "208 GRIFFE", "PRATA", "2013/2014", "R$22.800,00", "SANTANDER", "15/05/2023"),
                        array("1", "FORD", "KA", "BRANCO", "2017/2018", "R$35.000,00", "BANCO DO BRASIL", "15/05/2023"),
                        array("1", "CHEVROLET", "ONIX", "VERMELHO", "2020/2021", "R$54.900,00", "CAIXA ECONÔMICA FEDERAL", "15/05/2023"),
                        array("1", "FIAT", "UNO", "AZUL", "2015/2016", "R$20.000,00", "BRADESCO", "15/05/2023"),
                        array("1", "HYUNDAI", "HB20", "PRATA", "2018/2019", "R$45.000,00", "ITAU", "15/05/2023"),
                        array("1", "VOLKSWAGEN", "GOL", "PRETO", "2019/2020", "R$38.900,00", "SANTANDER", "15/05/2023"),
                        array("1", "RENAULT", "KWID", "BRANCO", "2019/2020", "R$29.500,00", "BANCO DO BRASIL", "15/05/2023"),
                        array("1", "TOYOTA", "COROLLA", "PRATA", "2016/2017", "R$68.000,00", "CAIXA ECONÔMICA FEDERAL", "15/05/2023"),
                    );
                
                    $titulos = array('Marca', 'Modelo do veículo', 'Cor', 'Ano do veículo', 'Valor atual', 'Financeira Responsável', 'Data resultado');
                
                    $editavel = false;
                    $urlClick = "https://www.google.com?id=";

                    gerarGrid($titulos, $produtos, 12, $editavel,  $urlClick);
                ?>
            </div>

        </div>

    </div>

    <?php include './../../components/footer/footer.html'; ?>
    
</body>
</html>