<?php

declare(strict_types=1);

namespace App\Src\Views;

use App\Src\Controllers\ApiNbp\ActualRatesSaverController;
use Exception;

require_once 'vendor/autoload.php';

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zapis kursów walut</title>
</head>
<body>
    <?php
        try {
            $rates = new ActualRatesSaverController;
        } catch (Exception $e) {
            echo 'Błąd w zapisie kursów walut<br>';
        } finally {
            echo 'Brak błędów podczas zapisywania kursów walut<br>';
        }

        foreach ($rates->getErrors() as $error) {
            echo "Błąd pobierania z API: $error<br>";
        }
    ?>
</body>
</html>