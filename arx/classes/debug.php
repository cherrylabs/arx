<?php defined('SYSPATH') or die('No direct script access.');

class c_debug
{
    public $_output;

    public static function info($msg)
    {
        $GLOBALS['c_debug']['info'] = $msg;

    }

    public static function get_info()
    {
        return $GLOBALS['c_debug']['info'];

    }

    public static function notice($msg)
    {
        list($function, $line, $file, $class, $object, $type, $args) = debug_backtrace();

        $GLOBALS['c_debug']['notice'] = $msg;

        //trigger_error($msg . ' in file '.$file. ' @ line '.$line, E_USER_NOTICE);

    }

    public static function warning($msg)
    {
        predie(debug_backtrace());
        list($function, $line, $file, $class, $object, $type, $args) = debug_backtrace();

        $GLOBALS['c_debug']['warning'] = $msg;

        trigger_error($msg . ' in file '.$file. ' @ line '.$line, E_USER_WARNING);

    }

    public static function error($msg)
    {
        list($function, $line, $file, $class, $object, $type, $args) = debug_backtrace();

        $GLOBALS['c_debug']['error'] = $msg;

        trigger_error($msg . ' in file '.$file. ' @ line '.$line, E_USER_ERROR);

    }

}
