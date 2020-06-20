create database web;
use web;

CREATE TABLE funcionario (
  cd_funcionario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nome VARCHAR(30),
  cpf VARCHAR(14) UNIQUE,
  telefone VARCHAR(15) UNIQUE,
  email VARCHAR(50) UNIQUE,
  senha VARCHAR(32)
);

INSERT INTO funcionario (nome,cpf,telefone,email,senha)
VALUES
('Leonidas de Esparta', '143.610.007-12','(11) 12345-4321', 'leonidas@gmail.com', '123456');

SELECT * FROM funcionario;

