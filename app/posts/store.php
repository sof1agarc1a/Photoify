<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if(isset($_POST['post-upload'])) {

	$description = filter_var($_POST['upload-description'], FILTER_SANITIZE_STRING);
	$postPic = $_FILES['upload-image'];
	$user_id = $_SESSION['logedin']['user_id'];
	$username = $_SESSION['logedin']['username'];

	if($postPic['size'] > 2500000) {
		$_SESSION['pic-size'] = "The uploaded file exceeded the file size limit.";
		redirect('/');
	}

	if(!in_array($postPic['type'], ['image/jpeg', 'image/png', 'image/gif'])) {
		$_SESSION['pic-type'] = "The image file type is not allowed.";
		redirect('/');
	}

	$dir = __DIR__.'/../../assets/images/uploads/post_pic/';

	$postPicName = $postPic['name'];
	$filename = "$user_id.post_$postPicName";
	move_uploaded_file($postPic['tmp_name'], $dir.$filename);

	$user = $pdo->prepare('INSERT INTO posts (post_pic, description, user_id, username) VALUES(:post_pic, :description, :user_id, :username);');
	$user->bindParam(':post_pic', $filename, PDO::PARAM_STR);
	$user->bindParam(':description', $description, PDO::PARAM_STR);
	$user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$user->bindParam(':username', $username, PDO::PARAM_STR);
	$user->execute();

	$user = $pdo->prepare('SELECT * FROM posts WHERE user_id = :user_id;');
  $user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $user->execute();
  $posts = $user->fetchAll(PDO::FETCH_ASSOC);

	foreach($posts as $post) {

	 $posts = [
			[
			'post_id' => $post['post_id'],
			'post_pic' => $post['post_pic'],
			'description' => $post['description'],
			'username' => $post['username'],
			'user_id' => $post['user_id'],
			'post_created_at' => $post['post_created_at']
			]
		];

	}

	$_SESSION['posts'] = $posts;


}
redirect('/');
