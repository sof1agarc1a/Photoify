<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';

// If the user is logged in redirect to the home-page
if (isset($_SESSION['logedin'])):
    redirect('/');
endif;
?>

<article>
	<img class="login-img" src="http://www.futurepositivestudio.com/wp-content/uploads/2015/10/BL-Cold-Brew-Instagram-grid-2.jpg">
	<div class="login-bg">
		<p class="title-nav login-size"><span class="p login-size-p">P</span>hot<i class="fas fa-camera-retro f-c-r-login"></i>ify</p>
		<p class="sign-in"> sign up </p> <hr> </hr>
		<p class="alert-message">
		<?php alert('empty'); ?> </p>
	  <form action="app/users/create.php" method="post">
			<p class="alert-message">
			<?php alert('username-taken'); ?> </p>
	    <div class="form-group">
	      <label for="username">username</label>
	      <input id="username" type="text" name="username">
	    </div>
			<p class="alert-message">
			<?php alert('email-taken');
            alert('invalid-email'); ?> </p>
			<div class="form-group">
				<label for="email">email</label>
				<input id="email" type="email" name="email">
			</div>
	    <div class="form-group">
	      <label for="password">password</label>
	      <input id="password" type="password" name="password">
	    </div>
			<div class="button-login">
	    	<button type="submit" name="create-account"><i class="fas fa-user-plus"></i> create account</button>
			</div>
			<div>
			<p class="create-account"> Already registered? <a class="create-account ca-bold" href="login.php"> Log in. </a> </p>
		</div>
	</form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
