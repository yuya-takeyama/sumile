<?php
/**
 * Client for Sumile application
 *
 * @author Yuya Takeyama
 */
class Sumile_Client
{
    protected $app;

    private static $tmpServerEnv;

    public function __construct(Sumile_Application $app)
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
