<?php
/**
 * Start session with launching autoload script
 * which connect all controllers and modules.
 * Create Router for analyzing url requests.
 *
 */

session_start();

define('DEVELOPMENT_MODE', FALSE);
define('ROOT', dirname(__FILE__));

if (DEVELOPMENT_MODE)
{
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set("display_errors", TRUE);
} else
{
    ini_set("display_errors", FALSE);
}

require_once(ROOT . '/config/autoload.php');

(new Router())->run();
