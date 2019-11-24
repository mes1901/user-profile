<?php

declare(strict_types=1);

$variables = [
    'DB_HOST' => 'mysql',
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => 'pass',
    'DB_NAME' => 'db',
];

foreach ($variables as $key => $value) {
    putenv("$key=$value");
}