<?php
declare(strict_types=1);
require __DIR__.'/../../autoload.php';

if(isset($_POST['delete-profile-pic'])) {
	$user_id = $_SESSION['logedin']['user_id'];

	$statement = $pdo->prepare("SELECT profile_pic FROM users WHERE user_id = :user_id;");
	$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$statement->execute();
	$currentPics = $statement->fetch(PDO::FETCH_ASSOC);
	$currentPic = $currentPics['profile_pic'];

	$dir = __DIR__.'/../../../assets/images/uploads/profile_pic/';

	if(file_exists($dir.$currentPic) && $dir.$currentPic != 'default_picture.jpg') {
		unlink($dir.$currentPic);
	}

	$defaultPic = "default_picture.jpg";

	$_SESSION['logedin']['profile_pic'] = $defaultPic;

	$statement = $pdo->prepare("UPDATE users SET profile_pic = :defaultpic WHERE user_id = :user_id;");
	$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$statement->bindParam(':defaultpic', $defaultPic, PDO::PARAM_STR);
	$statement->execute();
}
redirect('/delete.php');
