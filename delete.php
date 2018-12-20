<?php
declare(strict_types=1);
require __DIR__.'/views/header.php'; ?>

<style>
	nav {
	  display: none;
	}
</style>
<article>
  <form action="app/users/delete.php" method="post">
      <p> Provide password to delete your account </p>
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
