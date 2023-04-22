# picareta-leiloes

CREATE DATABASE PICARETALEILOES;

USE PICARETALEILOES;

CREATE TABLE Veiculo ( 
    veiculoId int AUTO_INCREMENT, 
    chassi varchar(1), 
    placa varchar(6), 
    modeloId int, 
    hodometro int, 
    observacao varchar(256), 
    direcao smallint, 
    cambioAutomatico boolean, 
    vidroEletrico boolean, 
    tipoCombustivel smallint, 
    kitGnv boolean, 
    arCondicionado boolean, 
    kitMultimidia boolean, 
    valorDespesas decimal, 
    ipvaQuitado boolean, 
    documentoParaRodar boolean, 
    anoFabricacao smallint, 
    sinistro boolean, 
    PRIMARY KEY (veiculoId, modeloId, placa, chassi) 
);

CREATE TABLE Marca ( 
    marcaId smallint AUTO_INCREMENT, 
    descricao varchar(50), 
    PRIMARY KEY (marcaId, descricao), 
    UNIQUE (marcaId, descricao) 
);

CREATE TABLE Modelo ( 
    modeloId int AUTO_INCREMENT, 
    marcaId smallint, 
    anoModelo smallint, 
    descricao varchar(100), 
    PRIMARY KEY (modeloId, marcaId, anoModelo), 
    UNIQUE (anoModelo, modeloId) 
);

CREATE TABLE Cor ( 
    corId smallint PRIMARY KEY AUTO_INCREMENT, 
    Descricao varchar(50) 
);

CREATE TABLE ModeloCor ( 
    corId smallint AUTO_INCREMENT, 
    modeloId int, 
    PRIMARY KEY (corId, modeloId) 
);

CREATE TABLE Lote ( 
    loteId smallint AUTO_INCREMENT, 
    veiculoId int, 
    leilaoId int, 
    valorInicial decimal, 
    valorIncremento decimal, 
    financeiraId int, 
    PRIMARY KEY (loteId, leilaoId, veiculoId, financeiraId) 
);

CREATE TABLE Lance ( 
    lanceId smallint AUTO_INCREMENT, 
    sequencia int, 
    dataLance dateTime, 
    valorLance decimal, 
    loteId smallint, 
    loginId int, 
    PRIMARY KEY (lanceId, sequencia, loteId), 
    UNIQUE (sequencia, lanceId) 
);

CREATE TABLE Leilao ( 
    leilaoId int PRIMARY KEY AUTO_INCREMENT, 
    dataLeilao dateTime 
);

CREATE TABLE Financeira ( 
    financeiraId int PRIMARY KEY AUTO_INCREMENT, 
    descricaoFinanceira varchar(100) 
);

CREATE TABLE Login ( 
    loginId int PRIMARY KEY AUTO_INCREMENT, 
    email varchar(120), 
    senha varchar(50), 
    tipoLogin smallint 
);

CREATE TABLE Pessoa ( 
    loginId int PRIMARY KEY, 
    nome varchar(256), 
    cpf varchar(11), 
    rg varchar(9), 
    dataNascimento date, 
    telefone varchar(11), 
    estadoCivil smallint, 
    sexo smallint, 
    foto blob 
);

CREATE TABLE Endereco ( 
    cep varchar(8), 
    logradouro varchar(256), 
    numeroResidencia smallint, 
    complemento varchar(30), 
    cidade varchar(50), 
    uf varchar(2), 
    loginId int PRIMARY KEY 
);

CREATE TABLE ImagensLote ( 
    loteId smallint, 
    tipoImagem smallint UNIQUE, 
    imagem blob, 
    PRIMARY KEY (loteId, tipoImagem) 
);

ALTER TABLE Veiculo 
ADD CONSTRAINT FK_ModeloVeiculo 
FOREIGN KEY (modeloId) REFERENCES Modelo(modeloId);

ALTER TABLE Modelo 
ADD CONSTRAINT FK_Modelo_Marca 
FOREIGN KEY (marcaId) REFERENCES Marca(marcaId);

ALTER TABLE ModeloCor 
ADD CONSTRAINT FK_Modelo_ModeloCor 
FOREIGN KEY (modeloId) REFERENCES Modelo(modeloId);

ALTER TABLE ModeloCor 
ADD CONSTRAINT FK_ModeloCor_Cor 
FOREIGN KEY (corId) REFERENCES Cor(corId);

ALTER TABLE Lote 
ADD CONSTRAINT FK_Lote_Leilao 
FOREIGN KEY (leilaoId) REFERENCES Leilao(leilaoId);

ALTER TABLE Lote 
ADD CONSTRAINT FK_Lote_Veiculo 
FOREIGN KEY (veiculoId) REFERENCES Veiculo(veiculoId);

ALTER TABLE Lote 
ADD CONSTRAINT FK_Lote_Financeira 
FOREIGN KEY (financeiraId) REFERENCES Financeira(financeiraId);

ALTER TABLE Pessoa 
ADD CONSTRAINT FK_Login_Pessoa 
FOREIGN KEY (loginId) REFERENCES Login (loginId);

ALTER TABLE Endereco 
ADD CONSTRAINT FK_Endereco_Pessoa 
FOREIGN KEY (loginId) REFERENCES Pessoa(loginId);
