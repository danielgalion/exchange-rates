<?php

declare(strict_types=1);

namespace App\Src\Controllers\Exchange;

use App\Src\Models\Rate;
use Brick\Math\BigDecimal;
use Brick\Math\Exception\MathException;
use Brick\Math\RoundingMode;
use Exception;

class ExchangeController {



    public function __construct()
    {
        
    }

    // bid - sprzedazy
    // ask - kupna
    // mid - gdy nie ma powyzszych
    /**
     * @param currencySelling id in db
     * @param currencyBuying id in db
     */
    public function calculate(int $currencySelling, int $currencyBuying, BigDecimal $amountSold): ?BigDecimal {
        $rate = new Rate;
        $ratesSelling = $rate->getByCurrencyId($currencySelling);
        $ratesBuying = $rate->getByCurrencyId($currencyBuying);
        
        try {
            $rateSelling = ($ratesSelling['bid'] ? $ratesSelling['bid'] : $ratesSelling['mid']);
            $rateBuying = ($ratesBuying['ask'] ? $ratesBuying['ask'] : $ratesBuying['mid']);
        } catch (Exception $e) {
            echo 'Problem with getting rates<br>';
            return null;
        }
        
        try {
            // with amount of given currency
            $plnBought = BigDecimal::of($rateSelling)->multipliedBy($amountSold);

            $otherBought = BigDecimal::of($plnBought)->dividedBy($rateBuying, 10, RoundingMode::HALF_UP);
        } catch (MathException $e) {
            echo 'Problem with math calculations<br>';
            return null;
        }
    
        return $otherBought;
    }

    public function save() {

    }
}