'use strict';

const dotOptions = document.querySelectorAll('.dot-holder');
dotOptions.forEach(optionPost => optionPost.addEventListener('click', (event) => {
	const hiddenOption = document.querySelector(`.options-post-form-${optionPost.dataset.id}`);
	hiddenOption.classList.toggle('hidden');
}));

const commentIcons = document.querySelectorAll('.fa-pen-square');
commentIcons.forEach(commentIcon => commentIcon.addEventListener('click', (event) => {
	const commentOptions = document.querySelector(`.show-comment-option-${commentIcon.dataset.id}`)
	commentOptions.classList.toggle('visible-icons');
}));

//showing a preview of the choosen profile picture.
const inputElement = document.getElementById('file-input');
const preview = document.querySelector('.preview-pic');
const button = document.querySelector('.settings-button');

function handleFiles(files) {
  for (let i = 0; i < files.length; i++) {
    const file = files[i];
    if (!file.type.startsWith('image/')){ continue }

    const img = document.createElement("img");
    img.classList.add("preview-post-pic");
		img.setAttribute("id", "opacity");
    img.file = file;
		preview.appendChild(img);
		preview.firstElementChild.remove()
		button.classList.remove('s-b-bg')

    const reader = new FileReader();
    reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
    reader.readAsDataURL(file);
  }
}
