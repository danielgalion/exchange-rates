<?php

declare(strict_types=1);

namespace App\Src\Models;

require_once 'vendor/autoload.php';

use App\Src\Models\Model;
use Exception;

class Currency extends Model {
    private const TABLE = 'currency';

    public function save(string $name, string $code) {
        try {
            $this->upsertQuery("
                INSERT INTO " . self::TABLE . " (name, code) VALUES (?,?) ON DUPLICATE KEY UPDATE name = VALUES(name), code = VALUES(code);
            ", [$name, $code]);
        } catch (Exception $e) {
            echo 'Problem with saving currency to DB: ' . $e->getMessage();
        }
    }

    public function getIdByCode(string $code): ?int {
        try {
            $idQ = $this->selectQuery("SELECT id FROM " . self::TABLE . " WHERE code = ?", [$code]);
            $id = $idQ[0]['id'];
        } catch (Exception $e) {
            echo 'Problem with get currency id: ' . $e->getMessage();
            return 0;
        } finally {
            return $id;
        }
    }
}