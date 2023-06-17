<?php

declare(strict_types=1);

namespace App\Src\Controllers\ApiNbp;

enum TableTypes: string {
    case TABLE_RATES_A = "a";
    case TABLE_RATES_B = "b";
    case TABLE_SELL_BUY = "c";
}

final class NbpRoutes {
    private const FORMAT = "?format=json";

    private const TABLE_ADDRESS = "http://api.nbp.pl/api/exchangerates/tables/";
    private const RATE_ADDRESS = "http://api.nbp.pl/api/exchangerates/rates/";

    public static function table(TableTypes $type) {
        return self::TABLE_ADDRESS . $type->value . self::FORMAT;
    }

    public static function rates(TableTypes $type, string $code) {
        return self::RATE_ADDRESS . $type->value . '/' . $code . self::FORMAT;
    }
 }