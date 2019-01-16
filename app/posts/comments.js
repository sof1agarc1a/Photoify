'use strict';

const formsComments = document.querySelectorAll('.comments');

const addComment = (commentUsername, commentContent, commentPost_id, commentId, commentProfile_pic, commentCreated_at, commentUser_id) => {
  const list = document.querySelector(`#add-comment-${commentPost_id}`);

	let options = { day: 'numeric', month: '2-digit', hour: 'numeric', minute: 'numeric' };
	let timezone = {timeZone: 'Europe/Stockholm'};
	let time = new Date().timezone;
	let dateTimeFormat = new Intl.DateTimeFormat('en-GB', options);
	let date = dateTimeFormat.format(time);

	const editForm = document.createElement('div');
	editForm.className = "comment-section-background";
	editForm.setAttribute("id", `edit-delete-form-${commentId}`);

	const createEditCommentForm = `
		<div class="comment-display">
			<img class="comment-user-profile-pic" src="/assets/images/uploads/profile_pic/${commentProfile_pic}" alt="profile picture">
				<i class="fas fa-pen-square fa-edit-new-${commentId}" data-id="${commentId}"></i>
			<div class="comment-display-text">
				<p> ${commentUsername} <span id="edit-delete-comment-${commentId}"> ${commentContent} </span> </p>
				<p> ${date} </p>
			</div>
		</div>
		<div class="hidden-icons show-comment-option-${commentId}">
			<div class="comment-options-container">
				<form class="edit-comment" method="post">
					<input type="hidden" name="comment-id" value="${commentId}">
					<input class="comment-edit-form" type="text" name="edit-comment" value="${commentContent}" required>
					<button class="delete-comment-form" type="submit"> Edit <i class="fas fa-pen comments-icons "></i></button>
				</form>
				<form class="delete-comment-new-${commentId}" method="post">
					<input type="hidden" name="delete-comment-id" value="${commentId}">
					<button class="delete-comment-form" type="submit"> Delete <i class="fas fa-trash-alt comments-icons "></i></button>
				</form>
			</div>
		</div>
	`;
	editForm.innerHTML = createEditCommentForm;
	list.appendChild(editForm);

	const editFormsComments = document.querySelectorAll('.edit-comment');
	editFormsComments.forEach(editFormComment => {
		editFormComment.addEventListener('submit', (event) => {
		  event.preventDefault();
		  const newFormComment = new FormData(editFormComment);
		  fetch('app/posts/edit_comment.php', {
		      method: 'POST',
		      body: newFormComment
		    })
		    .then(response => response.json())
				.then(editedComment => editComment(editedComment.content, editedComment.id))
		});
	});

	const deleteFormsComments = document.querySelectorAll(`.delete-comment-new-${commentId}`);
	deleteFormsComments.forEach(deleteFormComment => {
		deleteFormComment.addEventListener('submit', (event) => {
		  event.preventDefault();
		  const deletedFormComment = new FormData(deleteFormComment);
		  fetch('app/posts/delete_comment.php', {
	      method: 'POST',
	      body: deletedFormComment
	    })
	    .then(response => response.json())
			.then(deletedComment => deleteCommentFunction(deletedComment.id))
		});
	});

	const commentIcons = document.querySelectorAll(`.fa-edit-new-${commentId}`);
	commentIcons.forEach(commentIcon => commentIcon.addEventListener('click', (event) => {
		const commentOptions = document.querySelector(`.show-comment-option-${commentIcon.dataset.id}`)
		commentOptions.classList.toggle('visible-icons');
	}));
};

formsComments.forEach(form => {
	form.addEventListener('submit', (event) => {
	  event.preventDefault();
	  const formComments = new FormData(form);
	  fetch('app/posts/comments.php', {
      method: 'POST',
      body: formComments
    })
    .then(response => response.json())
		.then(comment => addComment(comment.username, comment.content, comment.post_id, comment.id, comment.profile_pic, comment.created_at, comment.user_id))
	});
});
