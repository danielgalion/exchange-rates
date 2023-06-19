<?php 

declare(strict_types=1);

namespace App\Src\Controllers\ApiNbp;

require_once 'vendor/autoload.php';

use App\Src\Models\Currency;
use App\Src\Models\Rate;
use GuzzleHttp\Client;
use OutOfBoundsException;

class ActualRatesSaverController {

    private ?array $errors = null;

    public function __construct()
    {
        try {
            $this->saveToDb();
        } catch(OutOfBoundsException $e) {
            echo '<br>Saving to DB exception out of bounds<br>'; 
        } 
    } 

    public function getErrors(): ?array {
        return $this->errors;
    }

    private function saveToDb() {
        $preparedData = $this->prepareData();

        foreach ($preparedData['table_a'][0]->rates as $rate) {
            $this->saveCurrencyWithMidRate($rate->currency, $rate->code, $rate->mid);
        }

        foreach ($preparedData['table_b'][0]->rates as $rate) {
            $this->saveCurrencyWithMidRate($rate->currency, $rate->code, $rate->mid);
        }

        foreach ($preparedData['table_c'][0]->rates as $rate) {
            $this->saveCurrencyWithAskBidRates($rate->currency, $rate->code, $rate->ask, $rate->bid);
        }
    }

    private function saveCurrencyWithMidRate($currencyName, $currencyCode, $mid) {
        $this->saveCurrency($currencyName, $currencyCode);
        (new Rate)->save($mid, null, null, $currencyCode);
    }

    private function saveCurrencyWithAskBidRates($currencyName, $currencyCode, $ask, $bid) {
        $this->saveCurrency($currencyName, $currencyCode);
        (new Rate)->save(null, $ask, $bid, $currencyCode);
    }

    private function saveCurrency($currencyName, $currencyCode) {
        (new Currency)->save($currencyName, $currencyCode);
    }

    private function prepareData(): array {

        $data = [];

        $requestA = (new Client([]))->request('GET', NbpRoutes::table(TableTypes::TABLE_RATES_A));
        $requestB = (new Client([]))->request('GET', NbpRoutes::table(TableTypes::TABLE_RATES_B));
        $requestC = (new Client([]))->request('GET', NbpRoutes::table(TableTypes::TABLE_SELL_BUY));

        $statusA = $requestA->getStatusCode();
        $statusB = $requestB->getStatusCode();
        $statusC = $requestC->getStatusCode();

        if ($statusA == 200) {
            $data['table_a'] = json_decode($requestA->getBody()->getContents());
        } else {
            $data['table_a'] = null;
            $data['status_a'] = $statusA;
            $this->errors[] = 'Table a: ' . $statusA;
        }

        if ($statusB == 200) {
            $data['table_b'] = json_decode($requestB->getBody()->getContents());
        } else {
            $data['table_b'] = null;
            $data['status_b'] = $statusB;
            $this->errors[] = 'Table b: ' . $statusB;
        }

        if ($statusA == 200) {
            $data['table_c'] = json_decode($requestC->getBody()->getContents());
        } else {
            $data['table_c'] = null;
            $data['status_c'] = $statusC;
            $this->errors[] = 'Table c: ' . $statusC;
        }

        return $data; 
    }
}
