@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
<div class="content-wrapper">
    <div class="p-3 p-md-4">
        <div class="wrapper">
            <div class="wrapper-title">
                <span>Clinical Trial Information</span>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="p-xl-2 container">
                        @if(Session::has('msg'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              {{ Session::get('msg') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-xl-12">
                                <form method="POST" action="{{route('Dashboard.saveTrial')}}">
                                    @csrf
                                    <input type="hidden" name="trail_info" value="{{json_encode($response)}}">
                                    <button type="submit" class="btn btn-secondary btn-sm py-2 pull-right m-2" style="color:white;">Save Trial</button>
                                </form>
                                &nbsp&nbsp&nbsp
                                <a href="javascript:void(0);" onclick="goBack()" class="btn btn-secondary btn-sm py-2 pull-right m-2">Back</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="table-responsive shadow mb-4">
                                    <table class="table mb-0">
                                        <thead class="thead-blue">
                                            <tr>
                                                <th>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                    <span class="lead fw-400">
                                                        @foreach ($response->BriefTitle as $r )
                                                            <?php echo $r."<br>"; ?>
                                                           @endforeach
                                                    </span>
                                                    <!-- <a href="javascript:void(0);" onclick="goBack()" class="text-white">Back</a> -->
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <table class="table mb-0">
                                        <tbody class="th-blue">
                                            <tr>
                                                <th>NCT Number</th>
                                                <td>@foreach ($response->NCTId as $r )
                                                 <?php echo $r."<br>"; ?>
                                                @endforeach</td>
                                            </tr>
                                            <tr>
                                                <th>Brief Title</th>
                                                <td>@foreach ($response->BriefTitle as $r )
                                                <?php echo $r."<br>"; ?>
                                               @endforeach</td>
                                            </tr>
                                            <tr>
                                                <th>Official Title</th>
                                                <td>@foreach ($response->OfficialTitle as $r )
                                                <?php echo $r."<br>"; ?>
                                               @endforeach</td>
                                            </tr>
                                            <tr>
                                                <th>Brief Summary</th>
                                                <td>@foreach ($response->BriefSummary as $r )
                                                <?php echo $r."<br>"; ?>
                                               @endforeach</td>
                                            </tr>
                                            <tr>
                                                <th>Condition</th>
                                                <td>@foreach ($response->Condition as $r )
                                                <?php echo $r."<br>"; ?>
                                               @endforeach</td>
                                            </tr>
                                            <tr>
                                                <th>Intervention</th>
                                                <td>@foreach ($response->InterventionName as $r )
                                                <?php echo $r."<br>"; ?>
                                               @endforeach</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive shadow mb-4">
                                    <table class="table mb-0">
                                        <thead class="thead-blue">
                                            <tr>
                                                <th>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                    <span class="lead fw-400">Recruitment Information</span>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <table class="table mb-0">
                                        <tbody class="th-blue">
                                            <tr>
                                                <th>Recruitment Status</th>
                                                <td> @foreach ($response->OverallStatus as $r )
                                                 <?php echo $r."<br>"; ?>
                                                @endforeach</td>
                                            </tr>
                                            <tr>
                                                <th>Eligibility Criteria</th>
                                                <td>
                                                    @foreach ($response->EligibilityCriteria as $r )
                                                <?php echo nl2br($r)."<br>"; ?>
                                               @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Sex/Gender</th>
                                                <td>@foreach ($response->Gender as $r )
                                                <?php echo $r."<br>"; ?>
                                               @endforeach</td>
                                            </tr>
                                            <tr>
                                                <th>Age</th>
                                                <td> @foreach ($response->MinimumAge as $r )
                                                <?php echo $r."<br>"; ?>
                                               @endforeach</td>
                                            </tr>
                                            <tr>
                                                <th>Condition</th>
                                                <td>@foreach ($response->Condition as $r )
                                                <?php echo $r."<br>"; ?>
                                               @endforeach</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                		    </div>
                	    </div>
                    </div>
	            </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
// $(document).ready( function () {
//   $('#triallist').DataTable();
// });
</script>
@endsection