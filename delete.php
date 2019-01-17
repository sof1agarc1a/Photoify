<?php
declare(strict_types=1);
require __DIR__.'/views/header.php'; ?>

<?php
if(!isset($_SESSION['logedin'])):
	redirect('/');
endif;
?>

<article class="margin-top center-all">
	<div class="settings-container first-s-c">
		<img class="settings-img" src="/assets/images/settings.jpeg">
		<div class="settings-1">
			<form action="app/users/update/update_profile_pic.php" method="post" enctype="multipart/form-data">
		    <div class="form-group">
					<label class="preview-pic" for="file-input">
						<img class="pic" src="<?= '/assets/images/uploads/profile_pic/'.$_SESSION['logedin']['profile_pic'] ?>" alt="profile picture">
					</label>
		      <input id="file-input" class="settings-input-file" type="file" accept=".gif, .png, .jpg, .jpeg" name="new-profile-pic" onchange="handleFiles(this.files)" required>
			  </div>
		    <button class="settings-button s-b-bg" type="submit" name="update-profile-pic">Change picture</button>
			</form>
			<?php
			if($_SESSION['logedin']['profile_pic'] != 'default_picture.jpg'): ?>
			<form action="app/users/update/delete_profile_pic.php" method="post">
				<button class="settings-button" type="submit" name="delete-profile-pic">Delete picture</button>
			</form>
			<?php endif; ?>
			<p class="alert-message-settings">	<?php
				alert('pic-type');
				alert('pic-size'); ?>
			</p>
			<form action="app/users/update/update_bio.php" method="post">
				<div class="form-group-settings">
					<input class="settings-input" type="text" name="new-bio" value="<?= $_SESSION['logedin']['profile_bio'] ?>">
				</div>
				<button class="settings-button" type="submit" name="update-bio">Edit biography <i class="fas fa-book-open"></i></button>
			</form>
		</div>
	</div>
	<div class="settings-container">
		<p> profile settings <i class="fas fa-cogs"></i></p>
		<hr class="settings-line">
		<form action="app/users/update/update_username.php" method="post">
			<div class="form-group-settings-2">
				<p class="alert-message-settings"> <?php
					alert('same-username');
					alert('taken-username');
					alert('uploaded-username');?>
				</p>
				<label class="settings-label-2"><i class="fas fa-user-edit"></i> change username</label>
				<input class="settings-input-2" type="text" name="new-username" value="<?= $_SESSION['logedin']['username'] ?>">
				<button class="settings-button-2" type="submit" name="update-username"><i class="fas fa-pen"></i></button>
			</div>
		</form>
		<form action="app/users/update/update_email.php" method="post">
			<div class="form-group-settings-2">
				<p class="alert-message-settings"> <?php
					alert('invalid-email');
					alert('same-email');
					alert('taken-email');
					alert('updated-email');?>
				</p>
				<label class="settings-label-2"><i class="fas fa-envelope"></i> change email</label>
				<input class="settings-input-2" type="email" name="new-email" value="<?= $_SESSION['logedin']['email'] ?>">
				<button class="settings-button-2" type="submit" name="update-email"><i class="fas fa-pen"></i></button>
			</div>
		</form>
		<form action="app/users/update/update_password.php" method="post">
			<div class="form-group-settings-2">
				<p class="alert-message-settings"> <?php
					alert('password-updated');
					alert('wrong-password');
					alert('empty-password');?>
				</p>
				<label class="settings-label-2"><i class="fas fa-lock"></i> change password</label>
				<label class="settings-label-3">Current password</label>
				<input class="settings-input-2" type="password" name="old-password">
				<label class="settings-label-3">New password</label>
				<input class="settings-input-2" type="password" name="new-password">
			</div>
			<button class="settings-button-2" type="submit" name="update-password">Change <i class="fas fa-pen"></i></button>
		</form>
		<p class="delete-account-settings"> delete account <i class="fas fa-user-times"></i></p>
		<hr class="settings-line">
		<form action="app/users/delete.php" method="post">
			<div class="form-group-settings-2">
				<p class="alert-message-settings"> <?php
					alert('wrong');
					alert('empty');?>
				</p>
				<label class="settings-label-2" for="password"><i class="fas fa-key"></i> password</label>
				<input class="settings-input-2" type="password" name="password">
			</div>
			<button class="settings-button-2 delete-account-button" type="submit" name="delete-account">Delete account</button>
		</form>
	</div>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
