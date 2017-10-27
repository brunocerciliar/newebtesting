<?php

	$debug = false;
	if($debug)
	{
		error_reporting(6143);
		ini_set('display_errors', 1);
		echo "<pre>";
	}

	require_once('../autoload.php');

	session_start();
	header('Content-type: text/html; charset=UTF-8', true);
	
	#Adicione as rotas do seu projeto
	$router->add("bruno/book/{book}", "BookController@invoke");
	$router->add("bruno/books", "BookController@invoke");

	#Execute a validação das rotas ( não mexer )
	$router->get($server_REQUEST_URI);