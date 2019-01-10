'use strict';

const deleteFormsComments = document.querySelectorAll('.delete-comment');

const deleteCommentFunc = (commentName, comment, commentId) => {
  const commentItem = document.querySelector(`#edit-delete-comment-${commentId}`);
  commentItem.remove();
	const editDeleteForms = document.querySelectorAll(`#edit-delete-form-${commentId}`);
	editDeleteForms.forEach(editDeleteForm => {
		editDeleteForm.remove();
	})
};

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
