<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if(isset($_POST['post-delete'])) {
	$post_id = $_POST['id'];
	$user_id = $_SESSION['logedin']['user_id'];

	$statement = $pdo->prepare("SELECT post_pic FROM posts WHERE id = :id;");
	$statement->bindParam(':id', $post_id, PDO::PARAM_INT);
	$statement->execute();
	$post_pic = $statement->fetch(PDO::FETCH_ASSOC);

	$postPicName = $post_pic['post_pic'];

	$user = $pdo->prepare('DELETE FROM posts WHERE id = :id');
	$user->bindParam(':id', $post_id, PDO::PARAM_INT);
	$user->execute();

	$dir = __DIR__.'/../../assets/images/uploads/post_pic/';

	if(file_exists($dir.$postPicName)) {
		unlink($dir.$postPicName);
	}

	$user = $pdo->prepare('SELECT * FROM posts WHERE user_id = :user_id;');
	$user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$user->execute();
	$posts = $user->fetchAll(PDO::FETCH_ASSOC);

	$_SESSION['posts'] = $posts;

}

redirect('/');
