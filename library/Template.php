<?php

class Library_Template
{

	private $_template = '';

	private $_params = array();

	public function __construct()
	{
		if(!defined('VIEW_PATH') || !defined('LAYOUT_PATH'))
		{
			throw new Exception(__METHOD__."::Missing View Paths");
		}
	}


	public function __set($name, $value)
	{
		if($name == 'template')
		{
			$this->_template = $value;
		}else{
			$this->_params[$name] = $value;
 		}
	}


	public function render()
	{
		if(empty($this->_template))
		{
			throw new Exception(__METHOD__."::No Template Defined");
		}

		if(file_exists(VIEW_PATH.$this->_template.'.phtml'))
		{
			$template_path = VIEW_PATH.$this->_template.'.phtml';
		}

		if(file_exists(LAYOUT_PATH.$this->_template.'.phtml'))
		{
			$template_path = LAYOUT_PATH.$this->_template.'.phtml';
		}

		if(!isset($template_path) || empty($template_path))
		{
			throw new Exception(__METHOD__."::Missing Template");
		}

		return $this->_populate($template_path, $this->_params);
	}

	public function __get($name)
	{
		if(array_key_exists($name, $this->_params))
		{
			return $this->_params[$name];
		}
	}

	private function _populate($file, $params = array())
	{
		extract($params);
		ob_start();
		require_once($file);
		return trim(ob_get_clean());
	}


}