<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';

// If there is no user logged in redirect to the login page.
if(!isset($_SESSION['logedin'])):
  redirect('/login.php');
endif;

// get all posts.
$user_id = $_SESSION['logedin']['user_id'];
$user = $pdo->prepare('SELECT * FROM posts ORDER BY post_created_at DESC;');
// $user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$user->execute();
$posts = $user->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- <p> MODE: </p> -->
<article class="margin-top">
	<div class="logedin-article">
		<?php	foreach($posts as $post): ?>
			<div class="each-post">
			<img class="posted-image" src="<?= '/assets/images/uploads/post_pic/'.$post['post_pic']; ?>" alt="post picture">

			<div class="comments-container">
				<div class="likes-container">
					<form class="likes" method="post" >
						<input type="hidden" name="id" value="<?= $post['id']; ?>">
						<button class="likes-heart" type="submit"><i class="far fa-heart"></i></button>
						<!-- <i class="fas fa-heart"></i> -->
					</form>
					<p class="number-likes"> <?= $post['likes']. " likes"; ?> </p>
				</div>

				<?php if($post['user_id'] === $user_id): ?>
					<div class="dots">
						<div class="dot"> </div>
						<div class="dot"> </div>
						<div class="dot"> </div>
					</div>
				<?php endif; ?>

					<p class="time">
					<?= "<br>".$post['post_created_at']."<br>"; ?>
					</p>

					<div class="description-container">
					<?php
					echo "<br>".$post['username']."<br>";
					// echo "<br>".$post['profile_pic']."<br>";
					echo "<br>".$post['description']."<br>";
					echo "<br>".$post['post_created_at']."<br>";

					?>
				</div>
					<?php if($post['user_id'] === $user_id): ?>

			<form class="" action="/app/posts/delete.php" method="post">
				<div>
					<label for=""> Delete post </label>
					<input type="hidden" name="id" value="<?= $post['id']; ?>" >
					<button type="submit" name="post-delete"><i class="fas fa-trash-alt"></i></button>
				</div>
			</form>

			<form action="/app/posts/update_description.php" method="post">
				<div>
					<label for=""> Edit description </label>
					<input type="text" name="new-description" required>
					<input type="hidden" name="id" value="<?= $post['id']; ?>" >
					<button type="submit" name="description-update"> Update description </button>
				</div>
			</form>

		<?php endif; ?>

			<?php
			$post_id = $post['id'];
			$user = $pdo->prepare('SELECT * FROM comments WHERE post_id = :post_id;');
		  $user->bindParam(':post_id', $post_id, PDO::PARAM_INT);
		  $user->execute();
		  $comments = $user->fetchAll(PDO::FETCH_ASSOC);
			?>

			<div id="add-comment-<?= $post['id']; ?>">
				<?php foreach($comments as $comment): ?>
					<p id="edit-delete-comment-<?= $comment['id']; ?>"> <?= $comment['username'].": ".$comment['content']; ?></p>
					<?php if($comment['user_id'] === $user_id): ?>
						<i class="fas fa-edit"></i>
					<div>
						<form class="edit-comment" id="edit-delete-form-<?= $comment['id']; ?>" method="post">
							<input type="hidden" name="comment-id" value="<?= $comment['id']; ?>">
							<input type="text" name="edit-comment" required>
							<button type="submit"> Edit </button>
						</form>
					</div>
					<div>
						<form class="delete-comment" id="edit-delete-form-<?= $comment['id']; ?>" method="post">
							<input type="hidden" name="delete-comment-id" value="<?= $comment['id']; ?>">
							<button type="submit"> Delete comment </button>
						</form>
					</div>
				<?php endif;
				endforeach; ?>
			</div>

			<form class="comments" method="post">
				<label for=""> <?= $_SESSION['logedin']['username']; ?> </label>
				<input type="hidden" name="id" value="<?= $post['id']; ?>">
				<input type="text" name="new-comment" placeholder="Add a comment... " required>
				<button type="submit"> Public </button>
			</form>
		</div>
	</div>
			<?php
		endforeach;
	 ?>
	</div>

	<script type="text/javascript" src="app/posts/likes.js"> </script>
	<script type="text/javascript" src="app/posts/comments.js"> </script>
	<script type="text/javascript" src="app/posts/edit_comment.js"> </script>
	<script type="text/javascript" src="app/posts/delete_comment.js"> </script>



<?php require __DIR__.'/views/footer.php'; ?>
