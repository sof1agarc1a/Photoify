<?php
declare(strict_types=1);
require __DIR__.'/../../autoload.php';

if(isset($_POST['update-profile-pic'])) {
	$profilePic = $_FILES['new-profile-pic'];
	$user_id = $_SESSION['logedin']['user_id'];

	if($profilePic['size'] > 2500000) {
		$_SESSION['pic-size'] = "The uploaded file exceeded the file size limit.";
		redirect('/delete.php')
	}	elseif($profilePic['type'] !== 'image/png', 'image/jpeg', 'image/gif') {
			$_SESSION['pic-type'] = "The image file type is not allowed.";
			redirect('/delete.php')
	}

	//select profile db
	//default image here

	$profileName= $profilePic['name'];
	$filename = "profile_pic_$user_id.$profileName";
	$dir = __DIR__.'/../../../assets/images/uploads/profile_pic/'.$filename;
	move_uploaded_file($profilePic['tmp_name'], $dir);

	//UPDATE profile db


	}


	//
	// $profilePic = filter_var($_POST['new-profile-pic'], FILTER_SANITIZE_STRING);
	// $user_id = $_SESSION['logedin']['user_id'];
	//
	// if(!filter_var($profilePic, FILTER_VALIDATE_EMAIL)) {
	// 	$_SESSION['invalid-email'] = "Please provide a valid email!";
	// 	redirect('/delete.php');
	// }
	//
	// if($profilePic === $_SESSION['logedin']['email']) {
	// 	$_SESSION['same-email'] = "You already have this mail.";
	// 	redirect('/delete.php');
	// }
	//
	// $statement = $pdo->prepare('SELECT email FROM users WHERE email = :email;');
	// $statement->bindParam(':email', $profilePic, PDO::PARAM_STR);
	// $statement->execute();
	// $existingEmail = $statement->fetch(PDO::FETCH_ASSOC);
	//
	// if($existingEmail['email'] === $profilePic) {
	// 	$_SESSION['taken-email'] = "This email is already registered.";
	// 	redirect('/delete.php');
	// }
	//
	// $statement = $pdo->prepare('UPDATE users SET email = :email WHERE user_id = :user_id');
	// $statement->bindParam(':email', $profilePic, PDO::PARAM_STR);
	// $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	// $statement->execute();
	// $_SESSION['updated-email'] = "Your email has been updated!";
	// $_SESSION['logedin']['email'] = $profilePic;
}
redirect('/delete.php');
