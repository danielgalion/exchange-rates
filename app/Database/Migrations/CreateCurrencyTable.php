<?php

declare(strict_types=1);

namespace App\Database\Migrations;

require_once 'vendor/autoload.php';

use App\Src\Models\Model;

final class CreateCurrencyTable extends Model implements IMigration {
    public function run() {
        $this->tableQuery(
            "CREATE TABLE IF NOT EXISTS currency (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL DEFAULT '',
                code VARCHAR(3) NOT NULL,
                UNIQUE KEY (code)
            )
            ENGINE = InnoDb;
            "
        );
    } 

    public function down() {
        $this->tableQuery("DROP TABLE IF EXISTS currency;");
    }
}