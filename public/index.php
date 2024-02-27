<?php

require_once __DIR__."/../app/bootstrap.php";

use Core\Controller;
use Core\Method;
use Core\Parameters;

try {
    $controller = new Controller;
    $controller = $controller->load();

    $method = new Method;
    $method = $method->load($controller);

    $parameters = new Parameters;
    $parameters = $parameters->load();

    $controller->$method($parameters);

} catch (\Exception $e) {
    dd($e->getMessage());
}
