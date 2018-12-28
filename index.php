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
				echo $post['id']."<br>";

				?>
				<form action="/app/posts/update.php" method="post">
					<div>
						<label for=""> Edit description </label>
						<input type="text" name="update-description" required>
						<button type="submit" name="post-update"> Update </button>
					</div>
				</form>

				<form action="/app/posts/delete.php" method="post">
					<div>
						<label for=""> Delete post </label>
						<!-- <input type="text" name="delete-description" required> -->
						<button type="submit" name="post-delete"> Delete </button>
					</div>
				</form> <?php
			endforeach;
		endif;
	 ?>
	</div>

<?php require __DIR__.'/views/footer.php'; ?>
