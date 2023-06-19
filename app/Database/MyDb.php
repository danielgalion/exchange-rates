<?php

declare(strict_types=1);

namespace App\Database;

use Exception;
use mysqli;

/**
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
        $url = getenv('JAWSDB_MARIA_URL');
        $dbparts = parse_url($url);

        $hostname = $dbparts['host'];
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        $database = ltrim($dbparts['path'],'/');

        try {
            $connection = new mysqli($hostname, $username, $password, $database, 3306);
        } catch (Exception $exception) {
            die("<br>DB mysqli error");
        }

        if ($connection->connect_error) {
            die("<br>DB connection error");
        }

        return $connection;
    } 
}