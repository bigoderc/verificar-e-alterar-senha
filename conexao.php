<?php

	global $conexao; // Variavél global criada para ser usada em qualquer parte do sistema
	
	$host = 'localhost';
	$banco = 'web';
	$usuario = 'root';
	$senha = '';

	// Se for possível a conexão
	try {

		// PDO é extensão do PHP para conectar com o banco
		$conexao = new PDO("mysql:host=$host;dbname=$banco;charset=utf8",$usuario,$senha);

	// Se a conexão não for possível
	} catch (PDOException $falha_conexao) {
		echo "Erro na conexão do banco".$falha_conexao->getMessage();
	} catch (Exception $falha) {
		echo "Erro não proveniente a conexão do banco".$falha->getMessage();
	}
?>