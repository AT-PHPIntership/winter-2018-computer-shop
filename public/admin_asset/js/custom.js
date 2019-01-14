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
$(document).ready(function(){
 lightbox.option({
      'positionFromTop': 150,
      'wrapAround': true
    })
});