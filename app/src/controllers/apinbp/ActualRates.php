<?php

declare(strict_types=1);

namespace App\Src\Controllers\ApiNbp;

use GuzzleHttp\Client;
use App\Src\Controllers\ApiNbp\NbpRoutes;
use App\Src\Controllers\ApiNbp\TableTypes;

class ActualRates { 

    // @todo handle network errors. Get response - if 20x OK, if 40x NOT_FOUND OR PERM DEN, if 50x SERVER ERROR.
    // tested OK for 200 responses.
    public function prepareData() {

        $requestA = (new Client([]))->request('GET', NbpRoutes::table(TableTypes::TABLE_RATES_A))->getBody()->getContents();
        $requestB = (new Client([]))->request('GET', NbpRoutes::table(TableTypes::TABLE_RATES_B))->getBody()->getContents();
        $requestC = (new Client([]))->request('GET', NbpRoutes::table(TableTypes::TABLE_SELL_BUY))->getBody()->getContents();

        return ['table_a' => json_decode($requestA), 'table_b' => json_decode($requestB), 'table_c' => json_decode($requestC)];
    }

}