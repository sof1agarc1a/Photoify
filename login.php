<?php require __DIR__.'/views/header.php'; ?>
<style>
nav {
  display: none;
}
</style>

<article>
    <h1>Photoify</h1>

    <?php
		/* If the user is logged in redirect directly to the home-page */
		if(isset($_SESSION['user'])):
			redirect('/');
		endif;

		/* Error display if login failed */
		if(isset($_SESSION['wrong'])):
    	echo $_SESSION['wrong'];
  		session_destroy();
  	endif;

		if(isset($_SESSION['empty'])):
			echo $_SESSION['empty'];
			session_destroy();
		endif;
    ?>

    <form action="app/users/login.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="text" name="username" value="sof1agarc1a">
            <small class="form-text text-muted">Please provide the your username.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" value="sofia123">
            <small class="form-text text-muted">Please provide the your password (passphrase).</small>
        </div><!-- /form-group -->

				<button type="submit" class="btn btn-primary">Login</button>


    </form>

    <div>
      <p> Don't have an account? <a href="create.php"> Sign up. </a> </p>
    </div>

</article>

<?php require __DIR__.'/views/footer.php'; ?>
