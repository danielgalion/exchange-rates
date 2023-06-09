<?php

declare(strict_types=1);

namespace App\Src\Models;

use App\Database\MyDb;
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

    public function selectQuery($query, $params = []) {
        $stmt = $this->db->prepare($query);
        
        if ($stmt === false) {
            die("Error preparing query: " . $this->db->error);
        }
        
        if (!empty($params)) {
            $stmt->bind_param($this->getBindTypes($params), ...$params);
        }
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        $rows = [];
        
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        
        $stmt->close();
        
        return $rows;
    }
    
    public function insertQuery($query, $params = []) {
        $stmt = $this->db->prepare($query);
        
        if ($stmt === false) {
            die("Error preparing query: " . $this->db->error);
        }
        
        if (!empty($params)) {
            $stmt->bind_param($this->getBindTypes($params), ...$params);
        }
        
        $stmt->execute();
        
        $insertId = $stmt->insert_id;
        
        $stmt->close();
        
        return $insertId;
    }
    
    public function deleteQuery($query, $params = []) {
        $stmt = $this->db->prepare($query);
        
        if ($stmt === false) {
            die("Error preparing query: " . $this->db->error);
        }
        
        if (!empty($params)) {
            $stmt->bind_param($this->getBindTypes($params), ...$params);
        }
        
        $stmt->execute();
        
        $affectedRows = $stmt->affected_rows;
        
        $stmt->close();
        
        return $affectedRows;
    }
    
    public function updateQuery($query, $params = []) {
        $stmt = $this->db->prepare($query);
        
        if ($stmt === false) {
            die("Error preparing query: " . $this->db->error);
        }
        
        if (!empty($params)) {
            $stmt->bind_param($this->getBindTypes($params), ...$params);
        }
        
        $stmt->execute();
        
        $affectedRows = $stmt->affected_rows;
        
        $stmt->close();
        
        return $affectedRows;
    }

    /**
     * Use for CREATE, ALTER, and DROP TABLE queries.
     */
    public function tableQuery($query) {
        $stmt = $this->db->prepare($query);
        
        if ($stmt === false) {
            die("Error preparing query: " . $this->db->error);
        }
        
        $stmt->execute();
        
        $stmt->close();
    }
    
    private function getBindTypes($params) {
        $bindTypes = "";
        
        foreach ($params as $param) {
            if (is_int($param)) {
                $bindTypes .= "i";
            } elseif (is_float($param)) {
                $bindTypes .= "d";
            } else {
                $bindTypes .= "s";
            }
        }
        
        return $bindTypes;
    }
}