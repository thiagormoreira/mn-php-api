<?php

namespace Core;

use Core\Classes\Bind;
use Exception;
use PDO;
final class Database
{
    /**
     * @throws Exception
     */
    public static function conncect(): PDO
    {
        try {
            $config = (object) Bind::resolve('config')->database;

            return new PDO("mysql:host=$config->host;dbname=$config->dbname;charset=$config->charset",
                $config->user,
                $config->password,
                $config->options
            );
        }
        catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}