/** Ajax promotion **/
$(document).ready(function () {
    $('#search-product').on('click', function (e) {
        e.preventDefault()
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
        var totalSold = $('.total_sold').val();
        var categoryId = $('.category_id').val();
        var priceProduct = $('.price_product').val();
        // console.log(priceProduct);
        $.ajax({

            url: 'admin/promotions/search',
            method: 'POST',
            dataType: 'JSON',
            data: { 
                'totalSold' : totalSold,
                'categoryId' : categoryId,
                'priceProduct' : priceProduct
            },
            success: function (data) {
                // console.log(data);
                if (data.length > 0) {
                    var output = '';
                    $.each(data, function (key, val) {
                        output += '<input class="checkbox-' + val.id + '" type="checkbox" value="' + val.id + 
                        '" name="productsId[]">' + val.name + ' - Price: ' + val.unit_price + ' - Total sold: ' + 
                        val.total_sold + '</input><br>';
                    });
                    // output += '</select>';
                    $('#product-promotion').html(output);
                } else if(data.length == 0) {
                    $(".print-error-msg").html('');

                    output = 'Not product';
                    $('#product-promotion').html(output);

                } else {
                    $('#product-promotion').html('');

                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display','block');
                    $.each(data.error, function( key, value ) {
                        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }
            }
        });
    });
});


// $(document).ready(function () {
//     $('#create-promotion').on('click', function (e) {
//         e.preventDefault()
//         $.ajaxSetup({
//                 headers: {
//                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 }
//             })
//         var totalSold = $('.total_sold').val();
//         var categoryId = $('.category_id').val();
//         var priceProduct = $('.price_product').val();
//         var namePromotion = $('.name-promotion').val();
//         var percent = $('.percent').val();
//         var startAt = $('.start_at').val();
//         var endAt = $('.end_at').val();
//         var productsPromotion = [];
//             $.each($("input[name='products-promotion']:checked"), function(){
//                 // productsPromotion.push($(this).val());
//                 productsPromotion.push(4);
//             console.log('productsPromotion');

//             });
//         // console.log(endAt + startAt + percent + namePromotion);
//         console.log(productsPromotion);
//         $.ajax({

//             url: 'admin/promotions',
//             method: 'POST',
//             dataType: 'JSON',
//             data: { 
//                 'totalSold' : totalSold,
//                 'categoryId' : categoryId,
//                 'priceProduct' : priceProduct,
//                 'namePromotion' : namePromotion,
//                 'percent' : percent,
//                 'startAt' : startAt,
//                 'endAt' : endAt,
//                 'productsPromotion' : productsPromotion,
//             },
//             success: function (data) {
//                 console.log(data);
//                 // if (data.length > 0) {
//                 //     var output = '';
//                 //     $.each(data, function (key, val) {
//                 //         output += '<input class="checkbox-' + val.id + '" type="checkbox" value="' + val.id + 
//                 //         '" name="products-promotion">' + val.name + ' - Price: ' + val.unit_price + ' - Total sold: ' + 
//                 //         val.total_sold + '</input><br>';
//                 //     });
//                 //     // output += '</select>';
//                 //     $('#product-promotion').html(output);
//                 // } else {
//                 //     output = 'Not product';
//                 //     $('#product-promotion').html(output);
//                 // }
//             }
//         });
//     });
// });







/** Ajax promotion **/




/****************Function for Product**************/
//Display children category when choose parent category
$(document).ready(function () {
    $('#parent_category').on('click', function () {
        var id = $(this).val();
        // console.log(id);
        if (id != null) {
            $.ajax({
                url: 'admin/categories/sub-category/',
                method: 'GET',
                dataType: 'JSON',
                data: { id: id },
                success: function (data) {
                    // console.log(data);
                    if (data.length > 0) {
                        var output =
                            '<select name="category_id" class="form-control mb-3 children-with-check" id="localStorage">';
                        $.each(data, function (key, val) {
                            output += '<option value="' + val.id + '">' + val.name + '</option>';
                        });
                        output += '</select>';
                        $('#child_category').html(output);
                    } else {
                        output = '';
                        $('#child_category').html(output);
                        $('#parent_category').attr('name', 'category_id');
                    }
                }
            });
        }
    });
});

/*************************/
//Get value of select option of category at Add Product page
$(document).ajaxComplete(function () {
    var autoSelect = $('#localStorage').find(':selected').val();
    localStorage.setItem('autoSelect', JSON.stringify(autoSelect));
    // console.log(autoSelect)
    $('#localStorage').change(function () {
        var manualSelect = $(this).val();
        localStorage.setItem('manualSelect', JSON.stringify(manualSelect));
        // debugger;
    });
});

//Format vietnamese currency
$(document).ready(function () {
    $('#formatCurrency')
        .on('input', function (e) {
            $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g, '')));
        })
        .on('keypress', function (e) {
            if (!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
        })
        .on('paste', function (e) {
            var cb = e.originalEvent.clipboardData || window.clipboardData;
            if (!$.isNumeric(cb.getData('text'))) e.preventDefault();
        });
    function formatCurrency(number) {
        var n = number.split('').reverse().join('');
        var n2 = n.replace(/\d\d\d(?!$)/g, '$&,');
        return n2.split('').reverse().join('');
    }
});

//Display children category when edit
$(document).ready(function () {
    (function () {
        var id = $('#parent_category').val();
        // console.log(id);
        if (id != null) {
            $.ajax({
                url: 'admin/categories/sub-category/',
                method: 'GET',
                dataType: 'JSON',
                data: { id: id },
                success: function (data) {
                    // console.log(data);
                    if ($('#parent_category').data('category-id') != null) {
                        var childId = $('#parent_category').data('category-id');
                    } else if (localStorage.getItem('manualSelect') != null) {
                        var childId = parseInt(
                            JSON.parse(localStorage.getItem('manualSelect'))
                        );
                    } else {
                        var childId = parseInt(
                            JSON.parse(localStorage.getItem('autoSelect'))
                        );
                    }
                    if (data.length > 0) {
                        var output =
                            '<select name="category_id" class="form-control mb-3" id="localStorage">';
                        $.each(data, function (key, val) {
                            if (childId === val.id) {
                                output += '<option value="' + val.id + '"' + 'selected>' + val.name + '</option>';
                            } else {
                                output += '<option value="' + val.id + '">' + val.name + '</option>';
                            }
                        });
                        output += '</select>';
                        $('#child_category').html(output);
                    } else {
                        output = '';
                        $('#child_category').html(output);
                        $('#parent_category').attr('name', 'category_id');
                    }
                }
            });
        }
    })();
});

//Delete a photo of a product 
$(document).ready(function () {
    $('.delete-image').on('click', function () {
        var imgProduct = confirm(element('image'));
        if (imgProduct) {
            var imageId = $(this).data('image-id');
            $("#deleteImage").val(imageId);
            $('#image-list .image-item[data-id=' + imageId + ']').remove();
        }
    });
});

/* Slider Section*/
//Delete a banner 
$(document).ready(function () {
    $('.button-image').on('click', function () {
        var imgProduct = confirm(element('image'));
        if (imgProduct) {
            var imageId = $(this).data('image-id');
            var token = $(this).data('token');
            $.ajax({
                url: 'admin/products/image',
                type: 'DELETE',
                dataType: 'JSON',
                data: { image: imageId, _token: token },
                success: function (data) {
                    // console.log(data);
                    $('#image-list .image-item[data-id=' + data.data.id + ']').remove();
                }
            });
        }
    });
});

//Display lightbox js
$(document).ready(function () {
    lightbox.option({
        wrapAround: true
    });
});

//Function to conduct use datatable for product
$(function () {
    $('#product-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'admin/products/data',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'category', name: 'category' },
            { data: 'unit_price', name: 'unit_price' },
            { data: 'discount', name: 'discount' },
            { data: 'total_sold', name: 'total_sold' },
            { data: 'action', name: 'action' }
        ]
    });
});

//Redirect to import page
$('#uploadFile').on('click', function (e) {
    e.preventDefault();
    location.href = 'admin/products/import';
});

/***************************************************************/
//Function use for category datatable
$(function () {
    $('#category-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'admin/categories/data',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'image', name: 'image' },
            { data: 'action', name: 'action' }
        ]
    });
});

//Add class for table data to modify css
$(document).ajaxComplete(function () {
    if ($('table').attr('id') == 'category-table') {
        $('td').addClass('category-index');
    }
});

/****************************************************************/

//Function use for user datatable
$(function () {
    $('#user-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'admin/users/data',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'email', name: 'email' },
            { data: 'name', name: 'name' },
            { data: 'role', name: 'role' },
            {data: "status",
                    "render": function (data) {
                        if (data == 'Online') {
                            return '<p class="status-online">' + data + '</p>';
                        } else {
                            return '<p>'+ data +'</p>';
                        }
                    }
            },
            { data: 'action', name: 'action' }
        ]
    });
});

//Check user online and style 
$(document).ajaxComplete(function () {
    if ($('.check_online:contains("Online")').length > 0) {
        $(".check_online").addClass("thisClass");
    }
});

//Confirmed before delete
function confirmedDelete(ele) {
    return confirm(element(ele));
}

//Confirmed before delete order
function confirmedDeleteOrder(orders) {
    return confirm(order(orders));
}

//Make message disappear after times
$(document).ready(function () {
    $('div.alert').delay(3000).slideUp();
});

/***********************Slide function***************************/
//Custom dropzone to validation things user input into
Dropzone.options.dropzone = {
    maxFiles: 10,
    addRemoveLinks: true,
    dragend: function () {
        confirm('Do you want to set these image to display homepage?');
    },
    success: function (file, response) {
        setTimeout(function () {
            alert(response.message);
        }, 1000);
    },
    error: function (file, response) {
        var message = response.errors.file.join('\n');
        setTimeout(function () {
            alert(message);
        }, 1000);
    }
};

//Delete a photo
$(document).ready(function () {
    $('.delete-banner').on('click', function () {
        var result = confirm(element('image'));
        if (result) {
            var imageId = $(this).data('image-id');
            var token = $(this).data('token');
            // debugger;
            $.ajax({
                url: 'admin/slides/image',
                type: 'DELETE',
                dataType: 'JSON',
                data: { image: imageId, _token: token },
                success: function (data) {
                    // console.log(data);
                    $('.display-banner[data-id=' + data.data.id + ']').remove();
                }
            });
        }
    });
});

//Check to display banner
$(document).ready(function () {
    $('.check-to-display').on('click', function () {
        var imageId = $(this).data('image-id');
        var token = $(this).data('token');
        if ($(this).prop("checked") == true) {
            var flag = 1;
        } else {
            var flag = 0;
        }
        $.ajax({
            url: 'admin/slides/flag',
            type: 'PUT',
            dataType: 'JSON',
            data: { imageId: imageId, _token: token, flag:flag },
            success: function (data) {
                // console.log(data);
                if (data.data == 1) {
                    alert('Check to display successfully!');
                } else {
                    alert('Cancel to display successfully!');
                }
            }
        });
    });
});


/** HANDLE STATISTIC */
$(function () {
    var ctx1 = $('#mycanvas');
    //doughnut chart data
    var data1 = {
        labels: ['Cancel Order', 'Pending Order', 'Approve Order'],
        datasets: [
            {
                label: 'Order Chart',
                data: [cancelOrder, pendingOrder, approveOrder],
                backgroundColor: ['#DEB887', '#A9A9A9', '#2E8B57'],
                borderColor: ['#CDA776', '#989898', '#1D7A46'],
                borderWidth: [1, 1, 1]
            }
        ]
    };

    //options
    var options = {
        responsive: true,
        title: {
            display: true,
            position: 'top',
            text: 'Order Chart',
            fontSize: 18,
            fontColor: '#111'
        },
        legend: {
            display: true,
            position: 'bottom',
            labels: {
                fontColor: '#333',
                fontSize: 16
            }
        }
    };

    //create Chart class object
    var chart1 = new Chart(ctx1, {
        type: 'doughnut',
        data: data1,
        options: options
    });
});

/** HANDLE STATISTIC */

//Save permission for roles
$(document).ready(function () {

    $('.checkAll').on('click', function () {
        var actions = [];
        var permissionId = $(this).data('permission-id');;
        $('input[type="checkbox"].check-' + permissionId).prop('checked', this.checked);
        $('.check-' + permissionId + ':checkbox:checked').each(function () {
            actions.push($(this).data('value'));
        });
        if ($(this).is( ":checked") == true) {
            $(this).attr('value', JSON.stringify(actions));
        } else {
            $(this).removeAttr('value')
        }
    });

    $('.uncheckAll').on("click", function () {
        var actions = [];
        var key = $(this).data('key');
        // var countAction = $('#collapse-' + key).data('count-action');
        var permissionId = $('#collapse-' + key).data('permission-id');
        // var numberCheck = $('input[type="checkbox"].check-' + permissionId + ':checked').length;
        $('.check-' + permissionId + ':checkbox:checked').each(function () {
            actions.push($(this).data('value'));
        });
        $('input[type="checkbox"].permission-' + key).prop( "checked", true);
        // if (numberCheck == countAction) {
        //     $('input[type="checkbox"].permission-' + key).prop( "checked", true);
        // } else {
        //     $('input[type="checkbox"].permission-' + key).prop( "checked", false);
        // }
        $('input[type="checkbox"].permission-' + key).attr('value', JSON.stringify(actions));
    });

    // //Save permission for roles
    // $('.save-permission').on('click', function () {
    //     var permission = [];
    //     var amountPermission = $(this).data('amount-permission');
    //     var roleId = $(this).data('role-id');
    //     var token = $(this).data('token');

    //     for (var i = 0; i < amountPermission; i++) {
    //         $.each(roleId, function(key, val) {
    //             let role = [];
    //             var actions = [];
    //             $('.permission-'+ i + '-' + val + ':checkbox').each(function () {
    //                 if ($(this).is(':checked') == true || $(this).data('action-value') != undefined) {
    //                     role.push($(this).data('role-id'));
    //                     actions.push($(this).data('action-value'));
    //                 }
    //             });
    //             let permissionId = $('th.permission-' + i).text();
    //             if (role.length > 0) {
    //                 let  result = {'role': role, 'id' : permissionId, 'actions': actions};
    //                 permission.push(result);
    //             }
    //         })
    //     }
    //     permission;
    //     debugger;
    //     $.ajax({
    //         url: 'admin/permissions/save',
    //         method: 'POST',
    //         dataType: 'JSON',
    //         data: { 'permissions': permission, '_token': token },
    //         success: function (data) {
    //             alert('Save permissions successfully!');
    //         },
    //         error: function (data) {
    //             alert(data.responseJSON.errors.role[0]);
    //             document.location.reload(true);
    //         }

    //     });
    // });
});
