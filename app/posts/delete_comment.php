<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if (!isset($_SESSION['logedin'])):
    redirect('/login.php');
endif;

if (isset($_POST['delete-comment-id'])) {
    $comment_id = $_POST['delete-comment-id'];

    $statement = $pdo->query("SELECT * FROM comments WHERE id = '$comment_id';");
    $deletedComment = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->execute();

    $deletedComment = json_encode($deletedComment);
    header('Content-Type: application/json');
    echo $deletedComment;

    $statement = $pdo->prepare('DELETE FROM comments WHERE id = :comment_id;');
    $statement->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
    $statement->execute();
}
