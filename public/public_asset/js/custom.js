//Display lightbox js
$(document).ready(function(){
 lightbox.option({
      'wrapAround': true
    });
});

//Put PHP variable to JS 
function define(key) {
  return window.js_variable.define[key];
}

function message(key) {
   return window.js_variable.message[key];
}


// Save product in oder to compare to localStoreage
$(document).ready(function(){
 	$('.compare-page').on('click', function(){
 		var product = $(this).data('product');
 		if (localStorage.getItem("firstCompare") === null) {
 			localStorage.setItem('firstCompare', JSON.stringify(product));
 			addToCompare();
 			alert(message('first'));
 		} else if (localStorage.getItem("secondCompare") === null) {
 			localStorage.setItem('secondCompare', JSON.stringify(product));
 			addToCompare();
 			alert(message('second'));
 		} else {
 			alert(message('only'))
 		}
 	});
});

//Delete product to compare
$(document).ready(function(){
	$('.delete-compare').on('click', function(){
		var id = $(this).data('id');
		// console.log(id);
		if (id === 0) {
			localStorage.removeItem('firstCompare');
		} else {
			localStorage.removeItem('secondCompare');
		}
		alert(message('delete'));
	});
});

//Show product to compare
function addToCompare(){
	var first = JSON.parse(localStorage.getItem("firstCompare"));
	var second = JSON.parse(localStorage.getItem("secondCompare"));
	// debugger;
	return $("#header-compare").attr("href", "compare/" + first + '/' + second); 
};

addToCompare();

//Check have enough product to compare ?
function checkLocalStorage(){
	 $('#header-compare').click(function(e) {
	 	if (localStorage.getItem("firstCompare") == null || localStorage.getItem("secondCompare") == null) {
			e.preventDefault();
			alert(message('enough'));
		}
	});
};

checkLocalStorage();
