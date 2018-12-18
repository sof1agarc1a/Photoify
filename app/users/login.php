<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we login users.

if(isset($_POST['email'], $_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);

    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');

    $statement->bindParam(':email', $email, PDO::PARAM_STR);

    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $password = $_POST['password'];

    if(!$user || !password_verify($password, $user['password'])) {
        $_SESSION['wrong'] = "Wrong email or password!";
        redirect('/login.php');

    }

    if(password_verify($password, $user['password'])) {
        $_SESSION['user'] = "Hi " . $user['name'] . "!";
    };
}
redirect('/');
