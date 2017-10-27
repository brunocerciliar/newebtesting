<?php 
namespace App\Controller\Interfaces;

interface IController 
{
	function view($view, $params);
}