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

/** HANDLE STATISTIC */


$(function(){


// var langs =  {{ json_decode($arrayData['totalProduct']); }};
//     console.log(langs);
  //get the doughnut chart canvas
  var ctx1 = $("#mycanvas");

  //doughnut chart data
  var data1 = {
    labels: ["Cancel Order", "Pending Order", "Approve Order"],
    datasets: [
      {
        label: "Order Chart",
        data: [cancelOrder, pendingOrder, approveOrder],
        backgroundColor: [
          "#DEB887",
          "#A9A9A9",
          "#2E8B57"
        ],
        borderColor: [
          "#CDA776",
          "#989898",
          "#1D7A46"
        ],
        borderWidth: [1, 1, 1]
      }
    ]
  };

  //options
  var options = {
    responsive: true,
    title: {
      display: true,
      position: "top",
      text: "Order Chart",
      fontSize: 18,
      fontColor: "#111"
    },
    legend: {
      display: true,
      position: "bottom",
      labels: {
        fontColor: "#333",
        fontSize: 16
      }
    }
  };

  //create Chart class object
  var chart1 = new Chart(ctx1, {
    type: "doughnut",
    data: data1,
    options: options
  });

});

/** HANDLE STATISTIC */
