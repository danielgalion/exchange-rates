<?php

declare(strict_types=1);

namespace Database;

use Exception;
use mysqli;

/**
 * @todo test with started and stopped mariadb
 * Class is singleton for not creating more than one instance of mysqli to make connection.
 */
final class MyDb {
    private static ?mysqli $instance = null;
    
    private function __construct()
    {
        
    }

    private function __clone()
    {
        
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize DB object.");
    }

    public static function getInstance(): mysqli {
        if (self::$instance !== null) {
            return self::$instance;
        } else { 
            self::$instance = self::createDatabaseConnection();
        }

        return self::$instance;
    }

    private static function createDatabaseConnection(): mysqli {
        try {
            $connection = new mysqli(ConnectionDetails::HOST, ConnectionDetails::LOGIN, ConnectionDetails::PASSWORD, ConnectionDetails::DATABASE, ConnectionDetails::PORT);
        } catch (Exception $exception) {
            die("DB mysqli error: " . $exception->getMessage());
        }

        if ($connection->connect_error) {
            die("DB connection error: ". $connection->connect_error);
        }

        return $connection;
    } 
}