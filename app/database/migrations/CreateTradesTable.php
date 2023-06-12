<?php 

declare(strict_types=1);

namespace App\Database\Migrations;

require_once 'vendor/autoload.php';

use App\Src\Models\Model;

final class CreateTradesTable extends Model implements IMigration {
    public function run() {
        $this->tableQuery("
            CREATE TABLE IF NOT EXISTS trades (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    currency_selling_id INT NOT NULL,
                    currency_buying_id INT NOT NULL,
                    selling_price DECIMAL(15, 10) UNSIGNED NOT NULL,
                    buying_price DECIMAL(15, 10) UNSIGNED NOT NULL,
                    timestamp DATETIME(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    amount_sold DECIMAL(15,10) UNSIGNED NOT NULL,
                    amount_bought DECIMAL(15,10) UNSIGNED NOT NULL,
                    CONSTRAINT `fk_currency_selling`
                    FOREIGN KEY (currency_selling_id)
                    REFERENCES currency (id)
                    ON DELETE RESTRICT
                    ON UPDATE RESTRICT,
                    CONSTRAINT `fk_currency_buying` 
                    FOREIGN KEY (currency_buying_id)
                    REFERENCES currency (id)
                    ON DELETE RESTRICT
                    ON UPDATE RESTRICT
                )
                ENGINE = InnoDb;
        ");
    }

    public function down() {
        $this->tableQuery("DROP TABLE IF EXISTS trades;");
    }
}