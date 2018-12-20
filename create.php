<?php
declare(strict_types=1);
require __DIR__.'/views/header.php'; ?>

<style>
	nav {
	  display: none;
	}
</style>
<article>
  <form action="app/users/create.php" method="post">

		<?php
		// If the user is logged in redirect directly to the home-page
		if(isset($_SESSION['logedin'])):
				redirect('/');
		endif;

		// Dislay errors if form isn't correct
		if(isset($_SESSION['email-taken'])):
    	echo $_SESSION['email-taken'];
  		session_destroy();
  	endif;

		if(isset($_SESSION['username-taken'])):
			echo $_SESSION['username-taken'];
			session_destroy();
		endif;
    ?>

		<div class="form-group">
			<label for="text">Full name</label>
			<input class="form-control" type="text" name="full-name" value="Sofia Garcia">
			<small class="form-text text-muted">Full name.</small>
		</div>
    <div class="form-group">
      <label for="text">Username</label>
      <input class="form-control" type="text" name="username" value="sof1agarc1a">
      <small class="form-text text-muted">Username.</small>
    </div>
		<div class="form-group">
			<label for="email">Email</label>
			<input class="form-control" type="email" name="email" value="sofgar0614@gmail.com">
			<small class="form-text text-muted">Please provide the your email address.</small>
		</div>
    <div class="form-group">
      <label for="password">Password</label>
      <input class="form-control" type="password" name="password" value="sofia123">
      <small class="form-text text-muted">Please provide the your password (passphrase).</small>
    </div>
    <button type="submit" name="create-account" class="btn btn-primary">Create account</button>
  </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
