<?php
require_once 'Slim/Slim.php';
require_once 'Acne.php';

class Sumile_Application extends Slim implements ArrayAccess
{
    /**
     * Master application
     *
     * @var Sumile_Application
     */
    private $master = null;

    /**
     * @var Acne_Container
     */
    private $container;

    public function __construct(array $params = array())
    {
        $settings     = isset($params['settings']) ? $params['settings'] : array();
        $this->master = isset($params['master'])   ? $params['master']   : null;

        if ($this->isMaster()) {
            $this->container = isset($params['container']) ? $params['container'] : new Acne_Container;

            $this->container->share('emitter', array($this, 'provideEventEmitter'));
        } else {
            $this->master->inherit($this);
        }

        parent::__construct($settings);

        $this->environment = Slim_Environment::getInstance(true);
    }

    public function offsetGet($key)
    {
        return $this->container[$key];
    }

    public function offsetExists($key)
    {
        return isset($this->container[$key]);
    }

    public function offsetSet($key, $value)
    {
        throw new BadMethodCallException('Operation not allowed');
    }

    public function offsetUnset($key)
    {
        throw new BadMethodCallException('Operation not allowed');
    }

    public function isMaster()
    {
        return is_null($this->master);
    }

    public function inherit(Sumile_Application $app)
    {
        $app->setContainer($this->container);
    }

    public function setContainer(Acne_Container $container)
    {
        $this->container = $container;
    }

    public function provideEventEmitter(Acne_Container $c)
    {
        require_once 'Edps/EventEmitter.php';

        return new Edps_EventEmitter;
    }

    public function performApplication()
    {
        set_error_handler(array('Slim', 'handleErrors'));

        //Apply final outer middleware layers
        $this->add(new Slim_Middleware_PrettyExceptions());

        //Invoke middleware and application stack
        $this->middleware[0]->call();

        //Fetch status, header, and body
        $result = $this->response->finalize();

        restore_error_handler();

        return $result;
    }

    public function run()
    {
        $this->performApplication();

        //Fetch status, header, and body
        list($status, $header, $body) = $this->response()->finalize();

        //Send headers
        if ( headers_sent() === false ) {
            //Send status
            if ( strpos(PHP_SAPI, 'cgi') === 0 ) {
                header(sprintf('Status: %s', Slim_Http_Response::getMessageForCode($status)));
            } else {
                header(sprintf('HTTP/%s %s', $this->config('http.version'), Slim_Http_Response::getMessageForCode($status)));
            }

            //Send headers
            foreach ( $header as $name => $value ) {
                $hValues = explode("\n", $value);
                foreach ( $hValues as $hVal ) {
                    header("$name: $hVal", false);
                }
            }
        }

        //Send body
        echo $body;
    }
}
