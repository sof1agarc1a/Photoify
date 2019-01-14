'use strict';

const formsComments = document.querySelectorAll('.comments');

const addComment = (commentName, comment, postId, commentId) => {
  const list = document.querySelector(`#add-comment-${postId}`);
  const item = document.createElement('p');
	item.id = `edit-delete-comment-${commentId}`;
  item.textContent = commentName + ": " + comment;
  list.appendChild(item);

	const editForm = document.createElement('div');
	const createEditCommentForm = `
	<form class="edit-comment" id="edit-delete-form-${commentId}" method="post">
	 <input type="hidden" name="comment-id" value="${commentId}">
	 <input type="text" name="edit-comment" required>
	 <button type="submit"> Edit </button>
	</form>
	`;
	editForm.innerHTML = createEditCommentForm;

	list.appendChild(editForm);

	const deleteForm = document.createElement('div');
	const createDeleteCommentForm = `
	 <form class="delete-comment" id="edit-delete-form-${commentId}" method="post">
		 <input type="hidden" name="delete-comment-id" value="${commentId}">
		 <button type="submit"> Delete comment </button>
	 </form>
	`;
	deleteForm.innerHTML = createDeleteCommentForm;
	list.appendChild(deleteForm);


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
				.then(editedComment => editComment(editedComment.username, editedComment.content, editedComment.id))
		});
	});


	const deleteFormsComments = document.querySelectorAll('.delete-comment');
	deleteFormsComments.forEach(deleteFormComment => {
		deleteFormComment.addEventListener('submit', (event) => {
		  event.preventDefault();
		  const deletedFormComment = new FormData(deleteFormComment);
		  fetch('app/posts/delete_comment.php', {
		      method: 'POST',
		      body: deletedFormComment
		    })
		    .then(response => response.json())
				.then(deletedComment => deleteCommentFunc(deletedComment.username, deletedComment.content, deletedComment.id))
		});
	});



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
			.then(comment => addComment(comment.username, comment.content, comment.post_id, comment.id))
	});
});
