<?php

class Library_View
{

	private static $_instance = null;

	private $_partials = array();

	private $_last_partial = '';

	public function __construct(){}

	private function __clone(){}

	public static function getInstance()
	{
		if(!defined('VIEW_PATH') || !defined('LAYOUT_PATH'))
		{
			throw new Exception(__METHOD__."::Missing View Paths");
		}

		$_self = __CLASS__;

		if(!(self::$_instance instanceof $_self))
		{
			self::$_instance = new $_self();

			self::$_instance->addView('header');

		}

		return self::$_instance;
	}

	public function addView($name)
	{
		try
		{
			$this->_partials[$name] = new Library_Template();
			$this->_partials[$name]->template = $name;

			$this->_last_partial = $name;

		}catch(Exception $e)
		{
			throw new Exception(__METHOD__."::Unable to Add View");
		}
	}

	public function set($name, $value)
	{
		$this->_partials[$this->_last_partial]->$name = $value;
	}

	public function render()
	{
		ob_start();
		foreach($this->_partials as $name=>$obj)
		{
			if($obj instanceof Library_Template)
			{
				echo $obj->render();
			}
		}

		return trim(ob_get_clean());
	}
}