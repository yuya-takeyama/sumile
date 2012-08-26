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
        $this->get('/foo', array($this, 'getFoo'));
        $this->get('/', array($this, 'getIndex'));
        $this->post('/', array($this, 'postIndex'));
    }

    public function getIndex()
    {
        $this->response->write('Index page by GET');
    }

    public function postIndex()
    {
        $this->response->write('Index page by POST');
    }

    public function getFoo()
    {
        $this->response->write('Foo page');
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
    public function createClient_should_be_Sumile_Client()
    {
        $this->assertInstanceOf('Sumile_Client', $this->createClient());
    }

    /**
     * @test
     */
    public function request_should_return_response()
    {
        $response = $this->get('/');

        $this->assertInstanceOf('Slim_Http_Response', $response);

        return $response;
    }

    /**
     * @test
     * @depends request_should_return_response
     */
    public function response_has_its_body($response)
    {
        $this->assertEquals('Index page by GET', $response->body());
    }

    public function testPost()
    {
        $response = $this->post('/');

        $this->assertEquals('Index page by POST', $response->body());
    }

    /**
     * @test
     */
    public function request_foo_page()
    {
        $response = $this->get('/foo');

        $this->assertEquals('Foo page', $response->body());
    }
}
