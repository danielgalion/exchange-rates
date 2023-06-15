<?php

declare(strict_types=1);

namespace App\Database\Migrations;

require_once 'vendor/autoload.php';

use App\Src\Models\Model;

/**
 * Uncomment to run which you want.
 */
final class Migrations extends Model { 
    public function runner() {
        (new CreateCurrencyTable)->run();
        // (new CreateCurrencyTable)->down();
        (new CreateTradesTable)->run();
        // (new CreateTradesTable)->down();
        (new CreateRatesTable)->run();
        // (new CreateRatesTable)->down();
    }
}

(new Migrations)->runner();