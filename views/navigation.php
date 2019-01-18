<?php if(isset($_SESSION['logedin'])): ?>
<nav>

  <a class="title-nav" href="/index.php"><span class="p">P</span><span class="photoify">hotoify</span></a>
  <ul>
    <li>
      <a class="menu-hover" href="/index.php"> <i class="fas hide-mobile fa-home"></i> <span class="nav-hidden-mobile"> home</span></a>
    </li>
    <li>
      <a class="menu-hover" href="/posts.php"><i class="fas hide-mobile fa-camera-retro"></i> <span class="nav-hidden-mobile"> add post</span></a>
    </li>
    <li>
      <a class="menu-hover" href="/about.php"><i class="fas hide-mobile fa-user-circle"></i> <span class="nav-hidden-mobile">my page</span></a>
    </li>
		<li>
			<a class="menu-hover" href="/../app/users/logout.php"><i class="fas hide-mobile fa-sign-out-alt"></i> <span class="nav-hidden-mobile"> logout</span></a>
		</li>
	</ul>
	<li class="settings-icon">
		<img class="nav-user-profile-pic" src="/assets/images/uploads/profile_pic/<?= $_SESSION['logedin']['profile_pic']; ?>" alt="profile picture">
		<a href="/delete.php"><i class="fas hide-mobile fa-sliders-h"></i></a>
	</li>
</nav>
<?php
endif; ?>
