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
		<p class="sign-in"> sign in </p>
		<hr>
	 	<p class="alert-message">
		<?php
        alert('wrong');
        alert('empty');
        ?> </p>
	  <form action="app/users/login.php" method="post">
	    <div class="form-group form-group-mobile">
	      <label for="username"><i class="fas fa-user"></i> username</label>
	      <input id="username" type="text" name="username">
	    </div>
	    <div class="form-group form-group-mobile">
	      <label for="password"><i class="fas fa-lock"></i> password</label>
	      <input id="password" type="password" name="password">
	    </div>
			<div class="button-login">
				<button type="submit"><i class="fas fa-sign-in-alt"></i> login</button>
			</div>
		</form>
	  <div>
	    <p class="create-account"> Don't have an account? <a class="create-account ca-bold" href="create.php"> Sign up. </a> </p>
	  </div>
	</div>
</article>
<?php require __DIR__.'/views/footer.php'; ?>
