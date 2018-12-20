<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we login users.

if(isset($_POST['username'], $_POST['password'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);

    $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username');

    $statement->bindParam(':username', $username, PDO::PARAM_STR);

    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $password = $_POST['password'];

		if(empty($username) || empty($password)) {
			$_SESSION['empty'] = "Please fill in the required fields!";
			redirect('/login.php');
		}

    if(!$user || !password_verify($password, $user['password'])) {
        $_SESSION['wrong'] = "Wrong email or password!";
        redirect('/login.php');

    }

    if(password_verify($password, $user['password'])) {
        $_SESSION['user'] = "Hi " . $user['full_name'] . "!";
    };
}
redirect('/');
