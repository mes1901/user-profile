<?php

declare(strict_types=1);

$variables = [
    'DB_HOST' => 'localhost',
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => 'secret',
    'DB_NAME' => 'db_name',
];

foreach ($variables as $key => $value) {
    putenv("$key=$value");
}