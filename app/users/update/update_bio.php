<?php
declare(strict_types=1);
require __DIR__.'/../../autoload.php';

if (!isset($_SESSION['logedin'])):
    redirect('/login.php');
endif;

if (isset($_POST['update-bio'])) {
    $bio = filter_var($_POST['new-bio'], FILTER_SANITIZE_STRING);
    $user_id = $_SESSION['logedin']['user_id'];

    $statement = $pdo->prepare('UPDATE users SET profile_bio = :profile_bio WHERE user_id = :user_id');
    $statement->bindParam(':profile_bio', $bio, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();
    $_SESSION['logedin']['profile_bio'] = $bio;
}
redirect('/delete.php');
