<?php

/**
 * Function for connection classes automatically.
 */

spl_autoload_register(function ($class_name) {
    $array_paths = array(
        '/app/Core/',
        '/app/Models/',
        '/app/Controllers/',
    );

    foreach ($array_paths as $path)
    {
        $path = ROOT . $path . $class_name . '.php';

        if (is_file($path))
        {
            include_once $path;
        }
    }
});

if(file_exists(ROOT . '/config/env.php')) {
    include_once ROOT . '/config/env.php';
}
if(!function_exists('env')) {
    function env($key, $default = null)
    {
        $value = getenv($key);
        if ($value === false) {
            return $default;
        }
        return $value;
    }
}
