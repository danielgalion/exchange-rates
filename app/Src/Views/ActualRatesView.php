<?php 
declare(strict_types=1);
namespace App\Src\Views;

require_once 'vendor/autoload.php';

use App\Src\Controllers\ApiNbp\ActualRates;

$rates = (new ActualRates)->prepareData();

?>
<!DOCTYPE html> 
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css">
    <title>Aktualne kursy walut</title>
</head>
<body>
    <a href="../../index.php">Strona główna</a>
    <table>
        <tr>
            <th>Waluta</th>
            <th>Skrót</th>
            <th>Cena średnia</th>
            <th>Cena kupna</th>
            <th>Cena sprzedaży</th>
        </tr>
        <?php foreach ($rates as $rate): ?>
        <tr>
            <td><?= $rate['name'] ?></td>
            <td><?= $rate['code'] ?></td>
            <td><?= ($rate['mid'] ? $rate['mid'] . 'zł' : '') ?></td>
            <td><?= ($rate['ask'] ? $rate['ask'] . 'zł' : '') ?></td>
            <td><?= ($rate['bid'] ? $rate['bid'] . 'zł' : '') ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</body>
</html>