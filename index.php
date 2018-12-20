<?php require __DIR__.'/views/header.php'; ?>

<?php
// If there is no user logged in redirect to the login page.
if(!isset($_SESSION['logedin'])):
  redirect('/login.php');
endif; ?>

<article>
  <h1><?php echo $config['title']; ?></h1>
  <?php if(isset($_SESSION['logedin'])):
		echo "hi " . $_SESSION['logedin']['username'];
  endif; ?>

  <p>This is the home page.</p>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
