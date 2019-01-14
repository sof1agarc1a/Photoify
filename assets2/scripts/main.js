'use strict';

let dotOptions = document.querySelectorAll('.dot-holder');
let hiddenOptions = document.querySelectorAll('.options-post-form');
let dot = document.querySelectorAll('.dot');
let closeIcons = document.querySelectorAll('.close-icon');

dotOptions.forEach(optionPost => optionPost.addEventListener('click', (event) => {
	hiddenOptions.forEach(hiddenOption => hiddenOption.classList.toggle('hidden'));
	dot.forEach(hideDot => hideDot.classList.toggle('hidden-icons'));
	closeIcons.forEach(closeIcon => closeIcon.classList.toggle('visible-icons'));
}));


let commentIcons = document.querySelectorAll('.fa-edit');
console.log("hej")
// let commentOptions = document.querySelector('.show-comment-option-<?= $comment['id']; ?>');

// commentIcons.forEach(commentIcon => commentIcon.addEventListener('click', (event) => {
//
// 	commentOptions.forEach(commentOption => commentOption.classList.toggle('visible-icons'));
//
// }));
