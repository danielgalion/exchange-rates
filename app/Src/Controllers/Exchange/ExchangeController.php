<?php

declare(strict_types=1);

namespace App\Src\Controllers\Exchange;

use App\Src\Models\Rate;
use App\Src\Models\Trade;
use Brick\Math\BigDecimal;
use Brick\Math\Exception\MathException;
use Brick\Math\RoundingMode;
use Exception;

class ExchangeController {

    private ?int $currencySelling;
    private ?int $currencyBuying;

    private ?string $rateSelling;
    private ?string $rateBuying;
    
    private ?BigDecimal $amountSold;
    private ?BigDecimal $otherBought;

    public function __construct(int $currencySelling, int $currencyBuying, BigDecimal $amountSold)
    {
        $this->currencySelling = $currencySelling;
        $this->currencyBuying = $currencyBuying;
        $this->amountSold = $amountSold;
    }

    // bid - sprzedazy
    // ask - kupna
    // mid - gdy nie ma powyzszych
    /**
     * @param currencySelling id in db
     * @param currencyBuying id in db
     */
    public function calculate(): ?BigDecimal {
        $rate = new Rate;
        $ratesSelling = $rate->getByCurrencyId($this->currencySelling);
        $ratesBuying = $rate->getByCurrencyId($this->currencyBuying);
        
        try {
            $this->rateSelling = ($ratesSelling['bid'] ? $ratesSelling['bid'] : $ratesSelling['mid']);
            $this->rateBuying = ($ratesBuying['ask'] ? $ratesBuying['ask'] : $ratesBuying['mid']);
        } catch (Exception $e) {
            echo '<br>Problem with getting rates<br>';
            return null;
        }
        
        try {
            // with amount of given currency
            $plnBought = BigDecimal::of($this->rateSelling)->multipliedBy($this->amountSold);

            $this->otherBought = BigDecimal::of($plnBought)->dividedBy($this->rateBuying, 10, RoundingMode::HALF_UP);
        } catch (MathException $e) {
            echo '<br>Problem with math calculations<br>';
            return null;
        }
        try {
            $this->save();
        } catch (Exception $e) {
            echo '<br>Problem with saving trade to DB<br>';
        }
    
        return $this->otherBought;
    }

    private function save() {
        (new Trade)->save(
            $this->currencySelling,
            $this->currencyBuying,
            $this->rateSelling,
            $this->rateBuying,
            $this->amountSold,
            $this->otherBought
        );
    }
}