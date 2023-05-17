<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.scss">
    <script type="module" src="./index.js"></script>
    <title>Home</title>
</head>
<body>

    <?php
    include './../../components/header/header.php';
    ?>

    <div class="container d-flex flex-column gap-3">

        <div class="row justify-content-center mt-2">

            <div class="col-md-9 col-lg-6">
                <img src="./images/sell.jpg" alt="Imagem">
            </div>

            <div class="col-md-8 col-lg-6 mt-2">
                <h2>Nossa História</h2>
                <p>
                    O Picareta Leilões surgiu a partir do trabalho árduo, dedicação e paixão. 
                    Começou com uma pequena equipe dedicada de funcionários, incluindo um 
                    leiloeiro experiente e um grupo de mecânicos habilidosos para garantir 
                    que os carros estivessem em boas condições antes de irem para o leilão. 
                    Em pouco tempo de mercado, conquistamos a confiança dos clientes, garantindo
                    qualidade, honestidade e integridade nos negócios.
                </p>
            </div>
        </div>

        <div class="col-md-12 mt-2">
                <h2 class="d-flex justify-content-center">O que fazemos?</h2>
                <p>
                    Realizamos leilões de carros usados e para isso, montamos eventos em que os veículos são colocados à venda para os licitantes oferecerem lances e competirem entre si para adquirir os carros. Um leilão é uma forma de venda em que os veículos são oferecidos a compradores interessados por meio de um processo competitivo de lances. O objetivo principal de um leilão de carros usados é permitir que os vendedores vendam seus veículos e que os compradores adquiram carros usados a preços competitivos. Nossos leilões são realizados fisicamente em um local específico, <a href="./../../pages/leiloes/leiloes.php">clique aqui</a> para ver os eventos disponíveis.
                </p>
        </div>

        <div class="text-center">
                <img src="./images/carro1.jpeg" alt="Imagem">
        </div>

        <div class="col-md-12 mt-2">
            <h2 class="d-flex justify-content-center">Como funciona</h2>
            <p>
            Um leilão de carros usados é um evento em que os veículos usados são colocados à venda para os participantes fazerem lances competitivos. Aqui está uma descrição geral de como funciona o nosso leilão de carros usados:

            <ul class="list-group list-group-light list-group-small">
                <li class="list-group-item"><strong>Inscrição e verificação:</strong> Os vendedores ou a casa de leilões coletam os veículos dos proprietários e realizam verificações para avaliar sua condição, histórico e documentação. Os carros são listados para o leilão, com detalhes como marca, modelo, ano, quilometragem e informações sobre a condição do veículo.</li>
                
                <li class="list-group-item"><strong>Pré-visualização:</strong> Antes do leilão, geralmente é oferecido um período de pré-visualização em que os potenciais compradores podem examinar fisicamente os carros disponíveis. Eles podem inspecionar o interior, exterior e o motor dos veículos para avaliar sua condição.</li>
                
                <li class="list-group-item"><strong>Registro:</strong> Os interessados em participar do leilão precisam se registrar, fornecendo informações pessoais e, em alguns casos, deixando um depósito ou fornecendo um cartão de crédito válido. O registro pode ser feito presencialmente ou online, dependendo do tipo de leilão.</li>
                
                <li class="list-group-item"><strong>Início do leilão:</strong> O leilão começa com o leiloeiro apresentando um veículo em destaque. O leiloeiro descreve o carro, fornecendo informações relevantes sobre sua condição, histórico e quaisquer detalhes especiais. O lance inicial é definido e os participantes têm a oportunidade de fazer lances mais altos.</li>
                
                <li class="list-group-item"><strong>Lances:</strong> Os participantes do leilão fazem lances para os carros em que estão interessados. Os lances podem ser feitos por meio de uma variedade de métodos, dependendo do leilão - pode ser levantando a mão, sinalizando com um cartão numerado ou usando um sistema online. Os lances continuam a subir à medida que os participantes competem uns com os outros.</li>

                <li class="list-group-item"><strong>Venda e término do leilão:</strong> Quando não há mais lances, o leiloeiro bate o martelo e declara o carro vendido ao licitante que fez o lance mais alto. Esse licitante vence o leilão e é considerado o comprador do veículo. O leiloeiro registra as informações do comprador e finaliza a venda.</li>

                <li class="list-group-item"><strong>Pagamento e retirada:</strong> O comprador vencedor é responsável por fazer o pagamento pelo veículo, conforme as condições estabelecidas pelo leilão. O pagamento pode ser feito imediatamente após o término do leilão ou dentro de um prazo determinado. Após o pagamento, o comprador deve providenciar a retirada do veículo, seja levando-o pessoalmente ou contratando um serviço de transporte.</li>
            </ul>
            </p>
        </div>

        <div class="row justify-content-center mt-2">

            <div class="col-md-8 col-lg-6 mt-2">
                <h2>O Leiloeiro</h2>
                <h4>Alcides Carvalho</h4>
                <p>
                    Alcides Camargo decidiu seguir uma carreira relacionada ao setor automotivo e ingressou em uma faculdade de Administração de Empresas com foco em negócios do ramo automobilístico. Durante seus estudos, teve a oportunidade de realizar estágios em concessionárias de automóveis, onde aprendeu sobre vendas, gestão de estoque e negociações comerciais. Após concluir sua graduação, obteve sua certificação como leiloeiro adquirindo conhecimento sobre os procedimentos, estratégias de venda e negociações em leilões. Sua combinação única de conhecimento em administração e paixão por automóveis permitiu que ele se destacasse em um mercado competitivo. Alcides continuou a aprimorar suas habilidades e a oferecer serviços de leilões de qualidade, ajudando vendedores a encontrarem compradores para seus veículos e ajudando compradores a adquirirem carros usados de forma confiável e emocionante.
                </p>
            </div>

            <div class="col-md-9 col-lg-6 mb-3">
                <img src="./images/leiloeiro.jpg" alt="Imagem">
            </div>

        </div>

    </div>

    <?php
    include './../../components/footer/footer.php';
    ?>


</body>
</html>