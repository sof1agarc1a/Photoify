<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if(isset($_POST['liked'])) {
	$post_id = $_POST['id'];
	$user_id = $_SESSION['logedin']['user_id'];

	// gets likes from post.
	$statement = $pdo->prepare('SELECT * FROM posts WHERE id = :id;');
	$statement->bindParam(':id', $post_id, PDO::PARAM_INT);
	$statement->execute();
	$posts = $statement->fetch(PDO::FETCH_ASSOC);
	$likes = $posts['likes'];

	// looks if this post is already liked.
	$statement = $pdo->prepare('SELECT * FROM likes WHERE user_id = :user_id AND post_id = :post_id;');
	$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
	$statement->execute();
	$postLiked = $statement->fetch(PDO::FETCH_ASSOC);

	// if the post is liked, it gets unliked.
	if($postLiked['user_id'] === strval($user_id) && $postLiked['post_id'] === strval($post_id)) {
		$statement = $pdo->prepare('DELETE FROM likes WHERE user_id = :user_id AND post_id = :post_id;');
		$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
		$statement->execute();

		$statement = $pdo->prepare('UPDATE posts SET likes = :likes-1 WHERE id = :id;');
		$statement->bindParam(':likes', $likes, PDO::PARAM_INT);
		$statement->bindParam(':id', $post_id, PDO::PARAM_INT);
		$statement->execute();

	} else {
		// if the post isn't liked, it gets liked.
		$statement = $pdo->prepare('INSERT INTO likes(user_id, post_id) VALUES(:user_id, :post_id);');
		$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
		$statement->execute();

		$statement = $pdo->prepare('UPDATE posts SET likes = :likes+1 WHERE id = :id;');
		$statement->bindParam(':likes', $likes, PDO::PARAM_INT);
		$statement->bindParam(':id', $post_id, PDO::PARAM_INT);
		$statement->execute();
	}

	$user = $pdo->prepare('SELECT * FROM posts WHERE user_id = :user_id;');
	$user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$user->execute();
	$posts = $user->fetchAll(PDO::FETCH_ASSOC);

	$_SESSION['posts'] = $posts;

}

redirect('/');


// if(isset($_POST['disliked'])) {
// 	$post_id = $_POST['id'];
// 	$user_id = $_SESSION['logedin']['user_id'];
//
//
// 	$statement = $pdo->prepare('SELECT * FROM posts WHERE id = :id;');
// 	$statement->bindParam(':id', $post_id, PDO::PARAM_INT);
// 	$statement->execute();
// 	$posts = $statement->fetch(PDO::FETCH_ASSOC);
// 	$likes = $posts['likes'];
//
// 	$statement = $pdo->prepare('INSERT INTO likes(user_id, post_id) VALUES(:user_id, :id);');
// 	$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
// 	$statement->bindParam(':id', $post_id, PDO::PARAM_INT);
// 	$statement->execute();
// 	// $posts = $user->fetch(PDO::FETCH_ASSOC);
//
// 	$statement = $pdo->prepare('UPDATE posts SET dislikes = :likes+1 WHERE id = :id;');
// 	$statement->bindParam(':likes', $likes, PDO::PARAM_INT);
// 	$statement->bindParam(':id', $post_id, PDO::PARAM_INT);
// 	$statement->execute();
//
// 	$user = $pdo->prepare('SELECT * FROM posts WHERE user_id = :user_id;');
// 	$user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
// 	$user->execute();
// 	$posts = $user->fetchAll(PDO::FETCH_ASSOC);
//
// 	$_SESSION['posts'] = $posts;
//
// }
