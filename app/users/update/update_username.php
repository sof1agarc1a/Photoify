<?php
declare(strict_types=1);
require __DIR__.'/../../autoload.php';

if(!isset($_SESSION['logedin'])):
	redirect('/login.php');
endif;

if(isset($_POST['update-username'])) {
	$username = trim(filter_var($_POST['new-username'], FILTER_SANITIZE_STRING));
	$user_id = $_SESSION['logedin']['user_id'];

	if($username === $_SESSION['logedin']['username']) {
		$_SESSION['same-username'] = "This is already your username.";
		redirect('/delete.php');
	}

	if(empty($username)) {
		$_SESSION['empty'] = "Please fill in the required fields!";
		redirect('/delete.php');
	}

	$statement = $pdo->prepare('SELECT username FROM users WHERE username = :username;');
	$statement->bindParam(':username', $username, PDO::PARAM_STR);
	$statement->execute();
	$existingUsername = $statement->fetch(PDO::FETCH_ASSOC);

	if($existingUsername['username'] === $username) {
		$_SESSION['taken-username'] = "This username is already taken, please chose another one.";
		redirect('/delete.php');
	}

	$statement = $pdo->prepare('UPDATE users SET username = :username WHERE user_id = :user_id');
	$statement->bindParam(':username', $username, PDO::PARAM_STR);
	$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$statement->execute();

	$statement = $pdo->prepare('UPDATE posts SET username = :username WHERE user_id = :user_id');
	$statement->bindParam(':username', $username, PDO::PARAM_STR);
	$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$statement->execute();

	$statement = $pdo->prepare('UPDATE comments SET username = :username WHERE user_id = :user_id');
	$statement->bindParam(':username', $username, PDO::PARAM_STR);
	$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$statement->execute();

	$_SESSION['updated-username'] = "Your username has been updated!";
	$_SESSION['logedin']['username'] = $username;
}
redirect('/delete.php');
