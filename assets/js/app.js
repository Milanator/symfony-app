/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// var $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

function closest(el, selector) {
	var matchesFn;

	// find vendor prefix
	['matches','webkitMatchesSelector','mozMatchesSelector','msMatchesSelector','oMatchesSelector'].some(function(fn) {
		if (typeof document.body[fn] == 'function') {
			matchesFn = fn;
			return true;
		}
		return false;
	})

	var parent;

	// traverse parents
	while (el) {
		parent = el.parentElement;
		if (parent && parent[matchesFn](selector)) {
			return parent;
		}
		el = parent;
	}

	return null;
}

function deleteItem(event){
	let itemId =  event.target.getAttribute('data-id');
	// let formAction = document.getElementById('deleteForm').action;

	axios.post(isDonePath, {
		itemId: itemId
	})
		.then(function (response) {
			event.target.closest('tr').remove();
		})
		.catch(function (error) {
			console.log(error);
		});
}

function isDoneItem(event){

	let itemId =  event.target.getAttribute('data-id');
	// let formAction = document.getElementById('isDoneForm').action;

	axios.post(deleteItemPath, {
		itemId: itemId
	})
		.then(function (response) {
			if( response == 1 ){
				event.target.classList.add("green");
			} else{
				event.target.classList.add("grey");
			}
			location.reload();
		})
		.catch(function (error) {
			console.log(error);
		});

}

let deleteButtons = document.querySelectorAll('.deleteButton');
let isDoneButtons = document.querySelectorAll('.isDoneButton');

deleteButtons.forEach(button => button.addEventListener('click', deleteItem));

isDoneButtons.forEach(button => button.addEventListener('click', isDoneItem));


