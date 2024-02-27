<?php

namespace Core;

use App\Controllers\BaseController;
use Core\Classes\Uri;
use App\Exceptions\MethodNotExistException;

class Method {

    private string $uri;

    public function __construct()
    {
        $this->uri = Uri::uri();
    }

    final public function load(BaseController $controller): string
    {
        $method = $this->getMethod();

        if (!method_exists($controller, $method)) {
            throw new MethodNotExistException("Esse método não existe: {$method}");
        }

        return $method;
    }

    private function getMethod(): string
    {

        if (substr_count($this->uri, '/') > 1) {
            list($controller, $method) = array_values(array_filter(explode('/', $this->uri)));
            return $method;
        }

        return 'index';
    }
}
