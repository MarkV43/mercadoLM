DROP DATABASE IF EXISTS mercadopw;
CREATE DATABASE mercadopw;
USE mercadopw;
CREATE TABLE IF NOT EXISTS cidades (
	id   INT(11)     NOT NULL AUTO_INCREMENT,
	nome VARCHAR(45) NOT NULL,
	uf   CHAR(2)     NOT NULL,
	PRIMARY KEY (id)
);
CREATE TABLE IF NOT EXISTS clientes (
	id              INT(11)      NOT NULL AUTO_INCREMENT,
	nome            VARCHAR(45)  NOT NULL,
	email           VARCHAR(100) NOT NULL,
	telefone        VARCHAR(25),
	data_nascimento DATE,
	cep             CHAR(10),
	cidades_id      INT(11),
	PRIMARY KEY (id),
	FOREIGN KEY (cidades_id)
	REFERENCES cidades (id)
		ON DELETE SET NULL
		ON UPDATE SET NULL
);
CREATE TABLE IF NOT EXISTS cargos (
	id   INT(11)     NOT NULL AUTO_INCREMENT,
	nome VARCHAR(45) NOT NULL,
	PRIMARY KEY (id)
);
CREATE TABLE IF NOT EXISTS funcionarios (
	id              INT(11)      NOT NULL AUTO_INCREMENT,
	nome            VARCHAR(45)  NOT NULL,
	senha           CHAR(128)    NOT NULL,
	adm             BOOLEAN      NOT NULL,
	email           VARCHAR(255) NOT NULL,
	salario         FLOAT,
	data_admissao   DATE,
	data_nascimento DATE,
	cep             CHAR(10),
	cargos_id       INT(11),
	cidades_id      INT(11),
	foto            VARCHAR(255),
	PRIMARY KEY (id),
	FOREIGN KEY (cargos_id)
	REFERENCES cargos (id)
		ON DELETE SET NULL
		ON UPDATE SET NULL,
	FOREIGN KEY (cidades_id)
	REFERENCES cidades (id)
		ON DELETE SET NULL
		ON UPDATE SET NULL
);

CREATE TABLE IF NOT EXISTS formas_pagamento (
	id   INT(11) NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255),
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS vendas (
	id                 INT(11) NOT NULL AUTO_INCREMENT,
	data_venda         DATE    NOT NULL,
	hora_venda         TIME    NOT NULL,
	total              FLOAT,
	clientes_id        INT,
	funcionarios_id    INT,
	forma_pagamento_id INT,
	PRIMARY KEY (id),
	FOREIGN KEY (clientes_id)
	REFERENCES clientes (id)
		ON DELETE SET NULL
		ON UPDATE SET NULL,
	FOREIGN KEY (funcionarios_id)
	REFERENCES funcionarios (id)
		ON DELETE SET NULL
		ON UPDATE SET NULL,
	FOREIGN KEY (forma_pagamento_id)
	REFERENCES formas_pagamento (id)
		ON DELETE SET NULL
		ON UPDATE SET NULL
);
CREATE TABLE IF NOT EXISTS categorias (
	id   INT(11)     NOT NULL AUTO_INCREMENT,
	nome VARCHAR(45) NOT NULL,
	PRIMARY KEY (id)
);
CREATE TABLE IF NOT EXISTS produtos (
	id            INT(11)     NOT NULL AUTO_INCREMENT,
	nome          VARCHAR(45) NOT NULL,
	valor         FLOAT       NOT NULL,
	quantidade    INT(11)     NOT NULL,
	categorias_id INT(11),
	foto          VARCHAR(255),
	PRIMARY KEY (id),
	FOREIGN KEY (categorias_id)
	REFERENCES categorias (id)
		ON DELETE SET NULL
		ON UPDATE SET NULL
);
CREATE TABLE IF NOT EXISTS itens_venda (
	id          INT(11) NOT NULL AUTO_INCREMENT,
	vendas_id   INT(11),
	produtos_id INT(11),
	valor       FLOAT   NOT NULL,
	quantidade  INT(6),
	PRIMARY KEY (id),
	FOREIGN KEY (vendas_id)
	REFERENCES vendas (id)
		ON DELETE SET NULL
		ON UPDATE SET NULL,
	FOREIGN KEY (produtos_id)
	REFERENCES produtos (id)
		ON DELETE SET NULL
		ON UPDATE SET NULL
);

INSERT INTO formas_pagamento (nome) VALUES
	('Dinheiro'),
	('Cheque'),
	('Crédito'),
	('Débito'),
	('Boleto');

INSERT INTO categorias (nome) VALUES
	('Doces'),
	('Bolachas'),
	('Bebidas');

INSERT INTO cidades (nome, uf) VALUES
	('Florianopolis', 'SC'),
	('Canoinhas', 'SC'),
	('Tubarao', 'SC');

INSERT INTO cargos (nome) VALUES
	('Caixa'),
	('Faxineiro'),
	('Traficante de paçoca');

INSERT INTO funcionarios (nome, salario, data_admissao, cep,
                          cargos_id, cidades_id, email, senha, adm) VALUES
	('Renato Paranagua', 1300, '2012-05-14', '76325411', 2, 2, 'renato_paranagua@edu.sc.senai.br',
	 '9c5407e659272602d26755e7b77a2dd015e9fb75c8ac3a8afb57d898e8abad3e8b394a67ee0bf95e9997de7e2439ad0078e6adc0f1060177eda28cc1be0203eb',
	 0), #123
	('Joao Clayton', 1299, '2012-05-13', '76325410', 1, 1, 'joao_clayton@edu.sc.senai.br',
	 '92a2b97d140e14acec107809284b7f4e01879675c0aaef364a939383705b8295521c03512607a2cf1535c24e5f1c1b9ee7d030004046cac45026682fac89f9b2',
	 0), #abc
	('Lhaion Alexandre', 1301, '2012-05-15', '76325413', 3, 3, 'lhaion_alexandre@estudante.sc.senai.br',
	 'a83a81e42a030a1e457ee7089e15bb25cbfddfa1703eea19abca92acc0459bbc1fa86c09459ba117bf74b81d04f5b0a9a149919b9f4fe3b888627a3c5e701dde',
	 1); #ABC

INSERT INTO clientes (nome, email, telefone, data_nascimento,
                      cep, cidades_id) VALUES
	('Marcelo Vogt', 'marcelo_vogt@estudante.sc.senai.br', '8444-8544', '2001-07-14', '88.034-500', 1),
	('Gian', 'gian@gmail.net', '1234-5678', '1221-12-21', '68.454-988', 2),
	('Felipe Loche', 'loche@email.xxx', '3331-0101', '1313-12-31', '98.721-651', 3),
	('Lhaion Alexandre de Moraes Almeida', 'lhaion_almeida@estudante.sc.senai.br', '8817-4235', '1995-01-08',
	 '88.000-000', 1);

INSERT INTO vendas (data_venda, hora_venda, total, clientes_id,
                    funcionarios_id, forma_pagamento_id) VALUES
	('2016-06-10', '17:05', 0, 1, 1, 1),
	('2016-06-10', '17:06', 0, 2, 2, 3),
	('2016-06-10', '17:07', 0, 3, 3, 5);

INSERT INTO produtos (nome, valor, categorias_id, quantidade) VALUES
	('Brigadeiro', 1, 1, 10),
	('Trakinas', 2, 2, 29),
	('Coca-Cola', 3, 3, 15);

INSERT INTO itens_venda (vendas_id, produtos_id, valor, quantidade) VALUES
	(1, 1, 0, 3),
	(2, 2, 0, 2),
	(3, 3, 0, 1);

UPDATE itens_venda, produtos
SET itens_venda.valor = produtos.valor
WHERE produtos_id = produtos.id;

UPDATE vendas v
SET total = (
	SELECT sum(valor)
	FROM itens_venda
	WHERE vendas_id = v.id
);