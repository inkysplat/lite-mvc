<?php

ini_set('display_errors','1');
error_reporting(-1);

define('DIR_SEP', DIRECTORY_SEPARATOR);
define('BASE_PATH', realpath(dirname(__FILE__)).DIR_SEP);


define('APP_PATH', realpath(BASE_PATH.DIR_SEP.'application').DIR_SEP);
define('LIBRARY_PATH', realpath(BASE_PATH.DIR_SEP.'library').DIR_SEP);
define('PUBLIC_PATH', realpath(BASE_PATH.DIR_SEP.'public').DIR_SEP);
define('VENDOR_PATH', realpath(BASE_PATH.DIR_SEP.'vendor').DIR_SEP);

define('CONFIG_PATH', realpath(APP_PATH.DIR_SEP.'config').DIR_SEP);
define('CONTROLLER_PATH',realpath(APP_PATH.DIR_SEP.'controllers').DIR_SEP);
define('LAYOUT_PATH',realpath(APP_PATH.DIR_SEP.'layouts').DIR_SEP);
define('MODEL_PATH',realpath(APP_PATH.DIR_SEP.'models').DIR_SEP);
define('VIEW_PATH',realpath(APP_PATH.DIR_SEP.'views').DIR_SEP);

define('DOCTRINE_PATH', realpath(VENDOR_PATH.DIR_SEP.'DoctrineDBAL-2.3.1').DIR_SEP);

require DOCTRINE_PATH.'Doctrine/Common/ClassLoader.php';


spl_autoload_register('__autoload');

function __autoload($class)
{

	$fullname = explode('_', $class);

	$namespace = strtoupper($fullname[0]);

	$filename = str_ireplace(array('Controller','Model','Library'),'',$class);
	$filename = preg_replace("/[^A-Za-z]/",'',$filename);
	$filename = ucwords(strtolower($filename));
	$filename .= '.php';

	switch($namespace)
	{
		case 'CONTROLLER':
			if(file_exists(CONTROLLER_PATH.$filename))
			{
				require_once(CONTROLLER_PATH.$filename);
			}
			break;
		case 'MODEL':
			if(file_exists(MODEL_PATH.$filename))
			{
				require_once(MODEL_PATH.$filename);
			}
			break;
		case 'LIBRARY':
			if(file_exists(LIBRARY_PATH.$filename))
			{
				require_once(LIBRARY_PATH.$filename);
			}			
			break;
		default:
			if(file_exists(DOCTRINE_PATH.'DBAL'.DIR_SEP.$filename))
			{
				require_once(DOCTRINE_PATH.'DBAL'.DIR_SEP.$filename);
			}
			throw new Exception(__FUNCTION__."::Cannot Find::".$filename);
			break;
	}
}