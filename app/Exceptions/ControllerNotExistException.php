<?php

namespace App\Exceptions;

use Exception;

class ControllerNotExistException extends Exception {
    public function __construct($message = "Esse controller não existe") {
        parent::__construct($message);
    }
}
