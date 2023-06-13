<?php

declare(strict_types=1);

namespace App\Database\Migrations;

require_once 'vendor/autoload.php';

use App\Src\Models\Model;

final class CreateRatesTable extends Model implements IMigration {
    public function run() {
        $this->tableQuery("
            CREATE TABLE IF NOT EXISTS rates (
                id INT AUTO_INCREMENT PRIMARY KEY,
                mid DECIMAL(15,10) UNSIGNED DEFAULT NULL,
                ask DECIMAL(15,10) UNSIGNED DEFAULT NULL,
                bid DECIMAL(15,10) UNSIGNED DEFAULT NULL,
                currency_id INT NOT NULL,
                UNIQUE KEY (currency_id),
                CONSTRAINT `fk_currency`
                FOREIGN KEY (currency_id)
                REFERENCES currency (id)
                ON DELETE RESTRICT
                ON UPDATE RESTRICT
            )
            ENGINE = InnoDb;
        ");
    }

    public function down() {
        $this->tableQuery("DROP TABLE IF EXISTS rates;");
    }
}