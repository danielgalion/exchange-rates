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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="../../index.php">Strona główna</a>
    <?php
        (new Migrations)->runner();    
    ?>
</body>
</html>
