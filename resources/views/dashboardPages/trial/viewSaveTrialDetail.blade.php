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
                                @if(Auth::user()->role == '6')
                                    <a href="{{route('Dashboard.SuperAdmin.getSavedTrial')}}" class="btn btn-secondary btn-sm py-2 pull-right m-2">Back</a>
                                @else
                                    <a href="{{route('Dashboard.getSavedTrial')}}" class="btn btn-secondary btn-sm py-2 pull-right m-2">Back</a>
                                @endif

                                <button type="button" data-toggle="modal" data-target="#InviteUser" class="btn btn-warning btn-sm py-2 pull-right m-2">Share / Invite User</button>
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
                                                        {{$response->BriefTitle}}
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
                                                <td>{{$response->NCTId}}</td>
                                            </tr>
                                            <tr>
                                                <th>Brief Title</th>
                                               <td>{{$response->BriefTitle}}</td>
                                            </tr>
                                            <tr>
                                                <th>Official Title</th>
                                               <td>{{$response->OfficialTitle}}</td>
                                            </tr>
                                            <tr>
                                                <th>Brief Summary</th>
                                               <td>{{$response->BriefSummary}}</td>

                                            </tr>
                                            <tr>
                                                <th>Condition</th>
                                               <td>{{$response->Condition}}</td>
                                            </tr>
                                            <tr>
                                                <th>Intervention</th>
                                               <td>{{$response->InterventionName}}</td>
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
                                                <td>{{$response->OverallStatus}}</td>
                                            </tr>
                                            <tr>
                                                <th>Eligibility Criteria</th>
                                                <td>{{$response->EligibilityCriteria}}</td>
                                            </tr>
                                            <tr>
                                                <th>Sex/Gender</th>
                                               <td>{{$response->Gender}}</td>
                                            </tr>
                                            <tr>
                                                <th>Age</th>
                                               <td>{{$response->MinimumAge}}</td>
                                            </tr>
                                            <tr>
                                                <th>Condition</th>
                                               <td>{{$response->Condition}}</td>
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


<div class="modal fade" id="InviteUser">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header align-items-center">
                <h5 class="modal-title mb-0 text-secondary">Share/Invite User</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form class="form" action="{{route('Dashboard.InviteUsers')}}" method="post">
                    @csrf
                    <div class="row gutters-2">
                        <div class="col-md-12 form-group">
                            <label>Share Link for Trial:</label>
                            <a href="{{url('/trial/details/')}}/{{$response->NCTId}}" target="__blank">{{url('/trial/details/')}}/{{$response->NCTId}}</a>
                        </div>
                        <div class="col-md-12 form-group">
                            <label><span class="red_required">*</span>User Types</label>
                            <div class="custom-radio">
                                @if(Auth::user()->role == '1')
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="form-check-input" name="role" value="1" checked="">
                                        <i class="form-icon"></i>Physicians
                                    </label>
                                </div>
                                @elseif(Auth::user()->role == '5')
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="form-check-input" name="role" value="5">
                                        <i class="form-icon"></i>Principal Inv.
                                    </label>
                                </div>
                                @endif
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="form-check-input" name="role" value="2">
                                        <i class="form-icon"></i>Patient/Volunteer
                                    </label>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-md-6 form-group">
                            <label><span class="red_required">*</span>First Name</label>
                            <input type="text" required name="fname" value="{{ old('fname') }}" class="form-control">
                            @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label><span class="red_required">*</span>Last Name</label>
                            <input type="text" required name="lname" value="{{ old('lname') }}" class="form-control">
                            @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label><span class="red_required">*</span>Email</label>
                            <input type="email" required name="email" value="{{ old('email') }}" class="form-control">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" name="nct_id" value="{{$response->NCTId}}">
                        <input type="hidden" name="share_link" value="{{url('/trial/details/')}}/{{$response->NCTId}}">
                        <input type="hidden" name="redirect" value="Dashboard.patientList">
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-orange btn-wide">Share / Invite</button>
                        </div>
                    </div>
                </form>
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