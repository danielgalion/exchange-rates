<?php

declare(strict_types=1);

namespace App\Database\Migrations;

require_once 'vendor/autoload.php';

use App\Src\Models\Model;
use Exception;

/**
 * Uncomment to run which you want.
 */
final class Migrations extends Model { 
    public function runner() {
        (new CreateCurrencyTable)->down();
        (new CreateTradesTable)->down();
        (new CreateRatesTable)->down();
        (new CreateCurrencyTable)->run();
        (new CreateTradesTable)->run();
        (new CreateRatesTable)->run();
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
        try {
            (new Migrations)->runner();    
        } catch (Exception $e) {
            echo '<br>Wystąpił błąd podczas tworzenia tabel<br>';
        } finally {
            echo '<br>Utworzono tabele bez błędów<br>';
        }
    ?>
</body>
</html>
