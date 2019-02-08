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

function filter(key) {
   return window.js_variable.filter[key];
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

/******************Search product by ajax**********************/

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

//Perform search product by ajax
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

//Add to value filter when user choose filter
var output = '<h4>' + filter('title') + '<span class="filter-value">' + GetURLParameter('val') + '</span>' +'</h4>';
$('#filter-place').html(output)

//Function to get param URL
function GetURLParameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++){
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
        {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
}

//User comment product
$(document).ready(function(){
       $("#comment-button").on("click", function(e){
        e.preventDefault();
        var userId = $(this).data('user');
        var productId = $(this).data('product');
        var content = $.trim($('textarea').val());
        var token = $(this).data("token");
        // debugger;
        if (content !== '') {
            $.ajax({
            url: 'product/comment',
            method:"POST",
            dataType:"JSON",
            data: {'userId':userId, 'productId':productId, 'content':content, '_token':token},
            success: function(data){ 
              // console.log(data);
                  var output = '';
                  output += '<li class="comment-border">';
                  output += '<article>';
                  output += '<div class="comment-des" data-comment="' + data.id + '">'
                  output += '<div class="comment-by">'
                  output += '<p class="author"><strong>You<span class="comment-time">Now</span></strong></p>'
                  output += '<span class="reply"><a class="add-reply">Reply</a></span>';
                  output += '</div>';
                  output += '<section>';
                  output += '<p>' + data.content + '</p>';
                  output += '</section>';
                  output += '</div>';
                  output += '</article>';
                  output += '<ol class="children" id="commentChildren">';
                  output += '</ol>';
                  output += '</li>';
                $('#commentList').html(output);
            }
            });
        }
    });
});

//Add reply form for comment
$(document).ajaxComplete(function(){
    $(".add-reply").click(function(){
        var output = '';
        output += '<h3>Add Your Reply<span>Cancel</span></h3>';
        output += '<div class="ratting-form row">';
        output += '<div class="col-12 mb-15">';
        output += '<textarea name="review" id="reply-content" placeholder="Write your reply"></textarea>';
        output += '</div>';
        output += '<div class="col-12">';
        output += '<input id="reply-button" value="Add Reply" type="submit">';
        output += '</div>';
        output += '</div>';
        $('#replyForm').html(output);
   });
});

//User reply comment
$(document).on('click', '#reply-button', function() {
    var commentId = $('.comment-des').data('comment');
    var userId = $('#comment-button').data('user');
    var token = $('#comment-button').data('token');
    var productId = $('#comment-button').data('product');
    var replyContent = $('#reply-content').val();
    if (replyContent !== '') {
            $.ajax({
            url: 'product/reply',
            method:"POST",
            dataType:"JSON",
            data: {'userId':userId, 'productId':productId, 'content':replyContent, '_token':token, 'parentComment':commentId},
            success: function(data){ 
              // console.log(data);
                  var output = '';
                  output += '<li class="comment-border">';
                  output += '<article>';
                  output += '<div class="comment-des" data-comment="' + data.id + '">'
                  output += '<div class="comment-by">'
                  output += '<p class="author"><strong>You<span class="comment-time">Now</span></strong></p>'
                  output += '<span class="reply"><a class="add-reply">Reply</a></span>';
                  output += '</div>';
                  output += '<section>';
                  output += '<p>' + data.content + '</p>';
                  output += '</section>';
                  output += '</div>';
                  output += '</article>';
                  output += '</li>';
                $('#commentChildren').html(output);
            }
            });
        }
});