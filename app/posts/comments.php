<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if(isset($_POST['new-comment'])) {
	$post_id = $_POST['id'];
	$user_id = $_SESSION['logedin']['user_id'];
	$content = $_POST['new-comment'];
	$username = $_SESSION['logedin']['username'];

	$statement = $pdo->prepare('INSERT INTO comments(user_id, post_id, content, username) VALUES(:user_id, :post_id, :content, :username);');
	$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
	$statement->bindParam(':content', $content, PDO::PARAM_STR);
	$statement->bindParam(':username', $username, PDO::PARAM_STR);

	$statement->execute();


	$statement = $pdo->query("SELECT * FROM comments WHERE post_id = '$post_id';");


	$comments = $statement->fetchAll(PDO::FETCH_ASSOC);

  $statement->execute();

	$comments = json_encode(end($comments));
	header('Content-Type: application/json');
	echo $comments;

}
