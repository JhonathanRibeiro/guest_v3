-- -----------------------------------------------------
-- Schema gestaov3
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gestaov3` DEFAULT CHARACTER SET utf8 ;

USE `gestaov3` ;

-- -----------------------------------------------------
-- Table `gestaov3`.`tb_nivel_de_acesso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestaov3`.`tb_nivel_de_acesso` (
  `acesso_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`acesso_id`),
  UNIQUE INDEX `idgrupo_UNIQUE` (`acesso_id` ASC) VISIBLE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `gestaov3`.`tb_empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestaov3`.`tb_empresa` (
  `empresa_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`empresa_id`),
  UNIQUE INDEX `idempresa_UNIQUE` (`empresa_id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestaov3`.`tb_usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestaov3`.`tb_usuarios` (
  `usuario_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `acesso_id` INT UNSIGNED NOT NULL,
  `empresa_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`usuario_id`),
  INDEX `fk_usuario_privilegio_de_acesso1_idx` (`acesso_id` ASC) VISIBLE,
  INDEX `fk_tb_usuarios_tb_empresa1_idx` (`empresa_id` ASC) VISIBLE,
  CONSTRAINT `fk_usuario_privilegio_de_acesso1`
    FOREIGN KEY (`acesso_id`)
    REFERENCES `gestaov3`.`tb_nivel_de_acesso` (`acesso_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_usuarios_tb_empresa1`
    FOREIGN KEY (`empresa_id`)
    REFERENCES `gestaov3`.`tb_empresa` (`empresa_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestaov3`.`tb_modulos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestaov3`.`tb_modulos` (
  `modulo_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NOT NULL,
  `pag_principal` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`modulo_id`),
  UNIQUE INDEX `idmodulo_UNIQUE` (`modulo_id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestaov3`.`tb_telas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestaov3`.`tb_telas` (
  `tela_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NOT NULL,
  `modulo_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`tela_id`),
  INDEX `fk_telas_modulo1_idx` (`modulo_id` ASC) VISIBLE,
  UNIQUE INDEX `idtelas_UNIQUE` (`tela_id` ASC) VISIBLE,
  CONSTRAINT `fk_telas_modulo1`
    FOREIGN KEY (`modulo_id`)
    REFERENCES `gestaov3`.`tb_modulos` (`modulo_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestaov3`.`tb_movimentacao_mod_usu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestaov3`.`tb_movimentacao_mod_usu` (
  `modulo_id` INT UNSIGNED NOT NULL,
  `usuario_id` INT UNSIGNED NOT NULL,
  `acesso_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`modulo_id`, `usuario_id`, `acesso_id`),
  INDEX `fk_tb_privilegios_de_acesso_has_tb_modulos_tb_modulos1_idx` (`modulo_id` ASC) VISIBLE,
  INDEX `fk_tb_privilegios_de_acesso_has_tb_modulos_tb_usuarios1_idx` (`usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_tb_privilegios_de_acesso_has_tb_modulos_tb_modulos1`
    FOREIGN KEY (`modulo_id`)
    REFERENCES `gestaov3`.`tb_modulos` (`modulo_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_privilegios_de_acesso_has_tb_modulos_tb_usuarios1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `gestaov3`.`tb_usuarios` (`usuario_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestaov3`.`tb_permissao_telas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestaov3`.`tb_permissao_telas` (
  `permissao_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tela_id` INT UNSIGNED NOT NULL,
  `consultar` INT NOT NULL,
  `incluir` INT NOT NULL,
  `editar` INT NOT NULL,
  `excluir` INT NOT NULL,
  PRIMARY KEY (`permissao_id`),
  UNIQUE INDEX `id_UNIQUE` (`permissao_id` ASC) VISIBLE,
  INDEX `fk_permissao_telas_tb_telas1_idx` (`tela_id` ASC) VISIBLE,
  CONSTRAINT `fk_permissao_telas_tb_telas1`
    FOREIGN KEY (`tela_id`)
    REFERENCES `gestaov3`.`tb_telas` (`tela_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;