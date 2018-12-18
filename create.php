<?php require __DIR__.'/views/header.php'; ?>

<style>

nav {
  display: none;
}
</style>

<article>


  <form action="app/users/create.php" method="post">
      <div class="form-group">
          <label for="email">Email</label>
          <input class="form-control" type="email" name="email" value="francis@darjeeling.com" required>
          <small class="form-text text-muted">Please provide the your email address.</small>
      </div><!-- /form-group -->

      <div class="form-group">
          <label for="text">Username</label>
          <input class="form-control" type="text" name="username" value="username" required>
          <small class="form-text text-muted">Username.</small>
      </div><!-- /form-group -->

      <div class="form-group">
          <label for="password">Password</label>
          <input class="form-control" type="password" name="password" value="the-darjeeling-limited" required>
          <small class="form-text text-muted">Please provide the your password (passphrase).</small>
      </div><!-- /form-group -->


      <button type="submit" class="btn btn-primary">Create account</button>
  </form>


</article>

<?php require __DIR__.'/views/footer.php'; ?>
