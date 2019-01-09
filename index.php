<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';

// If there is no user logged in redirect to the login page.
if(!isset($_SESSION['logedin'])):
  redirect('/login.php');
endif; ?>

<article>
  <h1><?php echo $config['title']; ?></h1>
  <?php if(isset($_SESSION['logedin'])):
		echo "hi " . $_SESSION['logedin']['username'];
  endif; ?>

  <p>This is the home page.</p>
	<p>POSTS:</p>

	<div>
		<?php

	if(isset($_SESSION['posts'])):

		$posts = $_SESSION['posts'];

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
					<div>
						<label for=""> Like </label>
						<input type="hidden" name="id" value="<?= $post['id']; ?>">
						<button type="submit"> Like </button>

					</div>
				</form>

				<p> <?= $post['likes']. " likes"; ?> </p>

				<form class="comments" method="post">
					<div>
						<label for=""> <?= $_SESSION['logedin']['username']; ?> </label>
						<input type="hidden" name="id" value="<?= $post['id']; ?>">
						<input type="text" name="new-comment" placeholder="Add a comment... " required>
						<button type="submit"> Public </button>

					</div>
				</form>

				<p>  </p>

				<!-- <p> <?= $post['likes']. " likes"; ?> </p> -->

					<!-- <p> <?= $_SESSION['logedin']['username']; ?> </p> -->

					<?php
			endforeach;
		endif;
	 ?>
	</div>

	<script type="text/javascript" src="app/posts/likes.js"> </script>
	<script type="text/javascript" src="app/posts/comments.js"> </script>

<?php require __DIR__.'/views/footer.php'; ?>
