@extends('layouts.app')
@section('content')
    
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href=" {{ route('accounts.index') }} ">Account Details </a> </li>
            <li class="breadcrumb-item acti ve" aria-current="page">Charts</li>
        </ol>
    </nav>
    <h3 style="text-align: center;" class="m-3">Payment Recived And Payment Pending</h3>
        <div id="container1"></div>
        <h3 style="text-align: center ;">Payment Details Pie Chart</h3>
        <div id="piechart"></div>
    <h3 style="text-align: center;" class="m-3">Chart For Total Payments Created</h3>
    <div id="container"></div>
    </div>
{{-- @dd($statusarr) --}}
{{-- @dd($companyname , $payment_pending) --}}

<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    var companyname =  <?php echo json_encode($companyname) ?>;
    var users =  <?php echo json_encode($users) ?>;
    var payment_pending =  <?php echo json_encode($payment_pending) ?>;
    var payment_recived =  <?php echo json_encode($payment_recived) ?>;
    var status =  <?php echo json_encode($statusarr) ?>;
    var count =  <?php echo json_encode($countarr) ?>;
    
    Highcharts.chart('container', {
        title: {
            text: ' Company`s Payment Count'
        },
        // subtitle: {
            //     text: 'Source: itsolutionstuff.com.com'
            // },
            xAxis: {
                categories: companyname
            },
            yAxis: {
            title: {
                text: 'Total Payments Open'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Count of Payments',
            data: users
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
});



Highcharts.chart('container1', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Company VS payment recived  , payment pending'
    },
    subtitle: {
        text: 'Source: <a href="https://en.wikipedia.org/wiki/World_population">Wikipedia.org</a>'
    },
    xAxis: {
        categories: companyname,
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rupees',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: 'k'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor:
        Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Payment Pending',
        data: payment_pending   
    }, {
        name: 'Payment Recived',
        data: payment_recived
    },  ]
});

Highcharts.chart('piechart', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Paid Halfpaid Unpaid chart Representation'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'halfPiad',
            y: count[1],
             sliced: true,
            selected: true
        }, {
            name: 'Unpaid',
            y: count[0]
        }, {
            name: 'fullpaid',
            y: count[2]
        }]
    }]
});
</script>

@endsection