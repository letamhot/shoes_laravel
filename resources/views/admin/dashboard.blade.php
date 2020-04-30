@extends('admin.layouts')

@section('title', 'Dashboard')

@section('content')
<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 360px;
        max-width: 800px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>
{{-- Time ago --}}
@include('php.time-ago')
<!-- Main Content -->
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Price</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($earnings) }}
                                    VND</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Product</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_product - $product }}</div>
                            </div>
                            <div class="col-auto">
                                <i class=" fa fa-shoe-prints fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Product Sold :
                                    <span style="color:blue; font-size: 1.5rem; margin-left: 5px">{{ $product }}
                                    </span>
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            {{ number_format($product * 100 / $total_product) }}%

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: {{ number_format($product * 100 / $total_product, 2) }}%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                {{-- <i class="far fa-dolly-flatbed-alt"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="col-auto">

                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Total Bills</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($bill) }}</div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Bills Detail</h6>

                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="min-height: 50rem;">
                        <p><b style="color: orange">Today Bills Detail have {{ count($todayBill_detail) }} new
                                product</b>
                        </p>
                        <div class="chart-pie pt-3 pb-2">
                            <table class="table table-bordered" id="dataTable" width="100%" height="100%"
                                cellspacing="0" style="font-size: 12.5px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th width='1%'>Id</th>
                                        <th>Name Product</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Date Created</th>
                                        <th>Total</th>
                                        {{-- <th width='5%'>Bill_Detail</th> --}}
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($todayBill_detail as $key => $bills)

                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><b style="color: #6633CC;">{{ $bills->id }}</b></td>
                                        <td>{{ $bills->name_product}}</td>
                                        <td>{{ $bills->size}}</td>
                                        <td>{{ $bills->quantity}}</td>
                                        <td>{{ date("d-m-y", strtotime($bills->created_at)) }} <br>
                                            <span
                                                style="color: #b2b2b2; font-size: 10px; font-weight: bold; float: right">{{ time_elapsed_string($bills->created_at) }}</span>
                                        </td>
                                        <td><span
                                                style="color: white; border-radius: 3px; padding: 3px 5px; background: #3399FF; font-weight: bold; font-size: 13.5px;">{{ number_format($bills->total_price)  }}VND</span>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Bills</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="min-height: 50rem;">
                        <p><b style="color: orange">Today Bills have {{ count($todayBills) }} new bills</b></p>
                        <div class="chart-pie pt-3 pb-2">
                            <table class="table table-bordered" id="dataTable2" width="100%" height="100%"
                                cellspacing="0" style="font-size: 12.5px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th width='1%'>Id</th>
                                        <th>Customer</th>
                                        <th>Date order</th>
                                        <th>Total</th>
                                        <th width='5%'>Bill_Detail</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($todayBills as $key => $bills)

                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><b style="color: #6633CC;">{{ $bills->id }}</b></td>
                                        <td>{{ $bills->customer->name }}</td>
                                        <td>{{ date("d-m-y", strtotime($bills->date_order)) }} <br>
                                            <span
                                                style="color: #b2b2b2; font-size: 10px; font-weight: bold; float: right">{{ time_elapsed_string($bills->date_order) }}</span>
                                        </td>
                                        <td><span
                                                style="color: white; border-radius: 3px; padding: 3px 5px; background: #FF0000; font-weight: bold; font-size: 13.5px;">${{ number_format($bills->total, 2) }}</span>
                                        </td>
                                        <td style="text-align:center"><a href="{{ route('bills.details', $bills->id) }}"
                                                style="color: white; border-radius: 3px; padding: 3px 7px; background: #00FFFF	; font-weight: bold; font-size: auto">{{ count($bills->bill_detail) }}</a>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- /.container-fluid -->
        <div class="row">

            <div class="col-lg-7 mb-4">
                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Total money to day</h6>
                    </div>
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-4">
                <!-- Chart -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Total money to month</h6>
                    </div>
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="container1"></div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection
@push('chart-js')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    let d = new Array();
    // for(i = 0; i < 11, i++){
    d[0] = {{ $day_bills[0] }}
    d[1] = {{ $day_bills[1] }}
    d[2] = {{ $day_bills[2] }}
    d[3] = {{ $day_bills[3] }}
    d[4] = {{ $day_bills[4] }}
    d[5] = {{ $day_bills[5] }}
    d[6] = {{ $day_bills[6] }}
    d[7] = {{ $day_bills[7] }}
    d[8] = {{ $day_bills[8] }}
    d[9] = {{ $day_bills[9] }}
    d[10] = {{ $day_bills[10] }}
    d[11] = {{ $day_bills[11] }}
    d[12] = {{ $day_bills[12] }}
    d[13] = {{ $day_bills[13] }}
    d[14] = {{ $day_bills[14] }}
    d[15] = {{ $day_bills[15] }}
    d[16] = {{ $day_bills[16] }}
    d[17] = {{ $day_bills[17] }}
    d[18] = {{ $day_bills[18] }}
    d[19] = {{ $day_bills[19] }}
    d[20] = {{ $day_bills[20] }}
    d[21] = {{ $day_bills[21] }}
    d[22] = {{ $day_bills[22] }}
    d[23] = {{ $day_bills[23] }}
    d[24] = {{ $day_bills[24] }}
    d[25] = {{ $day_bills[25] }}
    d[26] = {{ $day_bills[26] }}
    d[27] = {{ $day_bills[27] }}
    d[28] = {{ $day_bills[28] }}
    d[29] = {{ $day_bills[29] }}
    d[30] = {{ $day_bills[30] }}

    Highcharts.chart('container', {
        title: {
            text: "Chart Day to Month " + "{{ date('m') }}"
        },
        yAxis: {
            title: {
                text: 'Money'
            }
        },
        xAxis: {
            accessibility: {
                rangeDescription: 'Range: 1 to 12'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +'<td style="padding:0"><b>{point.y} VND</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
                },
        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: 1
            }
        },
        series: [{
            name: 'Total money',
            data: [ d[0], d[1], d[2], d[3], d[4], d[5], d[6], d[7], d[8], d[9], d[10], d[11], d[12], d[13], d[14], d[15], d[16], d[17], d[18], d[19], d[20], d[21], d[22], d[23], d[24], d[25], d[26], d[27], d[28], d[29], d[30]]
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
</script>
<script>
    let m = new Array();
     m[0] = {{ $month_bills[0] }}
     m[1] = {{ $month_bills[1] }}
     m[2] = {{ $month_bills[2] }}
     m[3] = {{ $month_bills[3] }}
     m[4] = {{ $month_bills[4] }}
     m[5] = {{ $month_bills[5] }}
     m[6] = {{ $month_bills[6] }}
     m[7] = {{ $month_bills[7] }}
     m[8] = {{ $month_bills[8] }}
     m[9] = {{ $month_bills[9] }}
     m[10] = {{ $month_bills[10] }}
     m[11] = {{ $month_bills[11] }}

    Highcharts.chart('container1', {
        title: {
            text: 'Chart Month Of The Year ' + "{{ date('Y') }}"
        },
        yAxis: {
            title: {
                text: 'Total Money'
            }
        },
        xAxis: {
            accessibility: {
                rangeDescription: 'Range: 1 to 12'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +'<td style="padding:0"><b>{point.y} VND</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
                },
        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: 1
            }
        },
        series: [{
            name: 'Total Money',
            data: [ m[0], m[1], m[2], m[3], m[4], m[5], m[6], m[7], m[8], m[9], m[10], m[11] ]
            },
        ],

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
</script>

@endpush
