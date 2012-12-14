<?php

class Library_Database
{
	private static $_instance = '';

	public function __construct(){}

	public static function getInstance()
	{
		$class = __CLASS__;

		if(!(self::$_instance instanceof $class))
		{
			self::$_instance = new $class();
		}
	}
}