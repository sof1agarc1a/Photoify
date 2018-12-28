<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if(isset($_POST['post-delete'])) {
		$post_id = $post['id'];
		$user_id = $_SESSION['logedin']['user_id'];

		$statement = $pdo->prepare("SELECT post_pic FROM posts WHERE id = :id;");
		$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$statement->bindParam(':id', $post_id, PDO::PARAM_INT);
		$statement->execute();
		$currentPost = $statement->fetch(PDO::FETCH_ASSOC);

		echo $currentPost;
		// $dir = __DIR__.'/../../assets/images/uploads/post_pic/';
		//
		// if(file_exists($dir.$currentPost)) {
		// 	unlink($dir.$currentPost);
		// }
		//
		// $defaultPic = "default_picture.jpg";
		//
		// $_SESSION['logedin']['profile_pic'] = $defaultPic;
		//
		// $statement = $pdo->prepare("UPDATE users SET profile_pic = :defaultpic WHERE user_id = :user_id;");
		// $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		// $statement->bindParam(':defaultpic', $defaultPic, PDO::PARAM_STR);
		// $statement->execute();
		//
		//
		// if(!in_array($dir.$currentPic, ['default_picture.jpg']) {
		// 	unlink($dir.$currentPic);
		// }
		//
		// $statement = $pdo->prepare('DELETE FROM users WHERE user_id = :user_id;');
		// $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		// $statement->execute();
		//
		// unset($_SESSION['logedin']);

}


// redirect('/');
