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
		$dir = __DIR__.'/../../assets/images/uploads/profile_pic/';
		if(!in_array($dir.$currentPic, ['default_picture.jpg']) {
			unlink($dir.$currentPic);
		}

		$statement = $pdo->prepare('DELETE FROM users WHERE user_id = :user_id;');
		$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$statement->execute();

		unset($_SESSION['logedin']);
	};
}

redirect('/');
