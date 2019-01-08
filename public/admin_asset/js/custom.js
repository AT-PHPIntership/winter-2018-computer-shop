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
