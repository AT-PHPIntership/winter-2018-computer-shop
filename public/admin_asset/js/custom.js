//Function use for datatable
$(function() {
      $('#category-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: 'admin/categories/data',
      columns: [
              { data: 'id', name: 'id' },
              { data: 'name', name: 'name' },
              { data: 'action', name: 'action' },
            ]
      });
});