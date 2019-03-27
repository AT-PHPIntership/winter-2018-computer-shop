//Make message disappear after times
$(document).ready(function () {
    $('div.alert').delay(5000).slideUp();
});

//Display lightbox js
$(document).ready(function () {
    lightbox.option({
        wrapAround: true
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

function search(key) {
    return window.js_variable.search[key];
}

function order(key) {
    return window.js_variable.order[key];
}

function comment(key) {
    return window.js_variable.comment[key];
}

//Confirmed before delete order
function confirmedDelete() {
    return confirm(order('delete'));
}

// Save product in oder to compare to localStoreage
$(document).ready(function () {
    $('.compare-page').on('click', function () {
        var product = $(this).data('product');
        if (localStorage.getItem('firstCompare') === null) {
            localStorage.setItem('firstCompare', JSON.stringify(product));
            addToCompare();
            alert(message('first'));
        } else if (localStorage.getItem('secondCompare') === null) {
            localStorage.setItem('secondCompare', JSON.stringify(product));
            addToCompare();
            alert(message('second'));
        } else {
            alert(message('only'));
        }
    });
});

//Delete product to compare
$(document).ready(function () {
    $('.delete-compare').on('click', function () {
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
function addToCompare() {
    var first = JSON.parse(localStorage.getItem('firstCompare'));
    var second = JSON.parse(localStorage.getItem('secondCompare'));
    // debugger;
    return $('#header-compare').attr('href', 'compare/' + first + '/' + second);
}

addToCompare();

//Check have enough product to compare ?
function checkLocalStorage() {
    $('#header-compare').click(function (e) {
        if (
            localStorage.getItem('firstCompare') == null ||
            localStorage.getItem('secondCompare') == null
        ) {
            e.preventDefault();
            alert(message('enough'));
        }
    });
}

checkLocalStorage();

/******************Search product by ajax**********************/

//Delay a time before seach
function delay(callback, ms) {
    var timer = 0;
    return function () {
        var context = this,
            args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}

//Perform search product by ajax
$(document).ready(function () {
    $('#product-name').keyup(
        delay(function (e) {
            e.preventDefault();
            var query = $(this).val();
            // debugger;
            if (query != '' && query.length >= 2) {
                $.ajax({
                    url: 'product/search',
                    method: 'GET',
                    data: { query: query },
                    dataType: 'JSON',
                    success: function (data) {
                        // console.log(data);
                        if (data.length > 0) {
                            var output = '<ul class="product-list">';
                            $.each(data, function (key, val) {
                                output += '<li class="product-items"><a href="product/' + val.id + '">' + val.name + '</a></li>';
                            });
                            output += '</ul>';
                            // console.log(output);
                            $('#productList').html(output);
                            $('#productList').fadeIn();
                        } else {
                            output = search('result');
                            $('#productList').html(output);
                            $('#productList').fadeIn();
                        }
                    }
                });
            } else {
                $('#productList').fadeOut();
            }
        }, 1000)
    );
});

//Disappear search result when click out of form
$(document).bind('click', function (event) {
    // Check if we have not clicked on the search box
    if (!$(event.target).parents().andSelf().is('#product-name')) {
        $('#productList').fadeOut();
    }
});

//Prevent user click search button but don't input anything
$(document).on('click', '.search-button', function () {
    var input = $("#product-name").val();
    if (input == "") {
        return false;
    }
});

//User comment product
$(document).ready(function () {
    $('#comment-button').on('click', function () {
        var userId = $(this).data('user');
        var productId = $(this).data('product');
        var content = $('#comment-text').val();
        var token = $(this).data('token');
        var rate = $('input[name=rating]:checked', '.star-rating').val();
        // debugger;
        if (userId != undefined) {
                $.ajax({
                    url: 'product/comment',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        userId: userId,
                        productId: productId,
                        content: content,
                        rate: rate,
                        _token: token
                    },
                    success: function (data) {
                        // console.log(data['comment']);
                        var output = '';
                        output += '<li class="comment-border" data-id=' + data['comment'].id + '>';
                        output += '<article id=' + data['comment'].id + '>';
                        output += '<div class="comment-des">';
                        output += '<div class="comment-by">';
                        output += '<p class="author"><strong>' + comment('author') + '<span class="comment-time">' + comment('time') + '</span></strong></p>';
                        output += '<span class="reply"><a class="add-reply" id=' + data['comment'].id + '>' + comment('reply') + '</a></span>';
                        output += '<div class="star-rating star-result">';
                        for( var i = 5; i > 0; i--) {
                            if (data['comment'].star == i) {
                                output += `<input id="star-${i}" type="radio" name="rating-${data['comment'].id}" value="${i}" checked>
                                <label for="star-${i}" title="${i} stars">
                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>`;
                            } else {
                                output += `<input id="star-${i}" type="radio" name="rating-${data['comment'].id}" value="${i}">
                                <label for="star-${i}" title="${i} stars">
                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>`;
                            }
                        }
                        output += '</div>';
                        output += '</div>';
                        output += '<section>';
                        if (data['comment'].content == null) {
                            output += '<p>' + ' ' + '</p>';
                        } else {
                            output += '<p>' + data['comment'].content + '</p>';
                        }
                        output += '</section>';
                        output += '</div>';
                        output += '</article>';
                        output += '</li>';
                        $('#commentList').append(output);
                        $('#comment-text').val('');
                        var avgInForm = '';
                        avgInForm += `<div class="pro-avg-ratting">
                                        <h4>${data['avgRate'].toFixed(2)}  <span>(Overall)</span></h4>
                                            <span>Based on ${data['numberEachStar'].length} Comments</span>
                                        </div>
                                        <div class="ratting-list number-each-star">`;
                                            for (var i = 5; i > 0; i--) {
                                                avgInForm += '<div class="sin-list float-left">';
                                                for (var j = 1; j <= 5; j++) {
                                                    if (j <= i) {
                                                        avgInForm += '<i class="fa fa-star"></i>'
                                                    }
                                                }
                                                avgInForm += `<span>(${data['numberEachStar'].filter(ele => ele == i).length})</span>`;
                                                avgInForm += '</div>';
                                            }
                        avgInForm +=  `</div>`;
                        $('#avg-by-form ').html(avgInForm);
                        var avgInProduct = '';
                            for (var i = 1; i <= 5; i++) {
                                if(data['avgRate'] % 1 !== 0) {
                                    if ((parseInt(data['avgRate']) + 1) == i) {
                                        avgInProduct += '<i class="fa fa-star-half-o"></i>';
                                    } else if ((parseInt(data['avgRate']) + 2) <= i) {
                                        avgInProduct += '<i class="fa fa-star-o"></i>';
                                    } else {
                                        avgInProduct += '<i class="fa fa-star"></i>';
                                    }
                                }  
                                if (data['avgRate'] % 1 == 0) {
                                    if (data['avgRate'] >= i) {
                                        avgInProduct += '<i class="fa fa-star"></i>';
                                    } else {
                                        avgInProduct += '<i class="fa fa-star-o"></i>';
                                    }
                                }
                            }
                        $('#avg-in-product').html(avgInProduct);
                    }
                });
        } else {
            location.href = 'login';
        }
    });
});

//Add reply form for comment
$(document).on('click', '.add-reply', function () {
    if ($('.add-reply').attr('disabled') !== 'disabled') {
        var articleId = $(this).attr('id');
        var output = '';
        output += '<div class="replyForm" id=' + articleId + '>';
        output += '<h3>' + comment('add') + '<a class="cancelRely">' + comment('cancel') + '</a></h3>';
        output += '<div class="ratting-form row">';
        output += '<div class="col-12 mb-15">';
        output += '<textarea name="review" id="reply-content" placeholder="' + comment('write') + '"></textarea>';
        output += '</div>';
        output += '<div class="col-12">';
        output += '<input id="reply-button" value="' + comment('addReply') + '" data-comment=' + articleId + ' type="submit">';
        output += '</div>';
        output += '</div>';
        output += '</div>';
        $('article#' + articleId).append(output);
        $('.add-reply').attr('disabled', 'disabled');
    } else {
        return false;
    }
});

//Cancel reply form
$(document).on('click', '.cancelRely', function () {
    var cancelId = $('.replyForm').attr('id');
    $('div .replyForm[id=' + cancelId + ']').remove();
    $('.add-reply').removeAttr('disabled');
});

//User reply comment
$(document).on('click', '#reply-button', function () {
    var commentId = $(this).data('comment');
    var userId = $('#comment-button').data('user');
    var token = $('#comment-button').data('token');
    var productId = $('#comment-button').data('product');
    var replyContent = $('#reply-content').val();
    // debugger;
    if (userId != undefined) {
        if (replyContent !== '') {
            $.ajax({
                url: 'product/reply',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    userId: userId,
                    productId: productId,
                    content: replyContent,
                    _token: token,
                    parentComment: commentId
                },
                success: function (data) {
                    // console.log(data.parent_id);
                    var output = '';
                    output += '<ol class="children" id="commentChildren">';
                    output += '<li class="comment-border" id=' + data.id + '>';
                    output += '<article id=' + data.id + '>';
                    output += '<div class="comment-des">';
                    output += '<div class="comment-by">';
                    output += '<p class="author"><strong>' + comment('author') + '<span class="comment-time">' + comment('time') + '</span></strong></p>';
                    output += '</div>';
                    output += '<section>';
                    output += '<p>' + data.content + '</p>';
                    output += '</section>';
                    output += '</div>';
                    output += '</article>';
                    output += '</li>';
                    output += '</ol>';
                    $('div .replyForm[id=' + data.parent_id + ']').remove();
                    $('.comment-border[data-id=' + data.parent_id + ']').append(output);
                    $('.add-reply').removeAttr('disabled');
                }
            });
        }
    } else {
        location.href = 'login';
    }
});

//Multiple filter product 
$(document).ready(function () {

//Use ajax get data based on condition
function filterProductFunction() {
    var filterValue = JSON.parse(localStorage["filterProduct"].toString());
    $.ajax({
        url: 'product/filter',
        method:"get",
        dataType:"JSON",
        data: {filterValue},
        success: function(data){
            if (data['products'].length > 0) {
                var result = template(data);
                $('#filter-result').html(result);
            } else {
                var result = '<h3 class="text-danger no-product">No product found!</h3>';
                $('#filter-result').html(result);
            }
        }
    });
}

function formatCurrencyVN(price){
    return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(price);
}

function template(data) {
    var output = '';
    $.each(data['products'], function (key, val) {
        output += `<div class="col-xl-3 col-lg-4 col-md-6 col-12 pb-30 pt-10">
        <!-- Product Start -->
        <div class="ee-product">
            <!-- Image -->
            <div class="image">
                <a href="product/${val.id}" class="img"><img src="storage/product/${val.image.name}" alt="Product Image"></a>
                <div class="wishlist-compare">
                    <a class="compare-page" data-product="${val.id}" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a>
                </div>
                <a href="cart" id="${val.id}" data-name="${val.name}" data-price="${val.unit_price}" data-quantity="${val.quantity}" data-image="${val.image.name}" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>
            </div>
            <!-- Content -->
            <div class="content">
                <!-- Category & Title -->
                <div class="category-title">
                    <a href="category/${val.category_id}" class="cat">${val.category_name}</a>
                    <h5 class="title"><a href="product/${val.id}">${val.name}</a></h5>
                </div>
                <!-- Price & Ratting -->
                <div class="price-ratting">`
                if (val.promotion.length > 0) {
                    output +=  '<h5 class="price"><span class="old">' + formatCurrencyVN(val.unit_price) + '</span>'+ formatCurrencyVN(val.unit_price - (val.unit_price * val.promotion[0].percent)/100) + '</h5>&nbsp;<span class="label-sale">' + val.promotion[0].percent + '%' + '</span>';
                } else {
                    output +=  '<h5 class="price">' + formatCurrencyVN(val.unit_price) + '</h5>';
                }
                output +=`</div>
                        </div>
                    </div><!-- Product End -->
                    </div>`;
    });
    return output;
}
//Check filterProduct has in localStorage
function removeFilterProductInLocal() {
    if (localStorage.getItem('filterProduct') != null) {
        localStorage.removeItem('filterProduct');
    }
}
removeFilterProductInLocal();

//Add condition to filter 
$(document).on('click', '.filter-product', function () {
    var type = $(this).data('type');
    var query = $(this).data('query');
    var name = $(this).text();
    var condition = {'type' : type, 'query' : query, 'name': name};
    if (localStorage.getItem('filterProduct') != null) {
        var filterProduct = JSON.parse(localStorage["filterProduct"].toString());
        var filterVal = filterProduct.find(function(element) {
            return element['type'] == type;
        });
        if (filterVal == undefined) {
            filterProduct.push(condition);
        } else {
            Object.assign(filterVal, condition);
        }
        localStorage["filterProduct"] = JSON.stringify(filterProduct);
    } else {
        localStorage.setItem("filterProduct", JSON.stringify([condition]));
    }   
        //Append condition to DOM
        $('#filter-place li').remove();
        var filterProduct = JSON.parse(localStorage["filterProduct"].toString());
        var output = '';
        $.each(filterProduct, function(key, element) {
            if (element.type != 'Sort') {
                output += '<li class="filter-list active-filter-item ml-10" data-type=' + element.type + '>' + element.name + ' ' + '<i class="fa fa-window-close remove-filter" aria-hidden="true"></i></li>';
            }
        })
        $('#filter-place').append(output);
        var deleteAll = '<li class="filter-list delete-all ml-10">Delete All <i class="fa fa-window-close" id="delete-all" aria-hidden="true"></i></li>';
        var findHasOther = filterProduct.find(function(element) {
            return element['type'] != 'Sort';
        });
        if (findHasOther != undefined) {
            $('#filter-place').append(deleteAll);
        }

        //Perform ajax get data
        filterProductFunction();
    });

   //Remove condition to filter product
    $(document).on('click', '.remove-filter', function () {
        var removeType = $(this).parent().data('type');
        $('li.filter-list[data-type=' + removeType + ']').remove();
        var removeFilterInLocal = JSON.parse(localStorage["filterProduct"].toString());
        var indexObject = removeFilterInLocal.findIndex(element => element.type == removeType);
        removeFilterInLocal.splice(indexObject, 1);
        localStorage["filterProduct"] = JSON.stringify(removeFilterInLocal);
        var findHasOther = removeFilterInLocal.find(function(element) {
            return element['type'] != 'Sort';
        });
        var findHasSort = removeFilterInLocal.find(function(element) {
            return element['type'] == 'Sort';
        });
        if (removeFilterInLocal.length == 0 || (findHasOther == undefined && findHasSort != undefined)) {
            removeFilterProductInLocal();
            $('li.delete-all').remove();
            window.location.reload(true);
        }

        //Perform ajax get data
        filterProductFunction();
    });

    //Remove all condition
    $(document).on('click', '.delete-all', function () {
        $('#filter-place li').remove();
        $('li.delete-all').remove();
        removeFilterProductInLocal();
        window.location.reload(true);
    });

    
});

