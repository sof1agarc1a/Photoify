<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if(!isset($_SESSION['logedin'])):
	redirect('/login.php');
endif;

if(isset($_POST['edit-comment'])) {
	$comment_id = $_POST['comment-id'];
	$content = filter_var($_POST['edit-comment'], FILTER_SANITIZE_STRING);

	$statement = $pdo->prepare('UPDATE comments SET content = :content WHERE id = :comment_id;');
	$statement->bindParam(':content', $content, PDO::PARAM_STR);
	$statement->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
	$statement->execute();

	$statement = $pdo->query("SELECT * FROM comments WHERE id = '$comment_id';");
	$editedComment = $statement->fetch(PDO::FETCH_ASSOC);
  $statement->execute();

	$editedComment = json_encode($editedComment);
	header('Content-Type: application/json');
	echo $editedComment;

}
