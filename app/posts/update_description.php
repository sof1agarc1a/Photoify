<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if (!isset($_SESSION['logedin'])):
    redirect('/login.php');
endif;

if (isset($_POST['description-update'])) {
    $post_id = $_POST['id'];
    $newDescription = filter_var($_POST['new-description'], FILTER_SANITIZE_STRING);
    $user_id = $_SESSION['logedin']['user_id'];

    $statement = $pdo->prepare("UPDATE posts SET description = :new_description WHERE id = :id;");
    $statement->bindParam(':new_description', $newDescription, PDO::PARAM_STR);
    $statement->bindParam(':id', $post_id, PDO::PARAM_INT);
    $statement->execute();
}
redirect('/');
