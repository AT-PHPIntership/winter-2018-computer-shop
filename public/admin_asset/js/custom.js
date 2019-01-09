//Function use for datatable
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

//Put PHP variable to JS 
function define(key) {
  return window.js_variable.define[key];
}


 function trans(key) {
   return window.js_variable.trans[key];
}

 //Confirmed before delete
function confirmedDelete() {
  return confirm(trans('delete'));
} 

//Make message disappear after times
$(document).ready(function() {
  $('div.alert').delay(2000).slideUp();
});