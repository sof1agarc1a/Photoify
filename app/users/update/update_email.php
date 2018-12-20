<?php
declare(strict_types=1);
require __DIR__.'/../../autoload.php';

if(isset($_POST['update-email'])) {
	$newemail = filter_var($_POST['new-email'], FILTER_SANITIZE_EMAIL);
	$user_id = $_SESSION['logedin']['user_id'];

	if(!filter_var($newemail, FILTER_VALIDATE_EMAIL)) {
		$_SESSION['invalid-email'] = "Please provide a valid email!";
		redirect('/delete.php');
	}

	if($newemail === $_SESSION['logedin']['email']) {
		$_SESSION['same-email'] = "You already have this mail.";
		redirect('/delete.php');
	}

	$statement = $pdo->prepare('SELECT email FROM users WHERE email = :email;');
	$statement->bindParam(':email', $newemail, PDO::PARAM_STR);
	$statement->execute();
	$existingEmail = $statement->fetch(PDO::FETCH_ASSOC);


	if($existingEmail['email'] === $newemail) {
		$_SESSION['taken-email'] = "This email is already registered.";
		redirect('/delete.php');
	}

	$statement = $pdo->prepare('UPDATE users SET email = :email WHERE user_id = :user_id');
	$statement->bindParam(':email', $newemail, PDO::PARAM_STR);
	$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$statement->execute();
	$_SESSION['updated-email'] = "Your email has been updated!";
	$_SESSION['logedin']['email'] = $newemail;

}

redirect('/delete.php');
