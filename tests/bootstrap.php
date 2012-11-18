<?php
require_once dirname(__FILE__) . '/../vendor/SplClassLoader/SplClassLoader.php';

$loader = new SplClassLoader('Sumile', dirname(__FILE__) . '/../src');
$loader->setNamespaceSeparator('_');
$loader->register();

$loader = new SplClassLoader('Acne', dirname(__FILE__) . '/../vendor/yuya-takeyama/acne/src');
$loader->setNamespaceSeparator('_');
$loader->register();

$loader = new SplClassLoader('Edps', dirname(__FILE__) . '/../vendor/yuya-takeyama/edps/src');
$loader->setNamespaceSeparator('_');
$loader->register();

set_include_path(
    dirname(__FILE__) . '/../vendor/codeguy/Slim' .
    PATH_SEPARATOR .
    dirname(__FILE__) . '/../src' .
    PATH_SEPARATOR .
    get_include_path()
);
