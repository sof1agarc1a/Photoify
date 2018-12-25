<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if(isset($_POST['username'], $_POST['password'])) {
  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$password = $_POST['password'];

	// Look if username exists in the database
  $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username');
  $statement->bindParam(':username', $username, PDO::PARAM_STR);
  $statement->execute();
  $user = $statement->fetch(PDO::FETCH_ASSOC);

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
				'fullname' => $user['full_name'],
				'email' => $user['email'],
				'username' => $user['username'],
				'profile_pic' => $user['profile_pic'],
				'profile_bio' => $user['profile_bio'],
		];

		$user_id = $_SESSION['logedin']['user_id'];

		$statement = $pdo->prepare('SELECT * FROM posts WHERE user_id = :user_id;');
	  $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	  $statement->execute();
	  $post = $statement->fetch(PDO::FETCH_ASSOC);

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
		//
		//
		// ];
  };
}
redirect('/');
