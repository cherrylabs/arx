<?php
require_once(dirname(dirname(__FILE__)).DS.'core.php');
require_once(dirname(__FILE__).DS.'braintree'.DS.'lib'.DS.'Braintree.php');

arx::require_config(array('BRAINTREE' => array('environment', 'merchantId', 'publicKey', 'privateKey')));

Braintree_Configuration::environment($GLOBALS['BRAINTREE']['environment']);
Braintree_Configuration::merchantId($GLOBALS['BRAINTREE']['merchantId']);
Braintree_Configuration::publicKey($GLOBALS['BRAINTREE']['publicKey']);
Braintree_Configuration::privateKey($GLOBALS['BRAINTREE']['privateKey']);

class a_braintree{

}