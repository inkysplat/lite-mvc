<?php

abstract class Library_Abstract
{
	protected $_view;

	protected $_model;

	public function __construct()
	{

	}

	public function init()
	{
		$class = get_class($this);

		$this->_view = Library_View::getInstance();
	}
}