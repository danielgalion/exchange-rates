<?php

declare(strict_types=1);

namespace Src\Models;

use Database\MyDb;
use mysqli;

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