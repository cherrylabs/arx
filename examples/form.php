<?php
/**
     *
     * @author Daniel Sum
     * @version 0.1
     * @package arx
     * @description :
     * @comments :
*/

require_once 'a-core.php';

inject_once('c_i18n');

$form = new c_form();

$date = new date();

$form->select('date', $date->seconds());

$form->input('email');

$form->password('password');

$form->button('save', 'Save Profile', array('type' => 'submit'));

echo $form->outputHTML();
