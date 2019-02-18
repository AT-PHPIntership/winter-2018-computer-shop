/** HANDLE STATISTIC */
$(function() {
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
