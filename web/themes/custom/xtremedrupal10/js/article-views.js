/**
 * @file
 * Global utilities.
 *
 */
(function($, Drupal) {

  'use strict';

  Drupal.behaviors.articleSearch = {
    attach: function(context, settings) {

    	const inputField = document.getElementById("autocomplete-input");
	    const list = document.getElementById("autocomplete-list");

	    // Sample list of items for autocomplete
	    const items = ["Apple", "Banana", "Cherry", "Date", "Fig", "Grape", "Lemon", "Mango", "Orange", "Peach", "Pear"];

	    inputField.addEventListener("input", function() {
	        const inputValue = inputField.value.toLowerCase();
	        list.innerHTML = ""; // Clear the previous list

	        if (inputValue.length === 0) {
	            return;
	        }

	        // Filter items that match the input value
	        const filteredItems = items.filter(item => item.toLowerCase().includes(inputValue));

	        // Populate the dropdown list
	        filteredItems.forEach(item => {
	            const listItem = document.createElement("li");
	            listItem.textContent = item;
	            listItem.addEventListener("click", function() {
	                inputField.value = item;
	                list.innerHTML = ""; // Clear the list when an item is clicked
	            });
	            list.appendChild(listItem);
	        });
	    });

	    // Close the dropdown when clicking outside the input field
	    document.addEventListener("click", function(e) {
	        if (e.target !== inputField) {
	            list.innerHTML = "";
	        }
	    });

    }
  };

})(jQuery, Drupal);