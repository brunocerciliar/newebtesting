<?php 

namespace Core\Misc;

use \Exception;
use \App\Controller;

class Route {

	public $action;
	public $routes;
	private $params = array();

	public function __construct()
	{
		$this->action = isset($_GET['page']) ? $_GET['page'] : '';
	}

	public function add($uri, $param)
	{
		if(!preg_match('/@/', $param)) throw new Exception("Controller incorreto nas rota [{$uri}]", 1);

		$uses = explode('@', $param, 2);

		$route = new \stdClass;
		$route->controller = '\\App\\Controller\\'.$uses[0];
		$route->method = $uses[1];
		$route->raw = $uri;

		$this->set($uri, $route);
	}

	private function set($uri, $route)
	{
		$uri = preg_replace('/({[a-zA-Z0-9 ]+\?})/', 'possible', $uri);
		$uri = preg_replace('/({[a-zA-Z0-9 ]+})/', 'any', $uri);

		$this->routes[$uri] = $route;
	}

	public function get($uri)
	{
		$uri = preg_replace("/.*public\//", "", urldecode($uri));

		foreach($this->routes as $routeUri => $route)
		{
			$pattern = $this->getPattern($routeUri);
			if(preg_match("/^{$pattern}$/", $uri)) {
				$params = $this->getParams($uri, $route, $pattern);
				$controller = new $route->controller;
				call_user_func_array(array($controller, $route->method), $this->params);
				exit(1);
			}
		}

		throw new Exception("Rota [{$uri}] não encontrada", 1);
	}

	private function getPattern($uri)
	{
		if(substr($uri, -1) == '/') $uri = substr($uri, 0, -1);
		$pattern = str_replace('/', '\/', $uri);
		$pattern = str_replace('any', '([a-zA-Z0-9 ]+)', $pattern);
		$pattern = str_replace('\/possible', '(\/[a-zA-Z0-9 ]+|)', $pattern);
		return $pattern;
	}

	private function getParams($uri, $route, $pattern)
	{
		preg_match("/^{$pattern}$/", $uri, $paramContent);
		preg_match_all("/({[a-zA-Z0-9 ]+(\?|)})/", $route->raw, $params, PREG_SET_ORDER);

		foreach($params as $k => $param)
		{
			$this->params[] = str_replace('/' , '', $paramContent[++$k]);
			// if(isset($param[0])) {
			// 	$paramName = str_replace('{', '', str_replace('}', '', $param[0]));
			// 	$this->params[$paramName] = str_replace('/', '', $paramContent[++$k]);
			// }
		}
		return $this->params;
	}
}