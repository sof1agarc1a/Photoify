<?php
declare(strict_types=1);
require __DIR__.'/views/header.php'; ?>

<style>
	nav {
	  display: none;
	}
</style>
<article>
	<p> Edit profile </p>

	<form action="app/users/update/update_username.php" method="post">
		<div class="form-group">
			<label for="username">Change username</label>
			<input class="form-control" type="text" name="new-username" value="<?= $_SESSION['logedin']['username'] ?>">
		</div>
		<button type="submit" name="update-username" class="btn btn-primary">Edit</button>
	</form>

	<form action="app/users/update/update_profile_pic.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="profile-pic">Change picture</label>
      <input class="form-control" type="file" accept=".gif, .png, .jpg, .jpeg" name="new-profile-pic" required>
			<img width="100px" height="100px" src="<?= '/assets/images/uploads/profile_pic/'.$_SESSION['logedin']['profile_pic'] ?>" alt="profile picture">
    </div>
    <button type="submit" name="update-profile-pic" class="btn btn-primary">Edit</button>
	</form>

	<?php
	if($_SESSION['logedin']['profile_pic'] != 'default_picture.jpg'): ?>
	<form action="app/users/update/delete_profile_pic.php" method="post">
		<button type="submit" name="delete-profile-pic" class="btn btn-primary">Delete profile picture</button>
	</form>
	<?php endif;


	if(isset($_SESSION['pic-type'])):
		echo $_SESSION['pic-type'];
		unset($_SESSION['pic-type']);
	endif;

	if(isset($_SESSION['pic-size'])):
		echo $_SESSION['pic-size'];
		unset($_SESSION['pic-size']);
	endif;

	if(isset($_SESSION['same-username'])):
		echo $_SESSION['same-username'];
		unset($_SESSION['same-username']);
	endif;

	if(isset($_SESSION['taken-username'])):
		echo $_SESSION['taken-username'];
		unset($_SESSION['taken-username']);
	endif;

	if(isset($_SESSION['uploaded-username'])):
		echo $_SESSION['uploaded-username'];
		unset($_SESSION['uploaded-username']);
	endif;

	// do foreach
	if(isset($_SESSION['invalid-email'])):
		echo $_SESSION['invalid-email'];
		unset($_SESSION['invalid-email']);
	endif;

	if(isset($_SESSION['same-email'])):
		echo $_SESSION['same-email'];
		unset($_SESSION['same-email']);
	endif;

	if(isset($_SESSION['taken-email'])):
		echo $_SESSION['taken-email'];
		unset($_SESSION['taken-email']);
	endif;

	if(isset($_SESSION['updated-email'])):
		echo $_SESSION['updated-email'];
		unset($_SESSION['updated-email']);
	endif;
	?>

	<form action="app/users/update/update_bio.php" method="post">
		<div class="form-group">
			<label for="bio">Edit biography</label>
			<input class="form-control" type="text" name="new-bio" value="<?= $_SESSION['logedin']['profile_bio'] ?>">
		</div>
		<button type="submit" name="update-bio" class="btn btn-primary">Edit</button>
	</form>

	<form action="app/users/update/update_email.php" method="post">
		<div class="form-group">
			<label for="email">Change email</label>
			<input class="form-control" type="email" name="new-email" value="<?= $_SESSION['logedin']['email'] ?>">
		</div>
		<button type="submit" name="update-email" class="btn btn-primary">Edit</button>
	</form>

	<?php
	if(isset($_SESSION['password-updated'])):
		echo $_SESSION['password-updated'];
		unset($_SESSION['password-updated']);
	endif;

	if(isset($_SESSION['wrong-password'])):
		echo $_SESSION['wrong-password'];
		unset($_SESSION['wrong-password']);
	endif;

	if(isset($_SESSION['empty-password'])):
		echo $_SESSION['empty-password'];
		unset($_SESSION['empty-password']);
	endif;
	?>

	<form action="app/users/update/update_password.php" method="post">
		<div class="form-group">
			<label for="new-password">Change password</label>
			<input class="form-control" type="password" name="old-password">
			<input class="form-control" type="password" name="new-password">
		</div>
		<button type="submit" name="update-password" class="btn btn-primary">Edit</button>
	</form>

  <form action="app/users/delete.php" method="post">
      <p> Delete your account </p>
		<?php
		echo $_SESSION['logedin']['username'];
		// If the user is logged in redirect directly to the home-page
		if(!isset($_SESSION['logedin'])):
			redirect('/');
		endif;

		if(isset($_SESSION['empty'])):
			echo $_SESSION['empty'];
			unset($_SESSION['empty']);
		endif;

		if(isset($_SESSION['wrong'])):
			echo $_SESSION['wrong'];
			unset($_SESSION['wrong']);
		endif;
    ?>

    <div class="form-group">
      <label for="password">Password</label>
      <input class="form-control" type="password" name="password" value="sofia123">
      <small class="form-text text-muted">Please provide the your password (passphrase).</small>
    </div>
    <button type="submit" name="delete-account" class="btn btn-primary">Delete account</button>
  </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
