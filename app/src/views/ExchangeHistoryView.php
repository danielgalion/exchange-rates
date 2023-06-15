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
    <title>Historia wymiany walut</title>
</head>
<body>
    <h1>Ostatnie przewalutowania</h1>
    <?= var_dump((new Trade)->getLast(3)) ?>
</body>
</html>