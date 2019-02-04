<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * @param string
     * @return void
     */

    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }

    function alert($message)
    {
        if (isset($_SESSION[$message])):
        echo $_SESSION[$message];
        unset($_SESSION[$message]);
        endif;
    }
}
