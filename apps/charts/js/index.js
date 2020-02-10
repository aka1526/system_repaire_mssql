$(document).ready(function() {

});

function popitup(url, windowName) {
    newwindow = window.open(url, windowName, 'height=600,width=450');
    if (window.focus) { newwindow.focus() }
    return false;
}

function popupWindow(url, title, win, w, h) {
    const y = win.top.outerHeight / 2 + win.top.screenY - (h / 2);
    const x = win.top.outerWidth / 2 + win.top.screenX - (w / 2);
    return win.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + y + ', left=' + x);
}


function myFunction(id) {
    var url = "index.php?page=inventory/edit&inventory_id=" + id;
    popupWindow(url, "Title Bar", window, 1000, 600);
}


$(function() {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    //var areaChartCanvas = $('#areaChart').get(0).getContext('2d')


    var assetchartData = {
        labels:   arr_asset_lbl,
        datasets: [{
                label: 'Summary Computer By Section',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: true,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: arr_sec_total_asset,//  Data Arry
            }
            // ,
            // {
            //     label: 'Electronics',
            //     backgroundColor: 'rgba(210, 214, 222, 1)',
            //     borderColor: 'rgba(210, 214, 222, 1)',
            //     pointRadius: false,
            //     pointColor: 'rgba(210, 214, 222, 1)',
            //     pointStrokeColor: '#c1c7d1',
            //     pointHighlightFill: '#fff',
            //     pointHighlightStroke: 'rgba(220,220,220,1)',
            //     data: [65, 59, 80, 81, 56, 55, 40, 0, 0, 0, 0, 0]
            // },
        ]
    }


    var areaChartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
                label: 'Repaire Computer',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: true,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: arr_repaire_month,//  Data Arry
            }
            // ,
            // {
            //     label: 'Electronics',
            //     backgroundColor: 'rgba(210, 214, 222, 1)',
            //     borderColor: 'rgba(210, 214, 222, 1)',
            //     pointRadius: false,
            //     pointColor: 'rgba(210, 214, 222, 1)',
            //     pointStrokeColor: '#c1c7d1',
            //     pointHighlightFill: '#fff',
            //     pointHighlightStroke: 'rgba(220,220,220,1)',
            //     data: [65, 59, 80, 81, 56, 55, 40, 0, 0, 0, 0, 0]
            // },
        ]
    }

    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: true
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false,
                },
                ticks: {
                    beginAtZero: true
                }

            }],
            yAxes: [{
                gridLines: {
                    display: false,
                },

            }]
        }
    }

    // This will get the first returned node in the jQuery collection.
    // var areaChart = new Chart(areaChartCanvas, {
    //     type: 'line',
    //     data: areaChartData,
    //     options: areaChartOptions
    // })

    //-------------
    //- LINE CHART -
    //--------------
    //  var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    // lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    // var lineChart = new Chart(lineChartCanvas, {
    //     type: 'line',
    //     data: lineChartData,
    //     options: lineChartOptions
    // })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#inventoryChart').get(0).getContext('2d')
    var donutData = {
        //labels: ['Chrome','IE','FireFox','Safari','Opera','Navigator','Navigr',],
        labels: arr_lable,
        datasets: [{
            data: arr_lable_val,
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#d2d6de'],
        }]
    }
    var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    //var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = donutData;
    var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        // var pieChart = new Chart(pieChartCanvas, {
        //     type: 'pie',
        //     data: pieData,
        //     options: pieOptions
        // })

    //-------------
    //- BAR CHART -
    //-------------
	
	var barChartAssetCanvas = $('#barChartasset').get(0).getContext('2d')
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
	var barChartAssetData = jQuery.extend(true, {}, assetchartData)
    var temp0 = areaChartData.datasets[0]
        //var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp0
        // barChartData.datasets[1] = temp0

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
		
    }

    var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })

	var barChartasset = new Chart(barChartAssetCanvas, {
			type: 'bar',
			data: barChartAssetData,
			options: barChartOptions
		})



})

$(function() {
    /*
     * Flot Interactive Chart
     * -----------------------
     */
    // We use an inline data source in the example, usually data would
    // be fetched from a server
    var data = [],
        totalPoints = 100

    function getRandomData() {

        if (data.length > 0) {
            data = data.slice(1)
        }

        // Do a random walk
        while (data.length < totalPoints) {

            var prev = data.length > 0 ? data[data.length - 1] : 50,
                y = prev + Math.random() * 10 - 5

            if (y < 0) {
                y = 0
            } else if (y > 100) {
                y = 100
            }

            data.push(y)
        }

        // Zip the generated y values with the x values
        var res = []
        for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]])
        }

        return res
    }

    var interactive_plot = $.plot('#interactive', [{
        data: getRandomData(),
    }], {
        grid: {
            borderColor: '#f3f3f3',
            borderWidth: 1,
            tickColor: '#f3f3f3'
        },
        series: {
            color: '#3c8dbc',
            lines: {
                lineWidth: 2,
                show: true,
                fill: true,
            },
        },
        yaxis: {
            min: 0,
            max: 100,
            show: true
        },
        xaxis: {
            show: true
        }
    })

    var updateInterval = 500 //Fetch data ever x milliseconds
    var realtime = 'on' //If == to on then fetch data every x seconds. else stop fetching
    function update() {

        interactive_plot.setData([getRandomData()])

        // Since the axes don't change, we don't need to call plot.setupGrid()
        interactive_plot.draw()
        if (realtime === 'on') {
            setTimeout(update, updateInterval)
        }
    }

    //INITIALIZE REALTIME DATA FETCHING
    if (realtime === 'on') {
        update()
    }
    //REALTIME TOGGLE
    $('#realtime .btn').click(function() {
            if ($(this).data('toggle') === 'on') {
                realtime = 'on'
            } else {
                realtime = 'off'
            }
            update()
        })
        /*
         * END INTERACTIVE CHART
         */


    /*
     * LINE CHART
     * ----------
     */
    //LINE randomly generated data

    var sin = [],
        cos = []
    for (var i = 0; i < 14; i += 0.5) {
        sin.push([i, Math.sin(i)])
        cos.push([i, Math.cos(i)])
    }
    var line_data1 = {
        data: sin,
        color: '#3c8dbc'
    }
    var line_data2 = {
        data: cos,
        color: '#00c0ef'
    }

    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
        position: 'absolute',
        display: 'none',
        opacity: 0.8
    }).appendTo('body')
    $('#line-chart').bind('plothover', function(event, pos, item) {

            if (item) {
                var x = item.datapoint[0].toFixed(2),
                    y = item.datapoint[1].toFixed(2)

                $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
                    .css({
                        top: item.pageY + 5,
                        left: item.pageX + 5
                    })
                    .fadeIn(200)
            } else {
                $('#line-chart-tooltip').hide()
            }

        })
        /* END LINE CHART */

    /*
     * FULL WIDTH STATIC AREA CHART
     * -----------------
     */
    var areaData = [
        [2, 88.0],
        [3, 93.3],
        [4, 102.0],
        [5, 108.5],
        [6, 115.7],
        [7, 115.6],
        [8, 124.6],
        [9, 130.3],
        [10, 134.3],
        [11, 141.4],
        [12, 146.5],
        [13, 151.7],
        [14, 159.9],
        [15, 165.4],
        [16, 167.8],
        [17, 168.7],
        [18, 169.5],
        [19, 168.0]
    ]


    /* END AREA CHART */

    /*
     * BAR CHART
     * ---------
     */

    var bar_data = {
        data: [
            [1, 10],
            [2, 8],
            [3, 4],
            [4, 13],
            [5, 17],
            [6, 9]
        ],
        bars: { show: true }
    }


    /*
     * DONUT CHART
     * -----------
     */

    var donutData = [{
            label: 'Series2',
            data: 30,
            color: '#3c8dbc'
        },
        {
            label: 'Series3',
            data: 20,
            color: '#0073b7'
        },
        {
            label: 'Series4',
            data: 50,
            color: '#00c0ef'
        }
    ]


})

/*
 * Custom Label formatter
 * ----------------------
 */
function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">' +
        label +
        '<br>' +
        Math.round(series.percent) + '%</div>'
}