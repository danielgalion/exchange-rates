<?php

declare(strict_types=1);

namespace App\Src\Models;

use Brick\Math\BigDecimal;

class Trade extends Model {
    private const TABLE = 'trades';

    public function save(int $currencySelling, int $currencyBuying, string $sellingPrice, string $buyingPrice, BigDecimal $amountSold, BigDecimal $amountBought) {
        $this->insertQuery("
            INSERT INTO ". self::TABLE ." 
            (
                currency_selling_id, currency_buying_id,
                selling_price, buying_price,
                amount_sold, amount_bought
            )
            VALUES
            (
                ?,?,?,?,?,?
            );
        ", [
            $currencySelling, $currencyBuying, $sellingPrice, $buyingPrice, 
            (string) $amountSold, (string) $amountBought
            ]);
    }

    /**
     * @param limit how many last trades
     */
    public function getLast($limit) {

    }
}