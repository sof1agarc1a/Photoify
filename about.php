<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';

// get user posts.
$user_id = $_SESSION['logedin']['user_id'];
$user = $pdo->prepare('SELECT * FROM posts WHERE user_id = :user_id ORDER BY post_created_at DESC;');
$user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$user->execute();
$posts = $user->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- <p> bio: </p> -->
<div class="margin-top-biography">
	<div class="bio-container">
		<a href="delete.php"><i class="fas fa-cogs color-fa-cogs"></i></a>
		<img class="my-page-profile-pic" src="<?= '/assets/images/uploads/profile_pic/'.$_SESSION['logedin']['profile_pic'] ?>" alt="profile picture">
		<div class="bio-text-container">
			<div>
				<p class="my-page-bio"> <?= $_SESSION['logedin']['username']; ?> </p>
			</div>
			<div>
				<p class="bio-weight"> <?= $_SESSION['logedin']['profile_bio']; ?> </p>
			</div>

			<!-- <div>
				<p> Follow </p>
			</div>
			<div>
				<p> <?= $_SESSION['logedin']['profile_bio']; ?> </p>
			</div> -->
		</div>
	</div>
</div>

<?php
require __DIR__.'/views/all_posts.php';
require __DIR__.'/views/footer.php'; ?>
