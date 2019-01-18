<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if(!isset($_SESSION['logedin'])):
	redirect('/login.php');
endif;

// Log out user.
unset($_SESSION['logedin']);
redirect('/');
