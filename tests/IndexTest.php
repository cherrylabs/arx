<?php

require_once '../vendor/autoload.php';

class IndexTest extends PHPUnit_Framework_TestCase{

    public function setUp()
    {
        $_SERVER['SERVER_NAME'] = 'localhost';
        $_SERVER['SERVER_PORT'] = '80';
        $_SERVER['SCRIPT_NAME'] = '/index.php';
        $_SERVER['REQUEST_URI'] = '/index.php/param1';
        $_SERVER['PATH_INFO'] = '/bar/xyz';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['QUERY_STRING'] = 'one=1&two=2&three=3';
        $_SERVER['HTTPS'] = '';
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        unset($_SERVER['CONTENT_TYPE'], $_SERVER['CONTENT_LENGTH']);
    }

    /**
     * Test gets all params
     */
    public function testGetRouteParams()
    {
        // Prepare route
        $requestUri = '/hello/mr/anderson';
        $route = new \Slim\Route('/hello/:first/:last', function () {});

        // Parse route params
        $this->assertTrue($route->matches($requestUri));

        // Get params
        $params = $route->getParams();

        predie($params);
        $this->assertEquals(2, count($params));
        $this->assertEquals('mr', $params['first']);
        $this->assertEquals('anderson', $params['last']);
    }
}