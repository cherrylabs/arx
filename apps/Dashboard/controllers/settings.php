<?php
/**
    * User panels system
    * @file
    *
    * @package
    * @author Daniel Sum
    * @link 	@endlink
    * @see
    * @description
    *
    * @code 	@endcode
    * @comments
    * @todo
*/

require_once dirname(__FILE__).'/../core.php';

$c = new ctrl_table_crud('t_nodes');

$c->display();
