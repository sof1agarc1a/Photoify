'use strict';

const formsLikes = document.querySelectorAll('.likes');
formsLikes.forEach(form => {
	form.addEventListener('submit', (event) => {

	  event.preventDefault();

	  const formLikes = new FormData(form);

		if (form[1].value === 'liked') {
				form[1].value = 'disliked';
		} else {
				form[1].value = 'liked';
		}

	  fetch('app/posts/likes.php', {
	      method: 'POST',
	      body: formLikes
	    })
	    .then(response => response.json())
	    .then(json => form.nextElementSibling.textContent = json[0].likes)
	});
});
