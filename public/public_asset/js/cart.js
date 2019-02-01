// Định nghĩa một mảng các phần tử sẽ bỏ vào giỏ hàng
var shoppingCartItems = [];

$(document).ready(function () {
    // Kiểm tra nếu đã có localStorage["shopping-cart-items"] hay chưa?
    if (localStorage["shopping-cart-items"] != null) {
        shoppingCartItems = JSON.parse(localStorage["shopping-cart-items"].toString());
    }

    // Hiển thị thông tin từ giỏ hàng
    displayShoppingCartItems();
    displayCheckout();
});

// reload page
$(document).ready(function(){
    $('body').ready(function() {
        $('#totalQty').text(getTotalQty());
        $('#total-price').text(getTotalPrice());
        $('.number').text(getTotalItem());
        $('#js-total-price').text(getTotalPrice());
        displayCheckout();
        displayShoppingCartItems();
    })
});

// Sự kiện click các button có class=".add-to-cart"
$(".add-to-cart").click(function () {
    var button = $(this); // Lấy đối tượng button mà người dùng click
    var id = button.attr("id"); // id của sản phẩm là id của button
    var name = button.attr("data-name"); // name của sản phẩm là thuộc tính data-name của button
    var price = Number(button.attr("data-price").replace(/[^0-9\.-]+/g,""));// price của sản phẩm là thuộc tính data-price của button
    var quantity = 1; // Số lượng


    var item = {
        id: id,
        name: name,
        price: price,
        quantity: quantity
    };

    var exists = false;
    if (shoppingCartItems.length > 0) {
        $.each(shoppingCartItems, function (index, value) {
            // Nếu mặt hàng đã tồn tại trong giỏ hàng thì chỉ cần tăng số lượng mặt hàng đó trong giỏ hàng.
            if (value.id == item.id) {
                value.quantity++;
                exists = true;
                return false;
            }
        });
    }

    // Nếu mặt hàng chưa tồn tại trong giỏ hàng thì bổ sung vào mảng
    if (!exists) {
        shoppingCartItems.push(item);
    }

    // Lưu thông tin vào localStorage
    localStorage["shopping-cart-items"] = JSON.stringify(shoppingCartItems); // Chuyển thông tin mảng shoppingCartItems sang JSON trước khi lưu vào localStorage
    // Gọi hàm hiển thị giỏ hàng
    displayShoppingCartItems();
    displayCheckout();
});

// Xóa hết giỏ hàng shoppingCartItems
$("#button-clear").click(function () {
    shoppingCartItems = [];
    localStorage["shopping-cart-items"] = JSON.stringify(shoppingCartItems);
    $("#table-products > tbody").html("");
});




// Hiển thị giỏ hàng ra table
function displayShoppingCartItems() {
    if (localStorage["shopping-cart-items"] != null) {
        shoppingCartItems = JSON.parse(localStorage["shopping-cart-items"].toString()); // Chuyển thông tin từ JSON trong localStorage sang mảng shoppingCartItems.

        var itemc = 0;
        var totalPrice = 0;
        $("#table-products > tbody").html("");
        // Duyệt qua mảng shoppingCartItems để append từng item dòng vào table
        $.each(shoppingCartItems, function (index, item) {
            itemc++;
            totalPrice += item.price * item.quantity;
            var htmlString = "";
            htmlString += "<tr>";
            htmlString += "<td class=\"pro-thumbnail\"><a href=\"#\"><img src=\"\" alt=\"Product\"></a></td>";
            htmlString += "<td class=\"pro-title\"><a href=\"#\">" + item.name + "</a></td>";
            htmlString += "<td class=\"pro-price\">" + item.price + "</span></td>";
            htmlString += "<td class=\"pro-quantity\"><div class=\"pro-qty\"><span class=\"dec qtybtn\">-</span><input onchange=\"modifyCart(this)\" type=\"number\" id=\"data-value\" " + 
                        "value=\"" + item.quantity + "\"><span class=\"inc qtybtn\">+</span></div></td>";
            htmlString += "<td class=\"pro-subtotal\"><span> " + item.price * item.quantity + "</span></td>";
            htmlString += "<td class=\"\"><button type=\"button\" class=\"delete-product\" data-id=\"" + item.id + "\"><i class=\"fa fa-trash-o\"></i></button></td>";
            htmlString += "</tr>";

            $("#table-products > tbody:last").append(htmlString);

        });
    }

    $('.number').text(getTotalItem());
    $('#total-price').text(getTotalPrice());
};

// Hiển thị checkout
function displayCheckout() {
    if (localStorage["shopping-cart-items"] != null) {
        shoppingCartItems = JSON.parse(localStorage["shopping-cart-items"].toString()); // Chuyển thông tin từ JSON trong localStorage sang mảng shoppingCartItems.

        $("#table-checkout").html("");
        // Duyệt qua mảng shoppingCartItems để append từng item dòng vào table
        $.each(shoppingCartItems, function (index, item) {
            var htmlString = '';
            htmlString += '<li>' + item.name + ' X ' + item.quantity + '<span>' + item.quantity * item.price + '</span></li>';
            htmlString += '<input type="hidden" name="productId[]" value="' + item.id + '"></<input>'
            htmlString += '<input type="hidden" name="quantity[]" value="' + item.quantity + '"></<input>'
            htmlString += '<input type="hidden" name="subprice[]" value="' + item.quantity * item.price + '"></<input>'
            $("#table-checkout:last").append(htmlString);

        });
    }

    $('.number').text(getTotalItem());
    $('#total-price').text(getTotalPrice());
};

/*----- 
//     Quantity
// --------------------------------*/
// $('.pro-qty').prepend('<span class="dec qtybtn">-</span>');
// $('.pro-qty').append('<span class="inc qtybtn">+</span>');
// $('.qtybtn').on('click', function() {
//     var $button = $(this);
//     var oldValue = $button.parent().find('input').val();
//     if ($button.hasClass('inc')) {
//       var newVal = parseFloat(oldValue) + 1;
//     } else {
//        // Don't allow decrementing below zero
//       if (oldValue > 0) {
//         var newVal = parseFloat(oldValue) - 1;
//         } else {
//         newVal = 0;
//       }
//       }
//     $button.parent().find('input').val(newVal);
// });  
    

// $(document).ready(function(){
//     $('#checkout-form').on('submit', function(e){
//         // debugger;
//         alert($(".container").hasClass("alert-success"));
//         event.preventDefault();
//         shoppingCartItems = [];
//         localStorage["shopping-cart-items"] = JSON.stringify(shoppingCartItems);
//         displayCheckout();
//         displayShoppingCartItems();
//         $('#total-price').text(getTotalPrice());
//         $('.number').text(getTotalItem());
//     });
// });
// function deleteLocal() {
// //         console.log($(".container").hasClass("alert-success"));
// //         alert($(".container").hasClass("alert-success"));

// //     // if($(".container").hasClass("alert-success")){
// //     //     shoppingCartItems = [];
// //     //     localStorage["shopping-cart-items"] = JSON.stringify(shoppingCartItems);
// //     //     displayCheckout();
// //     //     displayShoppingCartItems();
// //     //     $('#total-price').text(getTotalPrice());
// //     //     $('.number').text(getTotalItem());
// //     // }
    

// // }


var deleteProduct = function () {
    console.log(shoppingCartItems);
    $(".delete-product").click(function () {
        console.log('demo');
        if (confirm("Bạn có muốn xóa sản phẩm này ra khỏi giỏ hàng không?")) {
            console.log('length : ' + shoppingCartItems.length);
            // if (shoppingCartItems.length === 1) {
            //     shoppingCartItems = [];
            // } else {    
                var item = $(this).attr('data-id');
                console.log('xoa id :' + item);
                // shoppingCartItems.splice(item, 1);
                shoppingCartItems = shoppingCartItems.filter(function(elem){
                    return elem.id != item;
                });
                console.log(shoppingCartItems);
            // }
            localStorage.setItem('shopping-cart-items',JSON.stringify(shoppingCartItems));
            $('#total-price').text(getTotalPrice());
            $('.number').text(getTotalItem());
            // $('#cart-popover').popover('hide');
            // displayShoppingCartItems();
            $(this).parent().parent().remove();
            // console.log($(this).parent().parent().html());
            alert('Bạn đả xóa sản phẩm ra khỏi giỏ hàng');
        }
    });
}

$(document).ready(function(){
    deleteProduct();
})

function getTotalItem() {
    var totalItem = 0;
    $.each(shoppingCartItems, function(key, value) {
        totalItem++;
    });
    return totalItem;
}


function getTotalQty() {
    var totalQty = 0;
    $.each(shoppingCartItems, function(key, value) {
        totalQty += value.quantity;
    });
    return totalQty;
}

function getTotalPrice() {
    var totalPrice = 0;
    $.each(shoppingCartItems, function(key, value) {
        totalPrice += value.quantity * value.price;
    });
    return totalPrice;
}

function modifyCart(e) {
    var qty = $(e).val();
    var idProduct = $(e).parent().parent().parent().find('button').attr("data-id");
    console.log(qty, idProduct);
    var quantity = parseInt(qty);
    for (var i = 0; i < shoppingCartItems.length; i++) {
        if (shoppingCartItems[i].id === idProduct) {
            if (quantity > 0) {
                shoppingCartItems[i].quantity = quantity;
                localStorage.setItem("shopping-cart-items",JSON.stringify(shoppingCartItems));
            } else {
                alert('Please enter quantity larger than 0');
            }
        }
    }

    // reload page
    $('#total-price').text(getTotalPrice());
    displayCheckout();
    displayShoppingCartItems();
//     $('#js-total-price').text(getTotalPrice());
//     showCart();
//     loadListCart();
//     removeCart();
}
