<?php

declare(strict_types=1);

namespace App\Src\Models;

require_once 'vendor/autoload.php';

use App\Src\Models\Model;
use Exception;

class Rate extends Model {
    private const TABLE = 'rates'; 

    /**
     * @param mid pass null on no information 
     * @param ask pass null on no information
     * @param bid pass null on no information
     */
    public function save($mid, $ask, $bid, $currencyCode) {
        try {
            $currencyId = (new Currency)->getIdByCode($currencyCode);

            if ($mid != null) {
                // insert mid price
                $this->upsertQuery("
                    INSERT INTO " . self::TABLE . " (mid, currency_id) VALUES (?,?) ON DUPLICATE KEY UPDATE mid = VALUES(mid), currency_id = VALUES(currency_id);
                ", [$mid, $currencyId]);
            } else if ($ask != null && $bid != null) {
                //insert ask and bid prices
                $this->upsertQuery("
                    INSERT INTO ". self::TABLE ." (ask, bid, currency_id) VALUES (?,?,?) ON DUPLICATE KEY UPDATE ask = VALUES(ask), bid = VALUES(bid), currency_id = VALUES(currency_id);
                ", [$ask, $bid, $currencyId]);
            }
        } catch (Exception $e) {
            echo '<br>Problem with saving Rate to db<br>';
        }
    }

    public function getByCurrencyId($currencyId): ?array {
        try {
            $rates = $this->selectQuery("SELECT mid, ask, bid FROM " . self::TABLE . " WHERE currency_id = ?", [$currencyId]);
        } catch (Exception $e) {
            echo '<br>Problem with get exchange rate<br>';
            return null;
        } finally {
            return $rates[0];
        }
    }

    public function getByCode($currencyCode): ?array {
        $currencyId = (new Currency)->getIdByCode($currencyCode);

        return $this->getByCurrencyId($currencyId);
    }

    public function getAll(): ?array {
        try {
            $rates = $this->selectQuery("
                SELECT mid, ask, bid, name, code
                FROM ". self::TABLE ." 
                LEFT JOIN currency ON currency.id = ". self::TABLE .".currency_id
                ");
        } catch (Exception $e) {
            echo '<br>Problem with get rates from DB<br>';
            return null;
        } finally {
            return $rates;
        }
    }
}