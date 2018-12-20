<?php

declare(strict_types=1);
require __DIR__.'/../autoload.php';

if (isset($_POST['create-account'])) {

		$fullname = trim(filter_var($_POST['full-name'], FILTER_SANITIZE_STRING));
		$username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
		$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
		$password = $_POST['password'];
		$passwordHash = password_hash($password, PASSWORD_DEFAULT);


		/* Validate if form is not provided correctly */
		if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$_SESSION['invalid-email'] = "Please provide a valid email!";
			redirect('/create.php');
		}

		if(empty($username) || empty($passwordHash) || empty($fullname)) {
			$_SESSION['empty'] = "Please fill in the required fields!";
			redirect('/create.php');
		}

		/* Validate if this account already exists */
		$statement = $pdo->prepare('SELECT username, email FROM users WHERE username = :username OR email = :email;');
		$statement->bindParam(':username', $username, PDO::PARAM_STR);
		$statement->bindParam(':email', $email, PDO::PARAM_STR);
		$statement->execute();
		$existingAccount = $statement->fetch(PDO::FETCH_ASSOC);

		if($existingAccount['username'] === $username) {
			$_SESSION['username-taken'] = "This username is already taken, please try another one.";
			redirect('/create.php');
		}

		if($existingAccount['email'] === $email) {
			$_SESSION['email-taken'] = "This email is already registered.";
			redirect('/create.php');
		}


		/* Insert new account into the database */

    $statement = $pdo->prepare("INSERT INTO users(full_name, username, email, password) VALUES(:fullname, :username, :email, :password);");

		$statement->bindParam(':fullname', $fullname, PDO::PARAM_STR);
		$statement->bindParam(':username', $username, PDO::PARAM_STR);
		$statement->bindParam(':email', $email, PDO::PARAM_STR);
		$statement->bindParam(':password', $passwordHash, PDO::PARAM_STR);


		/* If the user successfully created account login the new account directly */
    $statement->execute();
		$_SESSION['user'] = "Hi " . $user['full_name'] . "!";










}

redirect('/');
