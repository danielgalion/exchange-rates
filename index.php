<?php declare(strict_types=1);

require_once __DIR__ . "/vendor/autoload.php";

use Src\Models\Model;

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

    <?php var_dump((new Model)->getDb()); ?>
</body>
</html>
