<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if(isset($_POST['delete-account'])) {

	$password = $_POST['password'];
	$user_id = $_SESSION['logedin']['user_id'];

	$statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id;');
  $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $statement->execute();
  $user = $statement->fetch(PDO::FETCH_ASSOC);


	// Display login errors
	if(empty($password)) {
		$_SESSION['empty'] = "Please fill in the password!";
		redirect('/delete.php');
	}

	if(!password_verify($password, $user['password'])) {
		$_SESSION['wrong'] = "The password is wrong!";
		redirect('/delete.php');
	}

	if(password_verify($password, $user['password'])) {

		$statement = $pdo->prepare('SELECT profile_pic FROM users WHERE user_id = :user_id;');
		$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$statement->execute();
		$currentPics = $statement->fetch(PDO::FETCH_ASSOC);

		$currentPic = $currentPics['profile_pic'];
		$profileDir = __DIR__.'/../../assets/images/uploads/profile_pic/';

		if($currentPic !== 'default_picture.jpg') {
			unlink($profileDir.$currentPic);
		}

		$statement = $pdo->prepare('SELECT post_pic FROM posts WHERE user_id = :user_id;');
		$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$statement->execute();
		$currentPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

		$postDir = __DIR__.'/../../assets/images/uploads/post_pic/';

		foreach($currentPosts as $currentPost){
			unlink($postDir.$currentPost['post_pic']);
		}

		$statement = $pdo->prepare('DELETE FROM posts WHERE user_id = :user_id;');
		$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$statement->execute();

		$statement = $pdo->prepare('DELETE FROM users WHERE user_id = :user_id;');
		$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$statement->execute();

		$statement = $pdo->prepare('DELETE FROM comments WHERE user_id = :user_id;');
		$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$statement->execute();

		$statement = $pdo->prepare('DELETE FROM likes WHERE user_id = :user_id;');
		$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$statement->execute();

		unset($_SESSION['logedin']);
	};
}

redirect('/');
