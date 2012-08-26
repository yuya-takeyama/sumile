<?php
set_include_path(
    dirname(__FILE__) . '/../vendor/codeguy/Slim' .
    PATH_SEPARATOR .
    dirname(__FILE__) . '/../src' .
    PATH_SEPARATOR .
    get_include_path()
);
require_once 'Sumile/Application.php';
require_once 'Sumile/Client.php';
require_once 'Sumile/WebTestCase.php';
