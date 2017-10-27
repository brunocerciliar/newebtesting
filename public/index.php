<?php

	$debug = true;
	if($debug)
	{
		error_reporting(6143);
		ini_set('display_errors', 1);
		echo "<pre>";
	}

	require_once('../autoload.php');

	session_start();
	header('Content-type: text/html; charset=UTF-8', true);

	extract($_GET, EXTR_PREFIX_ALL, 'get');
	extract($_POST, EXTR_PREFIX_ALL, 'post');
	extract($_SERVER, EXTR_PREFIX_ALL, 'server');

	$router = new \Core\Misc\Route;
	
	#Adicione as rotas do seu projeto
	$router->add("personagem/{nome}/visualizar", "BookController@Adicionar");
	$router->add("personagem/{nome}/mapa/{mapa}", "BookController@Adicionar");
	$router->add("bruno/adicionar/{id}", "BookController@invoke");

	#Execute a validação das rotas ( não mexer )
	$router->get($server_REQUEST_URI);