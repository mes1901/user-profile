<?php

declare(strict_types=1);

class Database
{
    /**
     * Get the database connection with current config.
     * @return PDO
     */
    public static function connect(): PDO
    {
        $host = env('DB_HOST');
        $db_name = env('DB_NAME');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        $dsn = "mysql:host={$host};dbname={$db_name}";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $connection = new PDO($dsn, $username, $password, $opt);

        return $connection;
    }
}