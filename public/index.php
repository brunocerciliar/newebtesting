<?php

	// diretório base da aplicação
	define('BASE_PATH', dirname(__FILE__));
	 
	// credenciais de acesso ao MySQL
	define('MYSQL_HOST', 'localhost');
	define('MYSQL_USER', 'root');
	define('MYSQL_PASS', '123');
	define('MYSQL_DBNAME', 'pw');
	 
	// configurações do PHP
	define('DEBUG', FALSE);
	date_default_timezone_set('America/Sao_Paulo');

	if(DEBUG) {
		error_reporting(6143);
		ini_set('display_errors', 1);
		echo "<pre>";
	}

	require_once('../autoload.php');

	session_start();
	header('Content-type: text/html; charset=UTF-8', true);
	
	#Adicione as rotas do seu projeto
	$router->add("/", "RankController@index");

	#Execute a validação das rotas ( não mexer )
	$router->get($server_REQUEST_URI);