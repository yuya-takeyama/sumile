<?php
class Sumile_Tests_ExampleApp extends Sumile_Application
{
    public function __construct()
    {
        parent::__construct();

        $this->initialize();
    }

    public function initialize()
    {
        $this->get('/', array($this, 'index'));
    }

    public function index()
    {
        return "Index";
    }
}

class Sumile_Tests_WebTestCaseTest extends Sumile_WebTestCase
{
    public function createApplication()
    {
        return new Sumile_Tests_ExampleApp;
    }

    /**
     * @test
     */
    public function createApp_should_be_a_Sumile_Application()
    {
        $this->assertInstanceOf('Sumile_Application', $this->createApp());
    }

    /**
     * @test
     */
}
