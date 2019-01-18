<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if(isset($_POST['username'], $_POST['password'])) {
  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$password = $_POST['password'];

	// Look if username exists in the database
  $user = $pdo->prepare('SELECT * FROM users WHERE username = :username');
  $user->bindParam(':username', $username, PDO::PARAM_STR);
  $user->execute();
  $user = $user->fetch(PDO::FETCH_ASSOC);

	// Display login errors
	if(empty($username) || empty($password)) {
		$_SESSION['empty'] = "Please fill in the required fields!";
		redirect('/login.php');
	}

  if(!$user || !password_verify($password, $user['password'])) {
      $_SESSION['wrong'] = "Wrong email or password!";
      redirect('/login.php');
  }
	// Verify the user password and log in
  if(password_verify($password, $user['password'])) {
		$_SESSION['logedin'] = [
			'user_id' => $user['user_id'],
			'email' => $user['email'],
			'username' => $user['username'],
			'profile_pic' => $user['profile_pic'],
			'profile_bio' => $user['profile_bio'],
		];
  };
}
redirect('/');
