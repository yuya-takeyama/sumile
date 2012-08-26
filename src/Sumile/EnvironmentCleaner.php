<?php
class Sumile_EnvironmentCleaner extends Slim_Environment
{
    public static function clean()
    {
        self::$environment = null;
    }
}
