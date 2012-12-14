<?php

class Controller_Index extends Library_Abstract implements Library_iController
{
	public function __construct()
	{
		parent::init();
	}

	public function indexAction()
	{
		$this->_view->addView('index');

	}


}