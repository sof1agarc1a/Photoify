'use strict';

const deleteFormsComments = document.querySelectorAll('.delete-comment');
const deleteCommentFunction = (commentId) => {
  const commentItem = document.querySelector(`#edit-delete-form-${commentId}`);
	//delete comment with forms (trashy af)
	commentItem.style.opacity = "0";
	commentItem.style.height = "0px";
	commentItem.style.padding = "0px 56px";
	commentItem.style.visibility = "hidden";

	const commentItemInput = document.querySelector(`#edit-delete-form-${commentId}`).getElementsByTagName('input')
	const commentItemButton = document.querySelector(`#edit-delete-form-${commentId}`).getElementsByTagName('button')
	const commentItemForms = document.querySelector(`#edit-delete-form-${commentId}`).getElementsByTagName('form')
	const commentItemDivs = document.querySelector(`#edit-delete-form-${commentId}`).getElementsByTagName('div')

	commentItemInput[1].style.visibility = "hidden"
	commentItemButton[0].style.visibility = "hidden"
	commentItemButton[1].style.visibility = "hidden"
	commentItemForms[1].style.visibility = "hidden"
	commentItemDivs[3].style.visibility = "hidden"
	commentItemDivs[2].style.visibility = "hidden"
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
		.then(deletedComment => deleteCommentFunction(deletedComment.id))
	});
});
