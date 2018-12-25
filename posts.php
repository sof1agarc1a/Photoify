<?php require __DIR__.'/views/header.php';?>

<form action="/app/posts/store.php" method="post" enctype="multipart/form-data">
	<div>
		<label for="upload-image"> Upload image</label>
		<input type="file" accept=".gif, .jpeg, .png" name="upload-image" required>

		<label for="upload-description"> Add description</label>
		<input type="text" name="upload-description" required>

		<button type="submit" name="post-upload"> Upload </button>
	</div>
</form>

<div>
	<?php if(isset($_SESSION['store']['post_pic'])): ?>
		<img alt="#" src="<?= '/assets/images/uploads/post_pic/'.$_SESSION['store']['post_pic'];?>">
		<?php
		echo $_SESSION['store']['description'];
	endif; ?>
</div>

<?php require __DIR__.'/views/footer.php';?>
