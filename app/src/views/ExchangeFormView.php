<?php

declare(strict_types=1);

namespace App\Src\Views;

use App\Src\Controllers\Utils\PostValidator;
use App\Src\Models\Currency;

require_once 'vendor/autoload.php';

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wymiana walut</title>
</head>
<body>
    <h1>Przeliczanie kursów walut</h1>
    <h2>Jak to zrobić?</h2>
    <p>
        <ol>
            <li>Wpisz kwotę za którą chcesz kupić inną walutę.</li>
            <li>Wybierz waluty: aktualną i docelową.</li>
        </ol>
    </p>
    <form action="" method="POST">
        <label for="<?= PostValidator::AMOUNT_SOLD ?>">Kwota wejściowa</label>
        <input name="<?= PostValidator::AMOUNT_SOLD ?>" type="number" step="any" value="<?= (string) PostValidator::amountSold() ?? '' ?>" min="0" /><br>
        <label for="<?= PostValidator::CURRENCY_SELLING ?>">Sprzedawana waluta</label>
        <select name="<?= PostValidator::CURRENCY_SELLING ?>" id="<?= PostValidator::CURRENCY_SELLING ?>">
            <?php ExchangeFormView::currencyOptions(PostValidator::currencySelling()); ?>
        </select>
        <label for="<?= PostValidator::CURRENCY_BUYING ?>">Kupowana waluta</label>
        <select name="<?= PostValidator::CURRENCY_BUYING ?>" id="<?= PostValidator::CURRENCY_BUYING ?>">
            <?php ExchangeFormView::currencyOptions(PostValidator::currencyBuying()); ?>
        </select><br>
        <button type="submit">Oblicz</button>
    </form>
</body>
</html>

<?php
    final class ExchangeFormView {
        public static function currencyOptions(?int $selectedId) {
            $currencies = (new Currency)->getAllCodes();

            foreach ($currencies as $currency) {
                echo '<option value="'. $currency['id'] .'"' . ($selectedId == $currency['id'] ? ' selected ' : '') . '>'.$currency['code'].'</option>';
            }
        }
    }
?>