'use strict';

const formsLikes = document.querySelectorAll('.likes');
formsLikes.forEach(form => {
	form.addEventListener('submit', (event) => {

		// console.log(form);
	  event.preventDefault();

	  const formLikes = new FormData(form);

		if (form[1].value === 'liked') {
				form[1].value = 'disliked';
				console.log("bajs");
		} else {
				form[1].value = 'liked';
				console.log("bajsaaa");
		}

	  fetch('app/posts/likes.php', {
	      method: 'POST',
	      body: formLikes
	    })
	    .then(response => response.json())
	    .then(json => form.nextElementSibling.textContent = json.likes + " likes")
	});
});
// .then(json => likeForm.nextElementSibling.nextSibling.textContent = json.likes);
