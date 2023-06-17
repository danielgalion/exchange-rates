<?php declare(strict_types=1);

namespace App;

/**
 @todo production:
 1. install mysql
 2. conf connection - credentials
 3. change include_path (set to root) in php.ini
 4. ini_set and display_errors do not show errors
 5. Delete exceptions' messages to not show code inside information
 
 @todo during development: 
 1. try-catches
 2. validations - in exchanging
 3. use transactions (if more than one query)
 4. menu in this file. Back buttons (main page) in other views. - at least this for user's flow
 5. On no values at the start of app - show information.
 */
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursy walut NBP</title>
</head>
<body>
    <h1>Kursy walut</h1>
    <ul>
        <li>
            <a href="Database/Migrations/Migrations.php">Stwórz tabele w bazie danych</a>
        </li>
        <li>
            <a href="Src/Views/ActualRatesView.php">Ostatnio pobrane kursy walut</a>
        </li>
        <li>
            <a href="Src/Views/ActualRatesSaverView.php">Pobierz kursy walut z NBP</a>
        </li>
        <li>
            <a href="Src/Views/ExchangeFormView.php">Przelicz kursy walut</a>
        </li>
        <li>
            <a href="Src/Views/ExchangeHistoryView.php">Ostatnie przeliczenia walut</a>
        </li>
    </ul>
    
</body>
</html>
