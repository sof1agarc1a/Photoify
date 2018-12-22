<?php
declare(strict_types=1);
require __DIR__.'/../../autoload.php';

if(isset($_POST['update-profile-pic'])) {
	$profilePic = $_FILES['new-profile-pic'];
	$user_id = $_SESSION['logedin']['user_id'];

	if($profilePic['size'] > 2500000) {
		$_SESSION['pic-size'] = "The uploaded file exceeded the file size limit.";
		redirect('/delete.php');
	}

	if(!in_array($profilePic['type'], ['image/jpeg', 'image/png', 'image/gif'])) {
		$_SESSION['pic-type'] = "The image file type is not allowed.";
		redirect('/delete.php');
	}

	$statement = $pdo->prepare("SELECT profile_pic FROM users WHERE user_id = :user_id;");
	$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$statement->execute();
	$currentPics = $statement->fetch(PDO::FETCH_ASSOC);
	$currentPic = $currentPics['profile_pic'];
	$profileName = $profilePic['name'];
	$dir = __DIR__.'/../../../assets/images/uploads/profile_pic/';
	$filename = "$user_id.profile_pic_$profileName";
	move_uploaded_file($profilePic['tmp_name'], $dir.$filename);

	$_SESSION['logedin']['profile_pic'] = $filename;

	$statement = $pdo->prepare("UPDATE users SET profile_pic = :filename WHERE user_id = :user_id;");
	$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$statement->bindParam(':filename', $filename, PDO::PARAM_STR);
	$statement->execute();
}
redirect('/delete.php');
