<?php

declare(strict_types=1);

class Controller
{
    /**
     * Define views path
     * Define the database connection
     * @var string
     * @var object
     */
    private const VIEW_PATH = ROOT . '/views/';
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * View connection with passed data
     * @var string
     * @var array
     * @return void
     */
    public function render(string $viewName, array $data): void
    {
        if (count($data)) {
            extract($data);
        }
        $filePath = self::VIEW_PATH . $viewName . '.php';
        if (!file_exists($filePath)) {
            echo new Exception('File not exists.');
        }

        require_once $filePath;
    }
}