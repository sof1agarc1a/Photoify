<?php require __DIR__.'/views/header.php';?>
<div class="add-post-container">
	<form action="/app/posts/store.php" method="post" enctype="multipart/form-data">
		<div>
			<label class="preview-post-pic-label" for="file-input">
				<p class="add-post-text">add image</p>
				<div class="preview-pic preview-post-pic-label">
					<img class="preview-post-pic" src="http://www.futurepositivestudio.com/wp-content/uploads/2015/10/BL-Cold-Brew-Instagram-grid-2.jpg" alt="profile picture">
				</div>
			</label>
			<input id="file-input" class="post-input-file" type="file" accept=".gif, .jpeg, .jpg, .png" name="upload-image" onchange="handleFiles(this.files)" required>
		</div>
		<div class="add-description-padding">
			<label class="settings-label-2" for="upload-description"> description</label>
			<input class="large-input" type="text" placeholder="Add description..." name="upload-description" required>
			<button class="settings-button settings-button-3" type="submit" name="post-upload"> upload <i class="fas fa-plus"></i></button>
		</div>
	</form>
</div>
<?php require __DIR__.'/views/footer.php';?>
