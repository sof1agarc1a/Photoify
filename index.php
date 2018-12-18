<?php require __DIR__.'/views/header.php'; ?>

<?php
if(!isset($_SESSION['user'])):
  redirect('/login.php');
endif; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <?php if(isset($_SESSION['user'])):
        echo $_SESSION['user'];
        // session_destroy();
    endif; ?>

    <p>This is the home page.</p>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
