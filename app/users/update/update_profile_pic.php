<?php
declare(strict_types=1);
require __DIR__.'/../../autoload.php';

if(isset($_POST['update-profile-pic'])) {

	// $password = $_POST['password'];
	// $username = $_SESSION['logedin']['username'];
	//
	// $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username');
  // $statement->bindParam(':username', $username, PDO::PARAM_STR);
  // $statement->execute();
  // $user = $statement->fetch(PDO::FETCH_ASSOC);
	//
	//
	// // Display login errors
	// if(empty($password)) {
	// 	$_SESSION['empty'] = "Please fill in the password!";
	// 	redirect('/delete.php');
	// }
	//
	// if(!password_verify($password, $user['password'])) {
	// 	$_SESSION['wrong'] = "The password is wrong!";
	// 	redirect('/delete.php');
	// }
	//
	// if(password_verify($password, $user['password'])) {
	// 	$statement = $pdo->prepare('DELETE FROM users WHERE username = :username');
	// 	$statement->bindParam(':username', $username, PDO::PARAM_STR);
	// 	$statement->execute();
	// 	unset($_SESSION['logedin']);
	// };
}

redirect('/');
