<?php

namespace Core;

use Core\Classes\Uri;
use App\Exceptions\ControllerNotExistException;

final class Controller {

    private string $uri;
    private string $controller;
    private string $namespace;
    private array $folders = [
        'App\Controllers',
    ];

    public function __construct()
    {
        $this->uri = Uri::uri();
    }

    /**
     * @throws ControllerNotExistException
     */
    public function load(): object
    {
        if ($this->isHome()) {
            return $this->controllerHome();
        }
        return $this->controllerNotHome();
    }

    /**
     * @throws ControllerNotExistException
     */
    private function controllerHome(): object
    {
        if (!$this->controllerExist('HomeController')) {
            throw new ControllerNotExistException();
        }

        return $this->instantiateController();
    }

    /**
     * @throws ControllerNotExistException
     */
    private function controllerNotHome(): object
    {
        $controller = $this->getControllerNotHome();

        if (!$this->controllerExist($controller)) {
            throw new ControllerNotExistException();
        }

        return $this->instantiateController();

    }

    private function getControllerNotHome(): string
    {
        if (substr_count($this->uri, '/') > 1) {
            list($controller) = array_values(array_filter(explode('/', $this->uri)));
            return ucfirst($controller) . 'Controller';
        }

        return ucfirst(ltrim($this->uri, '/')) . 'Controller';

    }

    private function isHome(): bool
    {
        return $this->uri == '/';
    }

    private function controllerExist(string $controller): bool
    {
        $controllerExist = false;

        foreach ($this->folders as $folder) {
            if (class_exists($folder . '\\' . $controller)) {
                $controllerExist = true;
                $this->namespace = $folder;
                $this->controller = $controller;
            }
        }

        return $controllerExist;

    }

    private function instantiateController(): object
    {
        $controller = $this->namespace . '\\' . $this->controller;
        return new $controller;
    }
}
