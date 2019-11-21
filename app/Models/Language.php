<?php

declare(strict_types=1);

class Language
{
    /**
     * Define path to the language files.
     * @var string
     */
    private const LANG_PATH = ROOT . '/languages/';

    public function __construct()
    {
        if (!isset($_SESSION['lang'])) {
            $_SESSION['lang'] = 'en';
        }
    }

    /**
     * Get language from the global store.
     * @return string
     */
    public function getLang(): string
    {
        if (!isset($_SESSION['lang'])) {
            return (string)false;
        }

        return $_SESSION['lang'];
    }

    /**
     * Set language from the global store.
     * @param string
     * @return void
     */
    public function setLang(string $lang): void
    {
        $_SESSION['lang'] = $lang;
    }

    /**
     * Get data for current language chosen and parse it.
     * @param  string
     * @return array
     */
    public function getData(string $component): array
    {
        $langFile = self::LANG_PATH . $_SESSION['lang'] . '/' . $component . '.ini';
        $common = self::LANG_PATH . $_SESSION['lang'] . '/common.ini';
        if (!file_exists($langFile)) {
            throw new Execption("Language could not be loaded");
        }
        $langData = parse_ini_file($langFile);
        $commonData = parse_ini_file($common);

        return array_merge($langData, $commonData);
    }
}