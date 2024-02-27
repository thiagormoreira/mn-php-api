<?php

namespace Core;

use Core\Classes\Uri;

class Parameters {

    private string $uri;

    public function __construct() {
        $this->uri = Uri::uri();
    }

    final public function load(): object|null
    {
        return $this->getParameter();
    }

    private function getParameter(): object|null
    {

        if (substr_count($this->uri, '/') > 2) {
            $parameter = array_values(array_filter(explode('/', $this->uri)));

            return (object) [
                'parameter' => filter_var($parameter[2]),
                'next' => filter_var($this->getNextParameter(2)),
            ];

        }

        return null;
    }

    private function getNextParameter(int $actual): string
    {
        $parameter = array_values(array_filter(explode('/', $this->uri)));

        return $parameter[$actual + 1] ?? $parameter[$actual];

    }
}
