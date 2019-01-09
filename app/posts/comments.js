'use strict';

const formComments = document.querySelectorAll('.comments');


const addComment = (comment) => {
  const list = document.querySelector(`.comment`);
  // const item = document.createElement('li');
  list.textContent = likes;
  // list.appendChild(item);
};

if(json[0].likes != 0) {
comments.forEach(form => {
	form.addEventListener('submit', (event) => {

	  event.preventDefault();

	  const formComments = new FormData(form);

	  fetch('app/posts/likes.php', {
	      method: 'POST',
	      body: formComments
	    })
	    .then(response => response.json())
	    .then(json => form.nextElementSibling.textContent = json[0].comments + " comments")
	});
});

// form.nextElementSibling.nextSibling.textContent = json.likes
// .then(json => showLikes(json[0].likes + " likes"))


// };

// #like-count-${this.dataset.id}
