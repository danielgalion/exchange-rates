<?php

declare(strict_types=1);

namespace App\Src\Models;

class Trade extends Model {
    private const TABLE = 'trades';

    public function save() {

    }

    /**
     * @param limit how many last trades
     */
    public function getLast($limit) {

    }
}