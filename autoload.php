<?php 

define('DS',DIRECTORY_SEPARATOR);
define('ROOT',dirname(__FILE__));
define('VIEW', ROOT.DS.'App'.DS.'view');

spl_autoload_register(function($class) {

    $app     = ROOT.DS;
    $path    = str_replace('\\',DS,$class).'.php';

    if(is_file($inc = str_replace(DS.DS,DS,$app.DS.$path)))
        require_once($inc);
});