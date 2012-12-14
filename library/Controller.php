<?php

class Library_Controller
{
	private static $_instance = null;

	private $_controllers = array();

	private $_this_controller = '';

	private $_this_action = '';

	public static function getInstance()
	{
		$_self = __CLASS__;

		if(!(self::$_instance instanceof $_self))
		{
			self::$_instance = new $_self();
		}

		return self::$_instance;
	}

	public function controller($controller)
	{
		if(empty($controller))
		{
			throw new Exception(__METHOD__.'::Empty Controller Passed');
		}

		if(!defined('CONTROLLER_PATH'))
		{
			throw new Exception(__METHOD__."::No Controller Path Defined");
		}

		$controller_name = 'Controller_'.ucwords(strtolower($controller));

		if(!array_key_Exists($controller_name, $this->_controllers))
		{
			$this->_controllers[$controller_name] = '_';
		}

		$this->_this_controller = $controller_name;
		
	}	

	public function action($action)
	{

		if(empty($action))
		{
			throw new Exception(__METHOD__.'::Empty Action Passed');
		}

		$action = $action.'Action';

		$this->_this_action = $action;
	}

	public function dispatch()
	{
		$controller = $this->_this_controller;
		$action = $this->_this_action;

		try
		{
			$this->_controllers[$controller] = new $controller();

		}catch(Exception $e)
		{
			throw new Exception(__METHOD__."::Problem Loading Controller::".$controller_name);
		}

		if(!method_exists($this->_controllers[$controller], $action))
		{
			throw new Exception(__METHOD__."::No Such Action Found");
		}
			
		$this->_controllers[$controller]->$action();
		
	}
}