//Make message disappear after times
$(document).ready(function() {
  $('div.alert').delay(5000).slideUp();
});

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

//Search product

//Delay a time before seach
function delay(callback, ms) {
  var timer = 0;
  return function() {
    var context = this, args = arguments;
    clearTimeout(timer);
    timer = setTimeout(function () {
      callback.apply(context, args);
    }, ms || 0);
  };
}

$(document).ready(function(){
	$('#product-name').keyup(delay(function(e){
		e.preventDefault();
		var query = $(this).val();
		// debugger;
        if (query != '' && query.length >= 2) {
        $.ajax({
          	url: 'product/search',
          	method: "GET",
          	data: {query: query},
          	dataType:"JSON",
          	success: function(data){
          		// console.log(data);
          		if (data.length > 0) {
          			var output = '<ul class="product-list">';
          			$.each(data, function(key, val){
		                output += '<li class="product-items"><a href="product/' + val.id + '">' + val.name +'</a></li>';
	                });
                    output += '</ul>';
                    // console.log(output);
	                $('#productList').html(output);
    	            $('#productList').fadeIn();
          		} else {
          			output = '';
              		$('#productList').html(output);
          		}
            }
        });
        } else {
        	$('#productList').fadeOut();
        }
    }, 1000));
});

//Disappear search result when click out of form
$(document).bind('click', function (event) {
    // Check if we have not clicked on the search box
    if (!($(event.target).parents().andSelf().is('#product-name'))) {
       $('#productList').fadeOut();
    }
});