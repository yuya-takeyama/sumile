<?php
class SlimWebTestCase_Tests_ExampleApp extends Slim
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

class SlimWebTestCase_Tests_SlimWebTestCaseTest extends SlimWebTestCase
{
    public function createApplication()
    {
        return new SlimWebTestCase_Tests_ExampleApp;
    }

    /**
     * @test
     */
    public function createApp_should_be_a_Slim_application()
    {
        $this->assertInstanceOf('Slim', $this->createApp());
    }

    /**
     * @test
     */
}
