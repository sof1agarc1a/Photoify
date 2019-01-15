'use strict';

const dotOptions = document.querySelectorAll('.dot-holder');

dotOptions.forEach(optionPost => optionPost.addEventListener('click', (event) => {

	const hiddenOption = document.querySelector(`.options-post-form-${optionPost.dataset.id}`);
	hiddenOption.classList.toggle('hidden');
}));



const commentIcons = document.querySelectorAll('.fa-edit');

commentIcons.forEach(commentIcon => commentIcon.addEventListener('click', (event) => {
	const commentOptions = document.querySelector(`.show-comment-option-${commentIcon.dataset.id}`)
	// commentOptions.forEach(commentOption => commentOption.classList.toggle('visible-icons'));
	commentOptions.classList.toggle('visible-icons');

}));


// const [...likeForms] = document.querySelectorAll('.liked-heart');
//
// likeForms.forEach((likeForm) => {
//     likeForm.addEventListener('submit', event => {
//
//         event.preventDefault();
//         const formData = new FormData(likeForm);
//
//         if (likeForm[1].value === 'liked') {
//             likeForm[1].value = 'disliked';
//         } else {
//             likeForm[1].value = 'liked';
//         }
//
//         fetch('app/posts/likes.php', {
//             method: 'POST',
//             body: formData
//           })
//           .then(response => response.json())
//           .then(json => likeForm.nextElementSibling.nextSibling.textContent = json.likes);
//     })
// });
