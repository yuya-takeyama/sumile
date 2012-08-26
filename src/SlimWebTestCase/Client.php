<?php
/**
 * Client for Slim application
 *
 * @author Yuya Takeyama
 */
class SlimWebTestCase_Client
{
    protected $app;

    private static $tmpServerEnv;

    public function __construct(Slim $app)
    {
        $this->app = $app;
    }

    public static function setUpServerEnv(array $env)
    {
        self::$tmpServerEnv = $_SERVER;
        $defaultEnv = array();
        $_SERVER = array_merge($defaultEnv, $env);
    }

    public static function restoreServerEnv()
    {
        $_SERVER = self::$tmpServerEnv;
    }
}
