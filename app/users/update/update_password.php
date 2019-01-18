<?php
declare(strict_types=1);
require __DIR__.'/../../autoload.php';

if(!isset($_SESSION['logedin'])):
	redirect('/login.php');
endif;

if(isset($_POST['update-password'])) {
	$oldPassword = $_POST['old-password'];
	$newPassword = $_POST['new-password'];
	$newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
	$user_id = $_SESSION['logedin']['user_id'];

	$statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');
  $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $statement->execute();
  $user = $statement->fetch(PDO::FETCH_ASSOC);

	// Display login errors
	if(empty($oldPassword) || empty($newPassword)) {
		$_SESSION['empty-password'] = "Please fill in the empty fields!";
		redirect('/delete.php');
	}

	if(!password_verify($oldPassword, $user['password'])) {
		$_SESSION['wrong-password'] = "The password is wrong!";
		redirect('/delete.php');
	} else {
		$statement = $pdo->prepare('UPDATE users SET password = :password WHERE user_id = :user_id');
		$statement->bindParam(':password', $newPasswordHash, PDO::PARAM_STR);
		$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$statement->execute();
		$_SESSION['password-updated'] = "Your password has been updated!";
	};
}
redirect('/delete.php');
