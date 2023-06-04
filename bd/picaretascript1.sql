USE `PICARETALEILOES` ;

-- -----------------------------------------------------
-- Table `PICARETALEILOES`.`Marca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PICARETALEILOES`.`Marca` (
  `marcaId` INT NULL DEFAULT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`marcaId`, `descricao`),
  UNIQUE INDEX (`marcaId` ASC, `descricao` ASC));


-- -----------------------------------------------------
-- Table `PICARETALEILOES`.`Modelo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PICARETALEILOES`.`Modelo` (
  `modeloId` INT NULL DEFAULT NULL AUTO_INCREMENT,
  `marcaId` INT NULL DEFAULT NULL,
  `anoModelo` SMALLINT NULL DEFAULT NULL,
  `descricao` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`modeloId`, `marcaId`, `anoModelo`),
  UNIQUE INDEX (`anoModelo` ASC, `modeloId` ASC),
  INDEX `FK_Modelo_Marca` (`marcaId` ASC),
  CONSTRAINT `FK_Modelo_Marca`
    FOREIGN KEY (`marcaId`)
    REFERENCES `PICARETALEILOES`.`Marca` (`marcaId`));


-- -----------------------------------------------------
-- Table `PICARETALEILOES`.`Cor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PICARETALEILOES`.`Cor` (
  `corId` INT NULL AUTO_INCREMENT,
  `Descricao` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`corId`));


-- -----------------------------------------------------
-- Table `PICARETALEILOES`.`ModeloCor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PICARETALEILOES`.`ModeloCor` (
  `modeloCorId` INT NULL DEFAULT NULL AUTO_INCREMENT,
  `modeloId` INT NULL DEFAULT NULL,
  `corId` INT NULL DEFAULT NULL,
  PRIMARY KEY (`modeloCorId`, `modeloId`, `corId`),
  INDEX `FK_Modelo_ModeloCor` (`modeloId` ASC),
  INDEX `FK_ModeloCor_Cor` (`corId` ASC),
  CONSTRAINT `FK_Modelo_ModeloCor`
    FOREIGN KEY (`modeloId`)
    REFERENCES `PICARETALEILOES`.`Modelo` (`modeloId`),
  CONSTRAINT `FK_ModeloCor_Cor`
    FOREIGN KEY (`corId`)
    REFERENCES `PICARETALEILOES`.`Cor` (`corId`));


-- -----------------------------------------------------
-- Table `PICARETALEILOES`.`Veiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PICARETALEILOES`.`Veiculo` (
  `veiculoId` INT NULL DEFAULT NULL AUTO_INCREMENT,
  `chassi` VARCHAR(17) NULL DEFAULT NULL,
  `placa` VARCHAR(7) NULL DEFAULT NULL,
  `hodometro` INT NULL DEFAULT NULL,
  `observacao` VARCHAR(256) NULL DEFAULT NULL,
  `direcao` SMALLINT NULL DEFAULT NULL,
  `cambioAutomatico` TINYINT NULL DEFAULT NULL,
  `vidroEletrico` TINYINT NULL DEFAULT NULL,
  `tipoCombustivel` SMALLINT NULL DEFAULT NULL,
  `kitGnv` TINYINT NULL DEFAULT NULL,
  `arCondicionado` TINYINT NULL DEFAULT NULL,
  `kitMultimidia` TINYINT NULL DEFAULT NULL,
  `valorDespesas` DECIMAL(10,2) NULL DEFAULT NULL,
  `ipvaQuitado` TINYINT NULL DEFAULT NULL,
  `documentoParaRodar` TINYINT NULL DEFAULT NULL,
  `anoFabricacao` SMALLINT NULL DEFAULT NULL,
  `sinistro` TINYINT NULL DEFAULT NULL,
  `modeloCorId` INT NOT NULL,
  PRIMARY KEY (`veiculoId`, `placa`, `chassi`, `modeloCorId`),
  INDEX `fk_Veiculo_ModeloCor1_idx` (`modeloCorId` ASC),
  CONSTRAINT `fk_Veiculo_ModeloCor1`
    FOREIGN KEY (`modeloCorId`)
    REFERENCES `PICARETALEILOES`.`ModeloCor` (`modeloCorId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `PICARETALEILOES`.`Leilao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PICARETALEILOES`.`Leilao` (
  `leilaoId` INT NULL DEFAULT NULL AUTO_INCREMENT,
  `dataLeilao` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`leilaoId`));


-- -----------------------------------------------------
-- Table `PICARETALEILOES`.`Financeira`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PICARETALEILOES`.`Financeira` (
  `financeiraId` INT NULL DEFAULT NULL AUTO_INCREMENT,
  `descricaoFinanceira` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`financeiraId`));


-- -----------------------------------------------------
-- Table `PICARETALEILOES`.`Lote`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PICARETALEILOES`.`Lote` (
  `loteId` INT NULL AUTO_INCREMENT,
  `leilaoId` INT NULL DEFAULT NULL,
  `valorInicial` DECIMAL(10,2) NULL DEFAULT NULL,
  `valorIncremento` DECIMAL(10,2) NULL DEFAULT NULL,
  `financeiraId` INT NULL DEFAULT NULL,
  `veiculoId` INT NOT NULL,
  PRIMARY KEY (`loteId`, `leilaoId`, `financeiraId`, `veiculoId`),
  INDEX `FK_Lote_Leilao` (`leilaoId` ASC),
  INDEX `FK_Lote_Financeira` (`financeiraId` ASC),
  UNIQUE INDEX `loteId_UNIQUE` (`loteId` ASC),
  INDEX `fk_Lote_Veiculo1_idx` (`veiculoId` ASC),
  CONSTRAINT `FK_Lote_Leilao`
    FOREIGN KEY (`leilaoId`)
    REFERENCES `PICARETALEILOES`.`Leilao` (`leilaoId`),
  CONSTRAINT `FK_Lote_Financeira`
    FOREIGN KEY (`financeiraId`)
    REFERENCES `PICARETALEILOES`.`Financeira` (`financeiraId`),
  CONSTRAINT `fk_Lote_Veiculo1`
    FOREIGN KEY (`veiculoId`)
    REFERENCES `PICARETALEILOES`.`Veiculo` (`veiculoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `PICARETALEILOES`.`Login`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PICARETALEILOES`.`Login` (
  `loginId` INT NULL DEFAULT NULL AUTO_INCREMENT,
  `email` VARCHAR(120) NULL DEFAULT NULL,
  `senha` VARCHAR(50) NULL DEFAULT NULL,
  `tipoLogin` SMALLINT NULL DEFAULT NULL,
  PRIMARY KEY (`loginId`));


-- -----------------------------------------------------
-- Table `PICARETALEILOES`.`Pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PICARETALEILOES`.`Pessoa` (
  `nome` VARCHAR(256) NULL DEFAULT NULL,
  `cpf` VARCHAR(11) NULL DEFAULT NULL,
  `rg` VARCHAR(9) NULL DEFAULT NULL,
  `dataNascimento` DATE NULL DEFAULT NULL,
  `telefone` VARCHAR(11) NULL DEFAULT NULL,
  `estadoCivil` SMALLINT NULL DEFAULT NULL,
  `sexo` SMALLINT NULL DEFAULT NULL,
  `foto` BLOB NULL DEFAULT NULL,
  `loginId` INT NOT NULL,
  PRIMARY KEY (`loginId`),
  CONSTRAINT `fk_Pessoa_Login1`
    FOREIGN KEY (`loginId`)
    REFERENCES `PICARETALEILOES`.`Login` (`loginId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `PICARETALEILOES`.`Lance`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PICARETALEILOES`.`Lance` (
  `lanceId` INT NULL AUTO_INCREMENT,
  `sequencia` SMALLINT NULL DEFAULT NULL,
  `dataLance` DATETIME NULL DEFAULT NULL,
  `valorLance` DECIMAL(10,2) NULL DEFAULT NULL,
  `loteId` INT NOT NULL,
  `leilaoId` INT NOT NULL,
  `loginId` INT NOT NULL,
  PRIMARY KEY (`lanceId`, `sequencia`, `loteId`, `leilaoId`, `loginId`),
  UNIQUE INDEX (`sequencia` ASC, `lanceId` ASC),
  INDEX `fk_Lance_Lote1_idx` (`loteId` ASC, `leilaoId` ASC),
  INDEX `fk_Lance_Pessoa1_idx` (`loginId` ASC),
  CONSTRAINT `fk_Lance_Lote1`
    FOREIGN KEY (`loteId` , `leilaoId`)
    REFERENCES `PICARETALEILOES`.`Lote` (`loteId` , `leilaoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Lance_Pessoa1`
    FOREIGN KEY (`loginId`)
    REFERENCES `PICARETALEILOES`.`Pessoa` (`loginId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `PICARETALEILOES`.`Endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PICARETALEILOES`.`Endereco` (
  `cep` VARCHAR(8) NULL DEFAULT NULL,
  `logradouro` VARCHAR(256) NULL DEFAULT NULL,
  `numeroResidencia` SMALLINT NULL DEFAULT NULL,
  `complemento` VARCHAR(30) NULL DEFAULT NULL,
  `cidade` VARCHAR(50) NULL DEFAULT NULL,
  `uf` VARCHAR(2) NULL DEFAULT NULL,
  `loginId` INT NOT NULL,
  PRIMARY KEY (`loginId`),
  INDEX `fk_Endereco_Pessoa1_idx` (`loginId` ASC),
  CONSTRAINT `fk_Endereco_Pessoa1`
    FOREIGN KEY (`loginId`)
    REFERENCES `PICARETALEILOES`.`Pessoa` (`loginId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);



-- -----------------------------------------------------
-- Table `PICARETALEILOES`.`ImagemVeiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PICARETALEILOES`.`ImagemVeiculo` (
  `veiculoId` INT NOT NULL,
  `imagem` BLOB NULL,
  `tipoImagem` SMALLINT NULL,
  PRIMARY KEY (`veiculoId`),
  INDEX `fk_ImagemVeiculo_Veiculo1_idx` (`veiculoId` ASC),
  CONSTRAINT `fk_ImagemVeiculo_Veiculo1`
    FOREIGN KEY (`veiculoId`)
    REFERENCES `PICARETALEILOES`.`Veiculo` (`veiculoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
