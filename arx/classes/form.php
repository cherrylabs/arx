<?php defined('SYSPATH') or die('No direct script access.');

require_once DIR_CLASSES . DS . 'kohana.php';
require_once DIR_CLASSES . DS . 'html.php';
require_once DIR_CLASSES . DS . 'kohana/form.php';

class Form extends Kohana_Form {}

/**
	 * Form Constructor extends forms
	 * @author Daniel Sum
	 * @version 0.1
	 * @package arx
	 * @description : 
	 * @comments :
*/

class c_form
{
	private $_form, $_isClosed = false;

	function __construct($action = NULL, $attributes = NULL)
	{
	
		return $this->_form = Form::open($action, $attributes);
		
	}
	
	function __call($name, $args)
	{
		
		$this->_form .= call_user_func_array('Form::'.$name, $args);
	}
	
	function __get($name)
	{
		
	}
	
	function __set($name, $value)
	{
		$this->{$name} = $value;
		$this->_form = $value;
		
	}
	
	static function open($action = null, $attributes = null)
	{
			return Form::open($action, $attributes);
	}
	
	static function close()
	{
		if(isset($this))
		{
			$this->_form .= Form::close();
		
			return $this->_form;
		}
		else
		{
			return Form::close();
		}
	}
	
	function output($type = null)
	{
	
		$this->_form .= self::close();
		
		switch(true)
		{
			case ($type == 'html'):
				return nl2br(htmlspecialchars($this->_form));
			break;
			default:
				return $this->_form;
			break;
		}
		
	}
	
	function outputHTML()
	{
		return self::output('html');
	}
	
	
}