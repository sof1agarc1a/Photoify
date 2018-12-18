<?php require __DIR__.'/views/header.php'; ?>
<style>
nav {
  display: none;
}
</style>

<article>
    <h1>Photoify</h1>

    <?php if(isset($_SESSION['wrong'])):
        echo $_SESSION['wrong'];
        session_destroy();
    endif;

    ?>

    <form action="app/users/login.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" value="francis@darjeeling.com" required>
            <small class="form-text text-muted">Please provide the your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" value="the-darjeeling-limited" required>
            <small class="form-text text-muted">Please provide the your password (passphrase).</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <div>
      <p> Don't have an account? <a href="create.php"> Sign up. </a> </p>
    </div>

</article>

<?php require __DIR__.'/views/footer.php'; ?>
