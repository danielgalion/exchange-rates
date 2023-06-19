<?php declare(strict_types=1);

namespace App;

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
            <a href="Database/Migrations/Migrations.php">Stwórz na nowo tabele w bazie danych</a>
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
