<?php

// echo __DIR__;

define('ROOT' , __DIR__ .'/../');

require(ROOT.'libs/function.php');

/*加载类*/ 

function load($class)
{
    $path = str_replace('\\','/',$class);
    require(ROOT . $path . '.php');
}

spl_autoload_register('load');

/*解析路由*/

// echo "<pre>";
// echo ;
// var_dump( $_SERVER );

$controller = '\controllers\IndexController';
$action = 'index';

if(isset( $_SERVER['PATH_INFO'] ))
{
    $router = explode('/', $_SERVER['PATH_INFO']);
    $controller = '\controllers\\'.ucfirst($router[1]).'Controller';
    $action = $router[2];
}

$c = new $controller;
$c->$action();

