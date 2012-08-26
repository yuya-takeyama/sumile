<?php
/**
 * Silex like WebTestCase class for Slim.
 *
 * @author Yuya Takeyama
 */
abstract class Sumile_WebTestCase extends PHPUnit_Framework_TestCase
{
    protected $app;

    public function setUp()
    {
        $this->app = $this->createApp($this->getDefaultServerEnv());
    }

    abstract public function createApplication();

    public function getDefaultServerEnv()
    {
        return array(
            'REQUEST_METHOD' => 'GET',
            'REMOTE_ADDR'    => 'client.localhost',
            'REQUEST_URI'    => '/',
            'SERVER_NAME'    => 'localhost',
            'SERVER_PORT'    => 80,
            'SCRIPT_NAME'    => '/index.php',
        );
    }

    public function createApp(array $env = array())
    {
        Sumile_Client::setUpServerEnv($env);
        $app = $this->createApplication();
        Sumile_Client::restoreServerEnv($env);
        return $app;
    }

    public function createClient(array $env = array())
    {
        $client = new Sumile_Client($this->app, $env);
    }
}
