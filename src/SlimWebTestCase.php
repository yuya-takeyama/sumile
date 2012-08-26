<?php
require_once dirname(__FILE__) . '/SlimWebTestCase/Client.php';

/**
 * Silex like WebTestCase class for Slim.
 *
 * @author Yuya Takeyama
 */
abstract class SlimWebTestCase extends PHPUnit_Framework_TestCase
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
        SlimWebTestCase_Client::setUpServerEnv($env);
        $app = $this->createApplication();
        SlimWebTestCase_Client::restoreServerEnv($env);
        return $app;
    }

    public function createClient(array $env = array())
    {
        $client = new SlimWebTestCase_Client($this->app, $env);
    }
}
