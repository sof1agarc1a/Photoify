<?php require __DIR__.'/views/header.php';?>


<!-- <form action="app/users/update/update_profile_pic.php" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label class="preview-pic" for="file-input">
			<img class="pic" src="<?= '/assets/images/uploads/profile_pic/'.$_SESSION['logedin']['profile_pic'] ?>" alt="profile picture">
		</label>
		<input id="file-input" class="settings-input-file" type="file" accept=".gif, .png, .jpg, .jpeg" name="new-profile-pic" onchange="handleFiles(this.files)" required>
	</div>
	<button class="settings-button s-b-bg" type="submit" name="update-profile-pic">Change picture <i class="fas fa-pen"></i></button>
</form> -->

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
