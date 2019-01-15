//Display children category when choose parent category
$(document).ready(function(){
       $("#parent_category").on("click", function(){
        var id = $(this).val();
        // console.log(id);
        $.ajax({
          url: 'admin/categories/sub-category/',
          method:"GET",
          dataType:"JSON",
          data: {id:id},
          success: function(data){ 
            // console.log(data);
            if (data.length  > 0) {
              var output = '<select name="category_id" class="form-control mb-3">';
              $.each(data, function(key, val){
                output += '<option value="'+ val.id + '">' + val.name + '</option>';
              });
              output += '</select>';
              $('#child_category').html(output);
            } else {
              output = '';
              $('#child_category').html(output);
            }
          }
       });
    });
});

//Format vietnamese currency
$(document).ready(function(){
$('#formatCurrency').on('input', function(e){        
    $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g,'')));
}).on('keypress',function(e){
    if(!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
}).on('paste', function(e){    
    var cb = e.originalEvent.clipboardData || window.clipboardData;      
    if(!$.isNumeric(cb.getData('text'))) e.preventDefault();
});
  function formatCurrency(number){
      var n = number.split('').reverse().join("");
      var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");    
      return  n2.split('').reverse().join('');
    }
});

//Function to conduct use datatable for product
$(function() {
      $('#product-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: 'admin/products/data',
      columns: [
              { data: 'id', name: 'id' },
              { data: 'name', name: 'name' },
              { data: 'category', name: 'category' },
              { data: 'unit_price', name: 'unit_price' },
              { data: 'quantity', name: 'quantity' },
              { data: 'action', name: 'action' },
            ]
    });
});

//Function use for user datatable
$(function() {
      $('#user-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: 'admin/users/data',
      columns: [
            { data: 'id', name: 'id' },
            { data: 'email', name: 'email' },
            { data: 'name', name: 'name' },
            { data: 'role', name: 'role' },
            { data: 'action', name: 'action' },
            ]
      });
});

//Function use for category datatable
$(function() {
$('#category-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: 'admin/categories/data',
      columns: [
              { data: 'id', name: 'id' },
              { data: 'name', name: 'name' },
              { data: 'image', name: 'image' },
              { data: 'action', name: 'action' },
            ]
      });
});

//Display children category when edit
$(document).ready(function(){
      (function(){ 
        var id = $('#parent_category').val();
        // console.log(id);
        $.ajax({
          url: 'admin/categories/sub-category/',
          method:"GET",
          dataType:"JSON",
          data: {id:id},
          success: function(data){ 
            // console.log(data);
            var childId = $('#parent_category').data('category-id');
            if (data.length  > 0) {
              var output = '<select name="category_id" class="form-control mb-3">';
              $.each(data, function(key, val){
                if (childId === val.id) {
                  output += '<option value="'+ val.id + '"' + 'selected>' + val.name + '</option>';

                } else {
                  output += '<option value="'+ val.id + '">' + val.name + '</option>';
                }
              });
              output += '</select>';
              $('#child_category').html(output);
            } else {
              output = '';
              $('#child_category').html(output);
            }
          }
       });
    })();
});

//Confirmed before delete
function confirmedDelete() {
  return confirm(trans('delete'));
} 
//Add class for table data to modify css
$(document).ajaxComplete(function() {
  if ($('table').attr("id") == "category-table") {
    $('td').addClass("category-index");
  }
});

//Make message disappear after times
$(document).ready(function() {
  $('div.alert').delay(2000).slideUp();
});
