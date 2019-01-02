<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if (isset($_POST['create-account'])) {
	$fullname = trim(filter_var($_POST['full-name'], FILTER_SANITIZE_STRING));
	$username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
	$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
	$password = $_POST['password'];
	$passwordHash = password_hash($password, PASSWORD_DEFAULT);

	// Validate if form is not provided correctly
	if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$_SESSION['invalid-email'] = "Please provide a valid email!";
		redirect('/create.php');
	}

	if(empty($username) || empty($passwordHash) || empty($fullname)) {
		$_SESSION['empty'] = "Please fill in the required fields!";
		redirect('/create.php');
	}

	// Validate if this account already exists
	$user = $pdo->prepare('SELECT username, email FROM users WHERE username = :username OR email = :email;');
	$user->bindParam(':username', $username, PDO::PARAM_STR);
	$user->bindParam(':email', $email, PDO::PARAM_STR);
	$user->execute();
	$existingAccount = $user->fetch(PDO::FETCH_ASSOC);

	if($existingAccount['username'] === $username) {
		$_SESSION['username-taken'] = "This username is already taken, please try another one.";
		redirect('/create.php');
	}

	if($existingAccount['email'] === $email) {
		$_SESSION['email-taken'] = "This email is already registered.";
		redirect('/create.php');
	}

	// Insert new account into the database
  $user = $pdo->prepare("INSERT INTO users(full_name, username, email, password) VALUES(:fullname, :username, :email, :password);");
	$user->bindParam(':fullname', $fullname, PDO::PARAM_STR);
	$user->bindParam(':username', $username, PDO::PARAM_STR);
	$user->bindParam(':email', $email, PDO::PARAM_STR);
	$user->bindParam(':password', $passwordHash, PDO::PARAM_STR);
	$user->execute();

	$user = $pdo->prepare('SELECT * FROM users WHERE username = :username');
  $user->bindParam(':username', $username, PDO::PARAM_STR);
  $user->execute();
  $user = $user->fetch(PDO::FETCH_ASSOC);

	// If the user successfully created account login the new account directly
	$_SESSION['logedin'] = [
		'user_id' => $user['user_id'],
		'fullname' => $user['full_name'],
		'email' => $user['email'],
		'username' => $user['username'],
		'profile_pic' => $user['profile_pic'],
		'profile_bio' => $user['profile_bio'],
	];

	$user = $pdo->prepare('SELECT * FROM posts WHERE user_id = :user_id;');
	$user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$user->execute();
	$posts = $user->fetchAll(PDO::FETCH_ASSOC);

	$_SESSION['posts'] = $posts;

}
redirect('/');
