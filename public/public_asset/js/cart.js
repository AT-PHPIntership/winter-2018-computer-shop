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
    displayMiniCart();
});


// reload page
$(document).ready(function () {
    $('body').ready(function () {
        $('#totalQty').text(getTotalQty());
        $('.total-price').text(getTotalPrice());
        $('#amout-price').text(getAmount());
        $('#grand-price').text(getGrandTotal());

        $('.number').text(getTotalItem());
        $('#js-total-price').text(getTotalPrice());
    })
});

// Sự kiện click các button có class=".add-to-cart"
$(document).on('click', '.add-to-cart', function () {

    var id = $(this).attr("id"); // id của sản phẩm là id của button
    var name = $(this).attr("data-name"); // name của sản phẩm là thuộc tính data-name của button
    var price = Number($(this).attr("data-price").replace(/[^0-9\.-]+/g, ""));// price của sản phẩm là thuộc tính data-price của button
    // console.log(quantityValue);

    if ($('#quantity-value').val() != undefined) {
        var quantity = $('#quantity-value').val(); // Số lượng
    } else {
        quantity = 1;
    }

    var productImage = $(this).data('image');
    var totalQuantity = $(this).data('quantity');


    var item = {
        id: id,
        name: name,
        price: price,
        quantity: quantity,
        image: productImage,
        totalQuantity: totalQuantity
    };

    var exists = false;
    if (shoppingCartItems.length > 0) {
        $.each(shoppingCartItems, function (index, value) {
            // Nếu mặt hàng đã tồn tại trong giỏ hàng thì chỉ cần tăng số lượng mặt hàng đó trong giỏ hàng.
            if (value.id == item.id) {
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
    displayMiniCart();

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
            totalPrice = item.price * item.quantity;
            var output =
                `<tr>
              <td class="pro-thumbnail"><a href="product/${item.id}"><img src="storage/product/${item.image}" alt="Product" width="90" height="60"></a></td>
              <td class="pro-title"><a href="product/${item.id}">${item.name}</a></td>
              <td class="pro-price">${item.price.toLocaleString('en-VN', { style: 'currency', currency: 'VND' })}</span></td>
              <td class="pro-quantity"><div class="pro-qty"><input class="original-quantity" type='number' onchange="modifyCart(this)" id="data-value"
                value="${item.quantity}"></div></td>
              <td class="pro-subtotal"><span>${totalPrice.toLocaleString('en-VN', { style: 'currency', currency: 'VND' })}</span></td>
              <td class=""><button type="button" class="delete-product text-danger" data-id="${item.id}"><i class="fa fa-trash-o"></i></button></td>
              </tr>`;
            $("#table-products > tbody:last").append(output);

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
            totalPrice = item.price * item.quantity;

            let output =
                `<li>${item.name} X ${item.quantity}<span>${totalPrice.toLocaleString('en-VN', { style: 'currency', currency: 'VND' })}</span></li>
              <input type="hidden" name="productId[]" value="${item.id}"></<input>
              <input type="hidden" name="quantity[]" value="${item.quantity}"></<input>
              <input type="hidden" name="subprice[]" value="${totalPrice}"></<input>`;
            $("#table-checkout:last").append(output);

        });
    }
    $('.number').text(getTotalItem());
    $('.total-price').text(getTotalPrice());
};

// Hiển thị checkout
function displayMiniCart() {
    if (localStorage["shopping-cart-items"] != null) {
        shoppingCartItems = JSON.parse(localStorage["shopping-cart-items"].toString()); // Chuyển thông tin từ JSON trong localStorage sang mảng shoppingCartItems.

        $(".mini-cart-products").html("");
        // Duyệt qua mảng shoppingCartItems để append từng item dòng vào table
        $.each(shoppingCartItems, function (index, item) {
            let output =
                `<li class="mini-cart-content">
              <a class="image"><img src="storage/product/${item.image}" alt="Product" width="90" height="60"></a>
              <div class="mini-cart-content">
              <p class="title">${item.name}</p>
              <span class="mini-cart-price">Price: ${item.price.toLocaleString('en-VN', { style: 'currency', currency: 'VND' })}</span>
              <span class="mini-cart-qty">Qty: ${item.quantity}</span>
              </div>
              </li>`;
            $(".mini-cart-products:last").append(output);
        });
    }

    $('.number').text(getTotalItem());
    $('.total-price').text(getTotalPrice());
};

var deleteProduct = function () {
    // console.log(shoppingCartItems);
    $(".delete-product").click(function () {
        // console.log('demo');
        if (confirm("Bạn có muốn xóa sản phẩm này ra khỏi giỏ hàng không?")) {
            // console.log('length : ' + shoppingCartItems.length);
            // if (shoppingCartItems.length === 1) {
            //     shoppingCartItems = [];
            // } else {    
            var item = $(this).attr('data-id');
            // console.log('xoa id :' + item);
            // shoppingCartItems.splice(item, 1);
            shoppingCartItems = shoppingCartItems.filter(function (elem) {
                return elem.id != item;
            });
            // console.log(shoppingCartItems);
            // }
            localStorage.setItem('shopping-cart-items', JSON.stringify(shoppingCartItems));
            $('#total-price').text(getTotalPrice());
            $('.number').text(getTotalItem());
            // $('#cart-popover').popover('hide');
            // displayShoppingCartItems();
            // displayShoppingCartItems();
            // displayCheckout();
            displayMiniCart();
            $(this).parent().parent().remove();
            // console.log($(this).parent().parent().html());
            alert('Bạn đã xóa sản phẩm ra khỏi giỏ hàng');
        }
    });
}

$(document).ready(function () {
    deleteProduct();
})

function getTotalItem() {
    var totalItem = 0;
    $.each(shoppingCartItems, function (key, value) {
        totalItem++;
    });
    return totalItem;
}


function getTotalQty() {
    var totalQty = 0;
    $.each(shoppingCartItems, function (key, value) {
        totalQty += value.quantity;
    });
    return totalQty;
}

function getTotalPrice() {
    var totalPrice = 0;
    $.each(shoppingCartItems, function (key, value) {
        totalPrice += value.quantity * value.price;
    });
    // return totalPrice;
    return totalPrice.toLocaleString('en-VN', { style: 'currency', currency: 'VND' });
}

// console.log(amount);
function getAmount() {
    if (document.getElementById('codeId')) {
        var totalPrice = 0;
        $.each(shoppingCartItems, function (key, value) {
            totalPrice += value.quantity * value.price;
        });
        var amoutPrice = totalPrice * amount / 100;
        return amoutPrice.toLocaleString('en-VN', { style: 'currency', currency: 'VND' });
    }
}

function getGrandTotal() {
    if (document.getElementById('codeId')) {

        var totalPrice = 0;
        $.each(shoppingCartItems, function (key, value) {
            totalPrice += value.quantity * value.price;
        });
        var grandPrice = totalPrice - (totalPrice * amount / 100);
        return grandPrice.toLocaleString('en-VN', { style: 'currency', currency: 'VND' });
    } else {
        return getTotalPrice();
    }
}

function modifyCart(e) {
    var qty = $(e).val();
    var idProduct = $(e).parent().parent().parent().find('button').attr("data-id");
    // console.log(qty, idProduct);
    var quantity = parseInt(qty);
    for (var i = 0; i < shoppingCartItems.length; i++) {
        // console.log(shoppingCartItems[i].quantity);s
        if (shoppingCartItems[i].id === idProduct) {
            if (quantity > shoppingCartItems[i].totalQuantity) {
                alert('The quantity you will buy bigger than total quantity available of this product!');
                quantity = shoppingCartItems[i].quantity;
            }
            if (quantity > 0) {
                shoppingCartItems[i].quantity = quantity;
                localStorage.setItem("shopping-cart-items", JSON.stringify(shoppingCartItems));
            } else {
                alert('Please enter quantity larger than 0');
            }
        }
    }

    // reload page
    $('#total-price').text(getTotalPrice());
    displayShoppingCartItems();
    displayMiniCart();
    deleteProduct();

}

