<?php
namespace App\Controller;

abstract class Controller implements Interfaces\IController {

	public function view($view, $params)
    {
    	$viewArr = explode('.', $view);
    	$viewArrKeys = array_keys($viewArr);
    	$viewLastArrKey = array_pop($viewArrKeys);

    	$dir = "";

    	foreach($viewArr as $k => $v)
    	{
    		if($k == $viewLastArrKey) {
    			$viewDir = VIEW . DS . $dir . $v . '.php';
    			if(file_exists($viewDir)) {
    				extract($params);
    				require $viewDir;
    			}
    		}

    		$dir .= $v . DS;		
    	}
    }
}

?>