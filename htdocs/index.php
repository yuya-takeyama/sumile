<?php
set_include_path(
    realpath(dirname(__FILE__) . '/../src') .
    PATH_SEPARATOR .
    realpath(dirname(__FILE__) . '/../vendor/codeguy/Slim') .
    PATH_SEPARATOR .
    get_include_path()
);
require_once 'Sumile/Application.php';

$app = new Sumile_Application;

$app->get('/', function () {
    echo "Welcome to Sumile";
});

$app->run();
