<?php
// If there is no user logged in redirect to the login page.
if (!isset($_SESSION['logedin'])):
    redirect('/login.php');
endif;
?>

<article class="margin-top">
	<div class="logedin-article">
		<?php	foreach ($posts as $post):
            $post_id = $post['id'];
         $user_id = $_SESSION['logedin']['user_id'];
             $statement = $pdo->query("SELECT * FROM likes WHERE user_id= '$user_id' AND post_id='$post_id';");
         $liked = $statement->fetch(PDO::FETCH_ASSOC);
                if ($liked) {
                    $action = 'liked';
                } else {
                    $action = 'disliked';
                };

                $date = date_create($post['post_created_at'], timezone_open('UTC'));
                $timezone = 'Europe/Stockholm';
                date_timezone_set($date, timezone_open($timezone));
                date_timezone_get($date);
                ?>
				<div class="post-border">
				<div class="each-post">
					<img class="posted-image" src="<?= '/assets/images/uploads/post_pic/'.$post['post_pic']; ?>" alt="post picture">
					<div class="comments-container">
						<div class="likes-container">
							<form class="likes liked-heart" method="post" >
								<input type="hidden" name="id" value="<?= $post['id']; ?>">
								<input type="hidden" name="action" value="<?= $action ?>" />
								<button class="likes-heart" type="submit" aria-hidden="true"><i class="fa fa-heart"></i></button>
							</form>
							<p class="number-likes"> <?= $post['likes']; ?> </p>
						</div>
						<?php if ($post['user_id'] === $user_id): ?>
						<div class="dots">
							<div class="dot-holder" data-id="<?= $post['id']?>">
								<div class="dot"> </div>
								<div class="dot"> </div>
								<div class="dot"> </div>
							</div>
						</div>
						<div class="options-post-form options-post-form-<?= $post['id']?>">
							<div class="both-options">
								<form action="/app/posts/update_description.php" method="post">
									<input class="options-form-input" type="text" name="new-description" value="<?= $post['description']; ?>" required>
									<button class="options-form" type="submit" name="description-update"> Edit <i class="fas fa-pen"></i></button>
									<input type="hidden" name="id" value="<?= $post['id']; ?>" >
								</form>
								<form action="/app/posts/delete.php" method="post">
									<input class="options-form" type="hidden" name="id" value="<?= $post['id']; ?>" >
									<button class="options-form" type="submit" name="post-delete"> Delete <i class="fas fa-trash-alt"></i></button>
								</form>
							</div>
						</div>
						<?php endif; ?>
						<div class="description-container">
							<img class="post-user-profile-pic" src="<?= '/assets/images/uploads/profile_pic/'.$post['profile_pic']?>" alt="profile picture">
							<div>
								<p class="username-post">
									<?= $post['username']; ?>
								</p>
								 <p class="time-post">
									<?= date_format($date, 'H:i d M Y'); ?>
								</p>
							</div>
						</div>
						<div class="description-comment">
							<p> <hr class="description-line">
								<?= $post['description']; ?>
							</p>
						</div>
						<?php
                            $post_id = $post['id'];
                            $user = $pdo->prepare('SELECT * FROM comments WHERE post_id = :post_id;');
                          $user->bindParam(':post_id', $post_id, PDO::PARAM_INT);
                          $user->execute();
                          $comments = $user->fetchAll(PDO::FETCH_ASSOC);
                        ?>
						<div class="comment-section" id="add-comment-<?= $post['id']; ?>">
							<?php foreach ($comments as $comment):
                            $dateComment = date_create($comment['created_at'], timezone_open('UTC'));
                            $timezone = 'Europe/Stockholm';
                            date_timezone_set($dateComment, timezone_open($timezone));
                            date_timezone_get($dateComment);	?>
							<div class="comment-section-background" id="edit-delete-form-<?= $comment['id']; ?>">
								<div class="comment-display">
									<img class="comment-user-profile-pic" src="<?= '/assets/images/uploads/profile_pic/'.$comment['profile_pic']?>" alt="profile picture">
									<?php if ($comment['user_id'] === $user_id): ?>
										<i class="fas fa-pen-square" data-id="<?= $comment['id']; ?>"></i>
									<?php endif; ?>
									<div class="comment-display-text">
										<p> <?= $comment['username'] ?> <span id="edit-delete-comment-<?= $comment['id']; ?>"> <?= " " . $comment['content']; ?> </span> </p>
										<p> <?= date_format($dateComment, 'd/m, H:i'); ?></p>
									</div>
								</div>
								<?php if ($comment['user_id'] === $user_id): ?>
								<div class="hidden-icons show-comment-option-<?= $comment['id']; ?>">
									<div class="comment-options-container">
										<form class="edit-comment" method="post">
											<input type="hidden" name="comment-id" value="<?= $comment['id']; ?>">
											<input class="comment-edit-form" type="text" name="edit-comment" value="<?= $comment['content']; ?>" required>
											<button class="delete-comment-form" type="submit"> Edit <i class="fas fa-pen comments-icons "></i></button>
										</form>
										<form class="delete-comment" method="post">
											<input type="hidden" name="delete-comment-id" value="<?= $comment['id']; ?>">
											<button class="delete-comment-form" type="submit"> Delete <i class="fas fa-trash-alt comments-icons "></i></button>
										</form>
									</div>
								</div>
								<?php endif; ?>
							</div>
							<?php	endforeach; ?>
						</div>
						<form class="comments" method="post">
							<img class="new-comment-profile_pic" src="<?= '/assets/images/uploads/profile_pic/'.$_SESSION['logedin']['profile_pic']; ?>" alt="post picture">
							<input type="hidden" name="id" value="<?= $post['id']; ?>">
							<input class="new-comment-input" type="text" name="new-comment" placeholder="Add a comment... " required>
							<button class="new-comment-button" type="submit"><i class="fas fa-comment"></i></button>
						</form>
					</div>
				</div>
			</div>
			<?php	endforeach; ?>
		</div>
	</article>
