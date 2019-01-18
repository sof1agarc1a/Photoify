'use strict';

const editFormsComments = document.querySelectorAll('.edit-comment');

const editComment = (comment, commentId) => {
  const textItem = document.querySelector(`#edit-delete-comment-${commentId}`);
  textItem.textContent = comment;
};

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
