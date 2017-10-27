<?php
namespace App\Controller;

abstract class Controller implements Interfaces\IController {

	public function view($view, $params = array())
    {
        $viewDir = $this->getView($view);
        if(file_exists($viewDir)) {

            extract($params);

            ob_start();
             require $viewDir;
             $baseFile = ob_get_contents();
            ob_end_clean();

            preg_match('/\[tpl{\$(.+?)}\]/i', $baseFile, $out);

            ob_start();
                require $this->getView($out[1]);
                $template = ob_get_contents();
            ob_end_clean();

            $baseFile = preg_replace('/\[tpl{\$(.+?)}\]/i', '', $baseFile);
            $template = str_replace('[content]', $baseFile, $template);
            echo $template;
            exit(1);
        }
    }

    protected function getView($view)
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
                    return $viewDir;
                }
            }
            $dir .= $v . DS;
        }
    }


}
