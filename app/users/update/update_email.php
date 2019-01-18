<?php
declare(strict_types=1);
require __DIR__.'/../../autoload.php';

if(!isset($_SESSION['logedin'])):
	redirect('/login.php');
endif;

if(isset($_POST['update-email'])) {
	$email = trim(filter_var($_POST['new-email'], FILTER_SANITIZE_EMAIL));
	$user_id = $_SESSION['logedin']['user_id'];

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$_SESSION['invalid-email'] = "Please provide a valid email!";
		redirect('/delete.php');
	}

	if(empty($email) {
		$_SESSION['empty'] = "Please fill in the empty fields!";
		redirect('/delete.php');
	}

	if($email === $_SESSION['logedin']['email']) {
		$_SESSION['same-email'] = "You already have this mail.";
		redirect('/delete.php');
	}

	$statement = $pdo->prepare('SELECT email FROM users WHERE email = :email;');
	$statement->bindParam(':email', $email, PDO::PARAM_STR);
	$statement->execute();
	$existingEmail = $statement->fetch(PDO::FETCH_ASSOC);

	if($existingEmail['email'] === $email) {
		$_SESSION['taken-email'] = "This email is already registered.";
		redirect('/delete.php');
	}

	$statement = $pdo->prepare('UPDATE users SET email = :email WHERE user_id = :user_id');
	$statement->bindParam(':email', $email, PDO::PARAM_STR);
	$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$statement->execute();
	$_SESSION['updated-email'] = "Your email has been updated!";
	$_SESSION['logedin']['email'] = $email;
}
redirect('/delete.php');
