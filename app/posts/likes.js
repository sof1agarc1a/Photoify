'use strict';

const forms = document.querySelectorAll('.form');


// const showLikes = (likes) => {
//   const list = document.querySelector(`.likes`);
//   // const item = document.createElement('li');
//   list.textContent = likes;
//   // list.appendChild(item);
// };

// if(json[0].likes != 0) {
forms.forEach(form => {
	form.addEventListener('submit', (event) => {

	  event.preventDefault();

	  const formData = new FormData(form);

	  fetch('app/posts/likes.php', {
	      method: 'POST',
	      body: formData
	    })
	    .then(response => response.json())
	    .then(json => form.nextElementSibling.textContent = json[0].likes + " likes")
	});
});

// form.nextElementSibling.nextSibling.textContent = json.likes
// .then(json => showLikes(json[0].likes + " likes"))


// };

// #like-count-${this.dataset.id}


// fetch('/api')
//   .then(response => response.json())
//   .then(vampires => {
//     vampires.forEach(vampire => addVampire(vampire.name));
//   });

// When the page loads we fetch all vampires from the database and list them in
// our unordered list.

	// 'use strict';
	//
	// const form = document.querySelector('form');
	//
	// form.addEventListener('submit', event => {
	// 	event.preventDefault();
	//
	// 	const formData = new FormData(form);
	//
	// 	fetch(`likes.php`, {
	// 		method: 'POST',
	// 		body: formData
	// 	})
	// 	.then(response => response.json())
	// 	.then(json => console.dir(json[0].likes));
	// });
