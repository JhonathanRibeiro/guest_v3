INSERT INTO tb_movimentacao_mod_usu VALUES (3,1,2,0),(1,1,1,0),(2,1,3,0),(1,2,1,0),(2,2,2,0),(3,2,5,1);
INSERT INTO tb_modulos VALUES (1,'Manutenção Preventiva','manutencao_preventiva','mp_dashboard'),(2,'Estoque','estoque','est_dashboard'),(3,'Ambiental','ambiental','amb_dashboard');
INSERT INTO tb_empresa VALUES (1,'Empresa1'),(11,'Empresa2'),(13,'Empresa3');
INSERT INTO tb_nivel_de_acesso VALUES (1,'Administrador'),(2,'Operador'),(3,'Usuário'),(5,'Teste');
INSERT INTO tb_permissao_telas VALUES (1,1,1,1,1,1),(2,2,1,1,1,0),(3,3,1,1,1,0),(4,4,1,1,1,0);
INSERT INTO tb_telas VALUES (1,'Dashboard','mp_dashboard',1),(2,'Cadastro de empresa','empresa/mp_read_empresas',1),(3,'Cadastro de níveis de acesso','nivel_acesso/mp_read_niveis_acesso',1),(4,'Cadastro de usuários','usuario/mp_read_usu',1),(5,'Cadastro de modulos','modulos/mp_read_modulos',1);
INSERT INTO tb_usuarios VALUES (1,'Jhonathan','admin@gmail.com','1234',1,1),(2,'Paulo','paulo@teste.com','1234',2,11);

DROP TABLE IF EXISTS tb_empresa;
CREATE TABLE tb_empresa (
  empresa_id int unsigned NOT NULL AUTO_INCREMENT,
  nome varchar(150) NOT NULL,
  PRIMARY KEY (empresa_id),
  UNIQUE KEY idempresa_UNIQUE (empresa_id)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS tb_modulos;
CREATE TABLE tb_modulos (
  modulo_id int unsigned NOT NULL AUTO_INCREMENT,
  nome varchar(250) NOT NULL,
  slug varchar(250) NOT NULL,
  pag_principal varchar(250) NOT NULL,
  PRIMARY KEY (modulo_id),
  UNIQUE KEY idmodulo_UNIQUE (modulo_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS tb_movimentacao_mod_usu;
CREATE TABLE tb_movimentacao_mod_usu (
  modulo_id int NOT NULL,
  usuario_id int NOT NULL,
  acesso_id int NOT NULL,
  bloqueio int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS tb_nivel_de_acesso;
CREATE TABLE tb_nivel_de_acesso (
  acesso_id int unsigned NOT NULL AUTO_INCREMENT,
  nome varchar(250) NOT NULL,
  PRIMARY KEY (acesso_id),
  UNIQUE KEY idgrupo_UNIQUE (acesso_id)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS tb_permissao_telas;
CREATE TABLE tb_permissao_telas (
  permissao_id int unsigned NOT NULL AUTO_INCREMENT,
  tela_id int unsigned NOT NULL,
  consultar int NOT NULL,
  incluir int NOT NULL,
  editar int NOT NULL,
  excluir int NOT NULL,
  PRIMARY KEY (permissao_id),
  UNIQUE KEY id_UNIQUE (permissao_id),
  KEY fk_permissao_telas_tb_telas1_idx (tela_id),
  CONSTRAINT fk_permissao_telas_tb_telas1 FOREIGN KEY (tela_id) REFERENCES tb_telas (tela_id)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS tb_telas;
CREATE TABLE tb_telas (
  tela_id int unsigned NOT NULL AUTO_INCREMENT,
  nome varchar(250) NOT NULL,
  slug varchar(250) NOT NULL,
  modulo_id int unsigned NOT NULL,
  PRIMARY KEY (tela_id),
  UNIQUE KEY idtelas_UNIQUE (tela_id),
  KEY fk_telas_modulo1_idx (modulo_id),
  CONSTRAINT fk_telas_modulo1 FOREIGN KEY (modulo_id) REFERENCES tb_modulos (modulo_id)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS tb_usuarios;
CREATE TABLE tb_usuarios (
  usuario_id int unsigned NOT NULL AUTO_INCREMENT,
  nome varchar(250) NOT NULL,
  email varchar(150) NOT NULL,
  senha varchar(32) NOT NULL,
  acesso_id int unsigned NOT NULL,
  empresa_id int unsigned NOT NULL,
  PRIMARY KEY (usuario_id),
  KEY fk_usuario_privilegio_de_acesso1_idx (acesso_id),
  KEY fk_tb_usuarios_tb_empresa1_idx (empresa_id),
  CONSTRAINT fk_tb_usuarios_tb_empresa1 FOREIGN KEY (empresa_id) REFERENCES tb_empresa (empresa_id),
  CONSTRAINT fk_usuario_privilegio_de_acesso1 FOREIGN KEY (acesso_id) REFERENCES tb_nivel_de_acesso (acesso_id)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
