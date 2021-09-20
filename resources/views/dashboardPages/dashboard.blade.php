@extends('dashboardLayouts.app')

@section('title')
Dashboard
@endsection
@section('container')
	@php
	$dashboard = Helper::getDashboardCount();
	@endphp
	<div class="content-wrapper">
        <div class="p-3 p-md-4">
            <div class="wrapper">
                <div class="wrapper-title">
                    <span>Dashboard</span>
                    <div class="media align-items-center">
                        <!-- <button type="button" class="btn bg-transparent text-white p-0" style="line-height: 0">
                            <i class="material-icons-outlined mi-30">apps</i>
                        </button> -->
                        <!-- <div class="media-body ml-3">
                            <div class="input-group input-group-inner border-0">
                                <input type="text" class="form-control" name="" placeholder="Search" />
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text">
                                        <i class="material-icons-outlined">search</i>
                                    </button>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="patients p-4">
                            <div class="row justify-content-center">
                            	@if(isset($dashboard['patient']))
                                <div class="col-12 col-xl-4 my-2 my-md-3">
                                    <div class="patient-block card">
                                        <div class="card-header shadow-none border-bottom">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h5 class="text-primary mb-0">Patient</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column flex-md-row align-items-center">
                                                <div class="p-2">
                                                    <i class="material-icons-outlined text-primary dash-icon">supervisor_account</i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h2 class="display-4 text-primary m-0">{{$dashboard['patient']}}</h2>
                                                </div>
                                            </div>
                                            @if(Auth::user()->role != '6')
                                            <div class="text-center text-md-right">
                                                <a href="{{route('Dashboard.patientList')}}" class="btn btn-orange btn-wide">View Details</a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if(isset($dashboard['principal_inv']))
                                <div class="col-12 col-xl-4 my-2 my-md-3">
                                    <div class="patient-block card">
                                        <div class="card-header shadow-none border-bottom">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h5 class="text-secondary mb-0">Principal Inv.</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column flex-md-row align-items-center">
                                                <div class="p-2">
                                                    <i class="material-icons-outlined text-secondary dash-icon">supervisor_account</i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h2 class="display-4 text-secondary m-0">{{$dashboard['principal_inv']}}</h2>
                                                </div>
                                            </div>
                                            @if(Auth::user()->role != '6')
                                            <div class="text-center text-md-right">
                                                <a href="{{route('Dashboard.assignInv')}}" class="btn btn-orange btn-wide">View Details</a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if(isset($dashboard['Physician']))
                                <div class="col-12 col-xl-4 my-2 my-md-3">
                                    <div class="patient-block card">
                                        <div class="card-header shadow-none border-bottom">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h5 class="text-success mb-0">Physician</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column flex-md-row align-items-center">
                                                <div class="p-2">
                                                    <i class="material-icons-outlined text-success dash-icon">supervisor_account</i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h2 class="display-4 text-success m-0">{{$dashboard['Physician']}}</h2>
                                                </div>
                                            </div>
                                            @if(Auth::user()->role != '6')
                                            <div class="text-center text-md-right">
                                                <button type="button" class="btn btn-orange btn-wide">View Details</button>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if(isset($dashboard['appointment']))
                                <div class="col-12 col-xl-4 my-2 my-md-3">
                                    <div class="patient-block card">
                                        <div class="card-header shadow-none border-bottom">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h5 class="text-info mb-0">Appointment Today</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column flex-md-row align-items-center">
                                                <div class="p-2">
                                                    <i class="material-icons-outlined text-info dash-icon">today</i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h2 class="display-4 text-info m-0">{{$dashboard['appointment']}}</h2>
                                                </div>
                                            </div>
                                            @if(Auth::user()->role != '6')
                                            <div class="text-center text-md-right">
                                                <a href="{{route('Dashboard.AppointmentList')}}" class="btn btn-orange btn-wide">View Details</a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if(isset($dashboard['save_trial']))
                                <div class="col-12 col-xl-4 my-2 my-md-3">
                                    <div class="patient-block card">
                                        <div class="card-header shadow-none border-bottom">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h5 class="text-info mb-0">Saved Trials</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column flex-md-row align-items-center">
                                                <div class="p-2">
                                                    <i class="material-icons-outlined text-info dash-icon">today</i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h2 class="display-4 text-info m-0">{{$dashboard['save_trial']}}</h2>
                                                </div>
                                            </div>
                                            <div class="text-center text-md-right">
                                                <button type="button" class="btn btn-orange btn-wide">View Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if(isset($dashboard['invite_patient']))
                                <div class="col-12 col-xl-4 my-2 my-md-3">
                                    <div class="patient-block card">
                                        <div class="card-header shadow-none border-bottom">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h5 class="text-primary mb-0">Invite patient</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column flex-md-row align-items-center">
                                                <div class="p-2">
                                                    <i class="material-icons-outlined text-primary dash-icon">supervisor_account</i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h2 class="display-4 text-primary m-0">{{$dashboard['invite_patient']}}</h2>
                                                </div>
                                            </div>
                                            <div class="text-center text-md-right">
                                                <a href="{{route('Dashboard.patientList')}}" class="btn btn-orange btn-wide">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- <div class="row">
                                <div class="col-12 col-xl-6 my-2 my-md-3">
                                    <div class="patient-block card">
                                        <div class="card-header shadow-none border-bottom">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h5 class="text-success mb-0">No. of Trials</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-12">
                                                    <div id="curve_chart" style="width: 100%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6 my-2 my-md-3">
                                    <div class="patient-block card">
                                        <div class="card-header shadow-none border-bottom">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <h5 class="text-info mb-0">No. of Clinical Trial Visits</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-12">
                                                    <div id="columnchart_material" style="width: 100%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses'],
            ['2004', 1000, 400],
            ['2005', 1170, 460],
            ['2006', 660, 1120],
            ['2007', 1030, 540],
        ]);

        var options = {
            title: 'Company Performance',
            curveType: 'function',
            legend: { position: 'bottom' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.charts.load('current', { packages: ['bar'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses', 'Profit'],
            ['2014', 1000, 400, 200],
            ['2015', 1170, 460, 250],
            ['2016', 660, 1120, 300],
            ['2017', 1030, 540, 350],
        ]);

        var options = {
            chart: {
                title: 'Company Performance',
                subtitle: 'Sales, Expenses, and Profit: 2014-2017',
            },
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>
@endsection