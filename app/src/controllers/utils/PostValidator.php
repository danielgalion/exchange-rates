<?php

declare(strict_types=1);

namespace App\Src\Controllers\Utils;

use Brick\Math\BigDecimal;

require_once 'vendor/autoload.php';

final class PostValidator {
    public const AMOUNT_SOLD = 'amount_sold';
    public const CURRENCY_SELLING = 'currency_selling';
    public const CURRENCY_BUYING = 'currency_buying';

    public static function amountSold(): ?BigDecimal {
        $post = (isset($_POST[self::AMOUNT_SOLD]) ? $_POST[self::AMOUNT_SOLD] : null);

        // if post numeric float or not null else null
        if ($post != null && is_numeric($post) && floatval($post) > 0) {
            return BigDecimal::of($post);
        } else { 
            return null;
        }
    }

    public static function currencySelling() {
        $post = (isset($_POST[self::CURRENCY_SELLING]) ? $_POST[self::CURRENCY_SELLING] : null);

        return self::dbId($post);
    }

    public static function currencyBuying() {
        $post = (isset($_POST[self::CURRENCY_BUYING]) ? $_POST[self::CURRENCY_BUYING] : null);

        return self::dbId($post);
    }

    private static function currencyCode($code): ?string {
        if ($code != null && is_string($code) && strlen($code) === 3) {
            return $code;
        } else {
            return null;
        }
    }

    private static function dbId($id): ?int {
        if ($id != null && is_numeric($id) && intval($id) == $id && intval($id) > 0) {
            return intval($id);
        } else {
            return null;
        }
    }
}