<?php

declare(strict_types=1);

namespace App\Src\Views;

use App\Src\Models\Trade;

require_once 'vendor/autoload.php';

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css">
    <title>Historia wymiany walut</title>
</head>
<body>
    <h1>Ostatnie maksymalnie 20 przewalutowań</h1>
    <!-- <?= var_dump((new Trade)->getLast(3)) ?> -->

    <?php $trades = (new Trade)->getLast(20); ?>
    <table>
        <tr>
            <td>Waluta sprzedana</td>
            <td>Waluta kupiona</td>
            <td>Cena sprzedaży (zł)</td>
            <td>Cena kupna (zł)</td>
            <td>Ilość sprzedana</td>
            <td>Ilość kupiona</td>
        </tr>
        <?php foreach ($trades as $trade): ?>
            <tr>
                <td><?= $trade['sold'] ?></td>
                <td><?= $trade['bought'] ?></td>
                <td><?= $trade['selling_price'] ?></td>
                <td><?= $trade['buying_price'] ?></td>
                <td><?= $trade['amount_sold'] ?></td>
                <td><?= $trade['amount_bought'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>