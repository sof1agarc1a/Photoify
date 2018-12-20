<?php require __DIR__.'/views/header.php'; ?>

<?php
if(!isset($_SESSION['user'])):
  redirect('/login.php');
endif; ?>

<?php
if(isset($_SESSION['wrong'])):
	echo $_SESSION['wrong'];
	session_destroy();
endif;

if(isset($_SESSION['empty'])):
	echo $_SESSION['empty'];
	session_destroy();
endif;

?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <?php if(isset($_SESSION['user'])):
        echo $_SESSION['user'];
        // session_destroy();
    endif; ?>

    <p>This is the home page.</p>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
