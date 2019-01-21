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

//Add class for table data to modify css
$(document).ajaxComplete(function() {
  if ($('table').attr("id") == "category-table") {
    $('td').addClass("category-index");
  }
});

 //Confirmed before delete
function confirmedDelete() {
  return confirm(trans('delete'));
} 

//Make message disappear after times
$(document).ready(function() {
  $('div.alert').delay(2000).slideUp();
});