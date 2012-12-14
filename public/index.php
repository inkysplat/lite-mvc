<?php

require_once('../bootstrap.php');

$view = Library_View::getInstance();

$dispatch = array(
	'controller' => 'index',
	'action' => 'index'
);

if(isset($_GET['controller']))
{
	$dispatch['controller'] = $_GET['controller'];
}

if(isset($_GET['action']))
{
	$dispatch['action'] = $_GET['action'];
}

$controller = Library_Controller::getInstance();
$controller->controller($dispatch['controller']);
$controller->action($dispatch['action']);
$controller->dispatch();

$view->addView('footer');

ob_start();
die($view->render());
