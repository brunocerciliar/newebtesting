<?php 

extract($_GET, EXTR_PREFIX_ALL, 'get');
extract($_POST, EXTR_PREFIX_ALL, 'post');
extract($_SERVER, EXTR_PREFIX_ALL, 'server');

define('BASE', $server_REQUEST_SCHEME. "://" . $server_SERVER_NAME . $server_SCRIPT_NAME);

#instancia a classe de rotas
$router = new \Core\Misc\Route;

#metodo route aonde define
if(!function_exists("route")) {

	function route($name, $param = "")
	{
		preg_match_all("/({[a-zA-Z0-9 ]+(\?|)})/", $name, $output, PREG_SET_ORDER);

		if(is_array($param)) {
			if(count($output) > count($param)) {
				throw new Exception("a rota {$name} está faltando parametros", 1);
			}
		}

		foreach($output as $k => $uriParam)
		{
			$name = str_replace($uriParam[0], is_array($param) ? $param[$k] : $param, $name);
		}

		return str_replace('index.php', '', BASE) . $name;
	}
}