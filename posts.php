<?php require __DIR__.'/views/header.php';?>

<form action="/app/posts/store.php" method="post" enctype="multipart/form-data">
	<div>
		<label for="upload-image"> Upload image</label>
		<input type="file" accept=".gif, .jpeg, .jpg, .png" name="upload-image" required>

		<label for="upload-description"> Add description</label>
		<input type="text" name="upload-description" required>

		<button type="submit" name="post-upload"> Upload </button>
	</div>
</form>

<?php require __DIR__.'/views/footer.php';?>
