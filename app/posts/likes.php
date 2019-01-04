<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if(isset($_POST['id'])) {
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
	$statement = $pdo->query("SELECT COUNT(*) AS likes FROM likes WHERE post_id = '$post_id';");

	$likes = $statement->fetchAll(PDO::FETCH_ASSOC);



	$likes = json_encode($likes);
	header('Content-Type: application/json');
	// $_SESSION['posts'] = $likes;
	echo $likes;



	// $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	// $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
	// $statement->execute();
	//
	// $statement = $pdo->query("SELECT COUNT(*) AS likes FROM likes WHERE post_id = '$post_id';");
	//
	//
	// $likes = $statement->fetchAll(PDO::FETCH_ASSOC);
	//
	// $likes = json_encode($likes);
	// header('Content-Type: application/json');
	// echo $likes;




	// $_SESSION['posts'] = $likes;

	//
	// //Recieved request
	// $request = json_decode(file_get_contents('likes.php'));
	//
	// //Fetch likes
	// $fetch_query = 'SELECT likes FROM posts WHERE posts.id = :id';
	// $params = [
	//     ':id' => $request->id,
	// ];
	//
	// $response = $database->getData($fetch_query, $params);
	//
	// //Update
	// $insert_query = 'UPDATE posts SET likes = :likes WHERE posts.id = :id';
	// $params = [
	//     ':likes' => $response[0]['likes'] + $request->likes,
	//     ':id' => $request->id,
	// ];
	//
	// $database->setData($insert_query, $params);



}

// redirect('/');
