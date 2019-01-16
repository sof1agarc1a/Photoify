<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';

// get all posts.
$user_id = $_SESSION['logedin']['user_id'];
$user = $pdo->prepare('SELECT * FROM posts ORDER BY post_created_at DESC;');
$user->execute();
$posts = $user->fetchAll(PDO::FETCH_ASSOC);


require __DIR__.'/views/all_posts.php';
require __DIR__.'/views/footer.php';

?>
