<?php
/**
 * Silex like WebTestCase class for Sumile.
 *
 * @author Yuya Takeyama
 */
abstract class Sumile_WebTestCase extends PHPUnit_Framework_TestCase
{
    protected $app;

    abstract public function createApplication();

    public function createClient()
    {
        return new Sumile_Client(array($this, 'createApplication'));
    }

    public function requestWithMethod($method, $uri, array $params = array())
    {
        $args = func_get_args();
        $client = $this->createClient();
        return $client->request($method, $uri, $params);
    }

    public function get($uri, array $params = array())
    {
        return $this->requestWithMethod('GET', $uri, $params);
    }

    public function post($uri, array $params = array())
    {
        return $this->requestWithMethod('POST', $uri, $params);
    }
}
