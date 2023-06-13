<?php

declare(strict_types=1);

namespace App\Src\Controllers\ApiNbp;

use App\Src\Models\Rate;

class ActualRates { 

    public function prepareData(): ?array {
        return (new Rate)->getAll();
    }

}