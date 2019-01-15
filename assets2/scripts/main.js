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
