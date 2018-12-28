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

	// $statement = $pdo->prepare('SELECT * FROM posts WHERE user_id = :user_id');
  // $statement->bindParam(':user_id', $user['user_id'], PDO::PARAM_STR);
  // $statement->execute();
  // $post = $statement->fetch(PDO::FETCH_ASSOC);
	//
	// $statement = $pdo->prepare('SELECT * FROM likes WHERE user_id = :user_id');
  // $statement->bindParam(':user_id', $user['user_id'], PDO::PARAM_INT);
  // $statement->execute();
  // $likes = $statement->fetch(PDO::FETCH_ASSOC);
	//
	// $statement = $pdo->prepare('SELECT * FROM comments WHERE user_id = :user_id');
  // $statement->bindParam(':user_id', $user['user_id'], PDO::PARAM_INT);
  // $statement->execute();
  // $comment = $statement->fetch(PDO::FETCH_ASSOC);

	// If the user successfully created account login the new account directly
	$_SESSION['logedin'] = [
		'user_id' => $user['user_id'],
		'fullname' => $user['full_name'],
		'email' => $user['email'],
		'username' => $user['username'],
		'profile_pic' => $user['profile_pic'],
		'profile_bio' => $user['profile_bio'],
	];

	// $_SESSION['store'] = [
	// 	'post_id' => $post['post_id'],
	// 	'post_pic' => $post['post_pic'],
	// 	'description' => $post['description'],
	// 	'user_id' => $post['user_id'],
	// 	'post_created_at' => $post['post_created_at'],
	//
	// 	'like_id' => $likes['id'],
	// 	'likes_post_id' => $likes['post_id'],
	// 	'likes' => $likes['likes'],
	// 	'dislikes' => $likes['dislikes'],
	//
	// 	'comment_id' => $comment['id'],
	// 	'comment_user_id' => $comment['user_id'],
	// 	'comment_post_id' => $comment['post_id'],
	// 	'content' => $comment['content'],
	// 	'comment_created_at' => $comment['created_at'],
	// ];

}
redirect('/');
