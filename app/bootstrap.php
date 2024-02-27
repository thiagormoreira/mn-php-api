<?php
require_once __DIR__."/../vendor/autoload.php";

define('BASE_PATH',realpath(__DIR__.'/../'));

use Core\Classes\Bind;
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->safeLoad();

$config = require_once __DIR__."/../config/config.php";

Bind::bind('config', $config);

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
