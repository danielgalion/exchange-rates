<?php

declare(strict_types=1);

namespace App\Database\Migrations;

require_once 'vendor/autoload.php';

interface IMigration {
    public function run();
    public function down();
}