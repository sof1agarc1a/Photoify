<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

// Log out user.

unset($_SESSION['logedin']);
// session_destroy();
redirect('/');
