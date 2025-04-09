-- MySQL Script generated by MySQL Workbench
-- qua 09 abr 2025 10:33:19
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema hamburgueria
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema hamburgueria
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `hamburgueria` ;
USE `hamburgueria` ;

-- -----------------------------------------------------
-- Table `hamburgueria`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hamburgueria`.`cliente` (
  `idcliente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(60) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `endereco` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idcliente`),
  UNIQUE INDEX `idcliente_UNIQUE` (`idcliente` ASC) VISIBLE,
  UNIQUE INDEX `telefone_UNIQUE` (`telefone` ASC) VISIBLE,
  UNIQUE INDEX `endereco_UNIQUE` (`endereco` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hamburgueria`.`funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hamburgueria`.`funcionario` (
  `idfuncionario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(60) NOT NULL,
  `cpf` VARCHAR(14) NOT NULL,
  `nascimento` VARCHAR(11) NOT NULL,
  `cargo` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idfuncionario`),
  UNIQUE INDEX `idfuncionario_UNIQUE` (`idfuncionario` ASC) VISIBLE,
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hamburgueria`.`venda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hamburgueria`.`venda` (
  `idvenda` INT NOT NULL AUTO_INCREMENT,
  `valor_final` DECIMAL NOT NULL,
  `observacao` VARCHAR(200) NULL,
  `data` VARCHAR(20) NOT NULL,
  `cliente_idcliente` INT NOT NULL,
  `funcionario_idfuncionario` INT NOT NULL,
  PRIMARY KEY (`idvenda`),
  UNIQUE INDEX `idvenda_UNIQUE` (`idvenda` ASC) VISIBLE,
  INDEX `fk_venda_cliente_idx` (`cliente_idcliente` ASC) VISIBLE,
  INDEX `fk_venda_funcionario1_idx` (`funcionario_idfuncionario` ASC) VISIBLE,
  CONSTRAINT `fk_venda_cliente`
    FOREIGN KEY (`cliente_idcliente`)
    REFERENCES `hamburgueria`.`cliente` (`idcliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venda_funcionario1`
    FOREIGN KEY (`funcionario_idfuncionario`)
    REFERENCES `hamburgueria`.`funcionario` (`idfuncionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hamburgueria`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hamburgueria`.`produto` (
  `idproduto` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `ingredientes` VARCHAR(45) NOT NULL,
  `preco` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idproduto`),
  UNIQUE INDEX `idproduto_UNIQUE` (`idproduto` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hamburgueria`.`armazenamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hamburgueria`.`armazenamento` (
  `idingredientes` INT NOT NULL AUTO_INCREMENT,
  `tipo_movimentacao` VARCHAR(10) NOT NULL,
  `quantidade` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `funcionario_idfuncionario` INT NOT NULL,
  PRIMARY KEY (`idingredientes`),
  UNIQUE INDEX `idingredientes_UNIQUE` (`idingredientes` ASC) VISIBLE,
  INDEX `fk_armazenamento_funcionario1_idx` (`funcionario_idfuncionario` ASC) VISIBLE,
  CONSTRAINT `fk_armazenamento_funcionario1`
    FOREIGN KEY (`funcionario_idfuncionario`)
    REFERENCES `hamburgueria`.`funcionario` (`idfuncionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hamburgueria`.`venda_produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hamburgueria`.`venda_produto` (
  `venda_idvenda` INT NOT NULL,
  `produto_idproduto` INT NOT NULL,
  `quantidade` INT NOT NULL,
  `valor` DECIMAL NOT NULL,
  PRIMARY KEY (`venda_idvenda`, `produto_idproduto`),
  INDEX `fk_venda_has_produto_produto1_idx` (`produto_idproduto` ASC) VISIBLE,
  INDEX `fk_venda_has_produto_venda1_idx` (`venda_idvenda` ASC) VISIBLE,
  CONSTRAINT `fk_venda_has_produto_venda1`
    FOREIGN KEY (`venda_idvenda`)
    REFERENCES `hamburgueria`.`venda` (`idvenda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venda_has_produto_produto1`
    FOREIGN KEY (`produto_idproduto`)
    REFERENCES `hamburgueria`.`produto` (`idproduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hamburgueria`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hamburgueria`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  UNIQUE INDEX `email_UNIQUE` (`idusuario` ASC) VISIBLE,
  UNIQUE INDEX `senha_UNIQUE` (`email` ASC) VISIBLE,
  PRIMARY KEY (`idusuario`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
