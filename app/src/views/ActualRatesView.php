<?php 
declare(strict_types=1);
namespace App\Views;

require_once 'vendor/autoload.php';

use App\Src\Controllers\ApiNbp\ActualRates;

$rates = (new ActualRates)->prepareData();


// @todo osobno tabela currencies (dodawać jeśli brakuje). Osobno z kluczem obcym aktualne dane i przewalutowania.
// @todo walut nie robić usuwalnych - dlatego że w historii przewalutowań może być aktualnie nieuwzględniana w API
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
    <table>
        <tr>
            <th>Tabela</th>
            <th>Effective date</th>
            <th>Trading date</th>
        </tr>
        <tr>
            <td>
                <?= $rates['table_a'][0]->table ?>
            </td>
            <td>
                <?= $rates['table_a'][0]->effectiveDate ?>
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                <?= $rates['table_b'][0]->table ?>
            </td>
            <td>
                <?= $rates['table_b'][0]->effectiveDate ?>
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                <?= $rates['table_c'][0]->table ?>
            </td>
            <td>
                <?= $rates['table_c'][0]->effectiveDate ?>
            </td>
            <td>
                <?= $rates['table_c'][0]->tradingDate ?>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Waluta</th>
            <th>Skrót</th>
            <th>Cena średnia</th>
            <th>Cena kupna</th>
            <th>Cena sprzedaży</th>
        </tr>
        <?php foreach ($rates['table_a'][0]->rates as $rate): ?>
        <tr>
            <td><?= $rate->currency ?></td>
            <td><?= $rate->code ?></td>
            <td><?= $rate->mid ?> zł</td>
            <td></td>
            <td></td>
        </tr>
        <?php endforeach; ?>
        <?php foreach ($rates['table_b'][0]->rates as $rate): ?>
        <tr>
            <td><?= $rate->currency ?></td>
            <td><?= $rate->code ?></td>
            <td><?= $rate->mid ?> zł</td>
            <td></td>
            <td></td>
        </tr>
        <?php endforeach; ?>
        <?php foreach ($rates['table_c'][0]->rates as $rate): ?>
        <tr>
            <td><?= $rate->currency ?></td>
            <td><?= $rate->code ?></td>
            <td></td>
            <td><?= $rate->ask ?> zł</td>
            <td><?= $rate->bid ?> zł</td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</body>
</html>