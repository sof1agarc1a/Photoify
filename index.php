<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';


// If there is no user logged in redirect to the login page.
if(!isset($_SESSION['logedin'])):
  redirect('/login.php');
endif; ?>

<article>
  <?php if(isset($_SESSION['logedin'])):
		echo "hi " . $_SESSION['logedin']['username'];
  endif; ?>

  <p>This is the home page.</p>
	<p>POSTS:</p>

	<div>
		<?php
		// get all posts.
			$user_id = $_SESSION['logedin']['user_id'];

			$user = $pdo->prepare('SELECT * FROM posts WHERE user_id = :user_id ORDER BY post_created_at DESC;');
		  $user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		  $user->execute();
		  $posts = $user->fetchAll(PDO::FETCH_ASSOC);


			foreach($posts as $post): ?>

				<img width="200px" height="200px" src="<?= '/assets/images/uploads/post_pic/'.$post['post_pic']; ?>" alt="post picture">

				<?php
				echo "<br>".$post['post_created_at']."<br>";
				echo $post['description']."<br>";

				?>
				<form action="/app/posts/delete.php" method="post">
					<div>
						<label for=""> Delete post </label>
						<input type="hidden" name="id" value="<?= $post['id']; ?>" >
						<button type="submit" name="post-delete"> Delete </button>
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


				<form class="likes" method="post" >
					<label for=""> Like </label>
					<input type="hidden" name="id" value="<?= $post['id']; ?>">
					<button type="submit"> Like </button>
				</form>

				<p> <?= $post['likes']. " likes"; ?> </p>

				<?php
				$post_id = $post['id'];
				$user = $pdo->prepare('SELECT * FROM comments WHERE post_id = :post_id;');
			  $user->bindParam(':post_id', $post_id, PDO::PARAM_INT);
			  $user->execute();
			  $comments = $user->fetchAll(PDO::FETCH_ASSOC); ?>

				<div id="add-comment-<?= $post['id']; ?>">
					<?php foreach($comments as $comment): ?>
						<p id="edit-delete-comment-<?= $comment['id']; ?>"> <?= $comment['username'].": ".$comment['content']; ?> </p>
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
					<?php endforeach; ?>
				</div>

				<form class="comments" method="post">
					<label for=""> <?= $_SESSION['logedin']['username']; ?> </label>
					<input type="hidden" name="id" value="<?= $post['id']; ?>">
					<input type="text" name="new-comment" placeholder="Add a comment... " required>
					<button type="submit"> Public </button>
				</form>
				<?php
			endforeach;
	 ?>
	</div>

	<script type="text/javascript" src="app/posts/likes.js"> </script>
	<script type="text/javascript" src="app/posts/comments.js"> </script>
	<script type="text/javascript" src="app/posts/edit_comment.js"> </script>
	<script type="text/javascript" src="app/posts/delete_comment.js"> </script>



<?php require __DIR__.'/views/footer.php'; ?>
