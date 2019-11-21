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
        $params = include_once(ROOT . '/config/db_config.php');

        $dsn = "mysql:host={$params['host']};dbname={$params['db_name']}";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $connection = new PDO($dsn, $params['user'], $params['password'], $opt);

        return $connection;
    }
}