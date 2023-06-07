<?php

declare(strict_types=1);

use Database\MyDb;

class Model {
    private mysqli $db;

    public function __construct()
    {  
        $this->db = MyDb::getInstance();
    }

    protected function getDb() {
        return $this->db;
    }
}