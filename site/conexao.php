<?php

	$host = "localhost";
	$usuario = "root";
	$senha = "";
	$bd = "mercadoPw";
	
	//Realizar a conexão com banco de dados
	$con = mysqli_connect($host, $usuario, $senha, $bd) or die("Erro na conexão com BD");

	//Executar query no banco para ajuste de codificação
	$con->query('SET NAMES utf8') or die($con->error);

//	$con->begin_transaction(MYSQLI_TRANS_START_READ_ONLY);
?>

