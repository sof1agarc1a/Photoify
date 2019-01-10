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

	$user = $pdo->prepare('DELETE FROM likes WHERE post_id = :id');
	$user->bindParam(':id', $post_id, PDO::PARAM_INT);
	$user->execute();

	$dir = __DIR__.'/../../assets/images/uploads/post_pic/';

	if(file_exists($dir.$postPicName)) {
		unlink($dir.$postPicName);
	}
}

redirect('/');
