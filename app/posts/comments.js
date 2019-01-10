'use strict';

const formsComments = document.querySelectorAll('.comments');


const addComment = (commentName, comment, postId, commentId) => {
  const list = document.querySelector(`#add-comment-${postId}`);
  const item = document.createElement('p');
  item.textContent = commentName + ": " + comment;
  list.appendChild(item);

	const editForm = document.createElement('div');
	const createEditCommentForm = `
	<form class="edit-comment" id="edit-comment-${commentId}" method="post">
	 <div>
		 <input type="hidden" name="id" value="${commentId}">
		 <input type="text" name="edit-comment" required>
		 <button type="submit"> Edit </button>
	 </div>
	</form>
	`;
	editForm.innerHTML = createEditCommentForm;
	list.appendChild(editForm);

	const deleteForm = document.createElement('div');
	const createDeleteCommentForm = `
	 <form class="delete-comment" id="delete-comment-${commentId}" method="post">
		 <div>
			 <input type="hidden" name="id" value="${commentId}">
			 <button type="submit"> Delete comment </button>
		 </div>
	 </form>
	`;
	deleteForm.innerHTML = createDeleteCommentForm;
	list.appendChild(deleteForm);

};

formsComments.forEach(form => {
	form.addEventListener('submit', (event) => {

	  event.preventDefault();
		console.log(form.dataset.id);

	  const formComments = new FormData(form);

	  fetch('app/posts/comments.php', {
	      method: 'POST',
	      body: formComments
	    })
	    .then(response => response.json())
			.then(comment => addComment(comment.username, comment.content, comment.post_id, comment.id))
	});
});
