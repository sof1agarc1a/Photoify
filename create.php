<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';

// If the user is logged in redirect to the home-page
if(isset($_SESSION['logedin'])):
		redirect('/');
endif;
?>

<style>
	nav {
	  display: none;
	}
</style>

<article>
	<img class="login-img" src="http://www.futurepositivestudio.com/wp-content/uploads/2015/10/BL-Cold-Brew-Instagram-grid-2.jpg">

	<div class="login-bg">
		<p class="title-nav login-size"><span class="p login-size-p">P</span>hot<i style="font-size: 64px;"class="fas fa-camera-retro"></i>ify</p>
		<p class="sign-in"> sign up </p> <hr> </hr>

		<p class="alert-message">
		<?php alert('empty'); ?> </p>

  <form action="app/users/create.php" method="post">
		<div class="form-group">
			<label for="name">full name</label>
			<input id="name" type="text" name="full-name" value="Sofia Garcia">
		</div>

		<p class="alert-message">
		<?php alert('username-taken'); ?> </p>

    <div class="form-group">
      <label for="username">username</label>
      <input id="username" type="text" name="username" value="sof1agarc1a">
    </div>

		<p class="alert-message">
		<?php alert('email-taken');
		alert('invalid-email'); ?> </p>

		<div class="form-group">
			<label for="email">email</label>
			<input id="email" type="email" name="email" value="sofgar0614@gmail.com">
		</div>
    <div class="form-group">
      <label for="password">password</label>
      <input id="password" type="password" name="password" value="sofia123">
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
