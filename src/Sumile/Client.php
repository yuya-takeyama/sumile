<?php
require_once 'Sumile/EnvironmentCleaner.php';

/**
 * Client for Sumile application
 *
 * @author Yuya Takeyama
 */
class Sumile_Client
{
    protected $factory;

    private $tmpServerEnv;

    public function __construct($factory)
    {
        $this->factory = $factory;
    }

    public function setUpEnv(array $env)
    {
        $this->tmpServerEnv = $_SERVER;
        $_SERVER = $env;
    }

    public function restoreEnv()
    {
        $_SERVER = $this->tmpServerEnv;
    }

    public function request($method, $uri, $params = array())
    {
        Sumile_EnvironmentCleaner::clean();

        $env = isset($params['env']) ? $params['env'] : $this->getDefaultEnv();

        $env['REQUEST_METHOD'] = strtoupper($method);
        $env['PATH_INFO']      = ($uri === '/') ? '' : $uri;
        $env['REQUEST_URI']    = '/index.php' . $env['PATH_INFO'];

        if (isset($params['files'])) {
            $tmpFiles = $_FILES;
            $_FILES   = array();

            foreach ($params['files'] as $key => $path) {
                $_FILES[$key] = array(
                    'name'     => basename($path),
                    'tmp_name' => $path,
                    'size'     => filesize($path),
                );
            }
        }

        $this->setUpEnv($env);

        $app = call_user_func($this->factory);

        if (isset($params['post'])) {
            $app->environment()->offsetSet('slim.request.form_hash', $params['post']);
        }

        $app->performApplication();

        $this->restoreEnv();

        if (isset($params['files'])) {
            $_FILES = $tmpFiles;
        }

        return $app->response();
    }

    public function getDefaultEnv()
    {
        return array(
            'REMOTE_ADDR' => '127.0.0.1',
            'SERVER_NAME' => 'localhost',
            'SERVER_PORT' => '80',
            'SCRIPT_NAME' => '/index.php',
        );
    }
}
