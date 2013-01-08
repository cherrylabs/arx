<?php
require_once realpath(dirname(__FILE__)) . '/../TestHelper.php';

class Braintree_HttpTest extends PHPUnit_Framework_TestCase
{
    public function testProductionSSL()
    {
        try {
            Braintree_Configuration::environment('production');
            $this->setExpectedException('Braintree_Exception_Authentication');
            Braintree_Http::get('/');
        } catch (Exception $e) {
            Braintree_Configuration::environment('development');
            throw $e;
        }
        Braintree_Configuration::environment('development');
    }

    public function testSandboxSSL()
    {
        try {
            Braintree_Configuration::environment('sandbox');
            $this->setExpectedException('Braintree_Exception_Authentication');
            Braintree_Http::get('/');
        } catch (Exception $e) {
            Braintree_Configuration::environment('development');
            throw $e;
        }
        Braintree_Configuration::environment('development');
    }
}
