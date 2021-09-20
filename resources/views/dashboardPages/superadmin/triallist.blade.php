@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')	
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>Clinical Trial List</span>
					<!-- <button type="button" class="btn btn-secondary btn-wide" data-toggle="modal" data-target="#findPatient" id="findPatientModel">Invite A Patient</a> -->
				</div>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							@if(Session::has('msg'))
	                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
	                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                                <span aria-hidden="true">&times;</span>
	                              </button>
	                              {{ Session::get('msg') }}
	                            </div>
	                        @endif
		                    <table class="table table-rounded" id="savetriallist">
		                        <thead class="text-secondary">
		                            <tr>
		                                <!-- <th style="width: 150px;">Status</th> -->
		                                <th >Study Title</th>
		                                <th>NCT No</th>
		                                <th>Conditions</th>
		                                <th>Locations</th>
		                                <th>Physician</th>
		                                <th>Assigned Inv.</th>
		                                <th>Assigned Patient/Volunteer</th>
		                                <th>Actions</th>
		                            </tr>
		                        </thead>
		                        <tbody class="align-middle">
		                        	@foreach($trial as $key=>$value)
		                            <tr>
		                                <td>{{$value->BriefTitle}}</td>
		                                <td>{{$value->NCTId}}</td>
		                                <td>{{$value->Condition}}</td>
		                                <td>{{$value->LocationCity}},{{$value->LocationCountry}}</td>
		                                <td>
		                                	@if($value['getAssignment'])
			                                	@if($value['getAssignment']->physician_id)
			                                		<a href="{{url('/superadmin/professionalInfo')}}/{{$value['getAssignment']->physician_id}}" target="__blank">
			                                		{{\App\User::find($value['getAssignment']->physician_id)->getFullNameAttribute()}}
			                                		</a>
			                                	@else
			                                	N/A
			                                	@endif
		                                	@else
		                                	N/A
		                                	@endif
		                                </td>
		                                <td>
		                                	@if($value['getAssignment'])
			                                	@if($value['getAssignment']->investigator_id)
			                                		<a href="{{url('/superadmin/professionalInfo')}}/{{$value['getAssignment']->investigator_id}}" target="__blank">
			                                		{{\App\User::find($value['getAssignment']->investigator_id)->getFullNameAttribute()}}
			                                		</a>
			                                	@else
			                                	N/A
			                                	@endif
		                                	@else
		                                	N/A
		                                	@endif
		                                </td>
		                                <td>
		                                	@php
		                                	if($value['getAssignment']){
		                                		if($value['getAssignment']->patient_ids){
		                                			foreach(explode(",",$value['getAssignment']->patient_ids) as $vl){
		                                			 $url = url('/superadmin/professionalInfo').'/'.$vl;
		                                			 echo '<a href="'.$url.'" target="__blank">';
		                                			 echo \App\User::find($vl)->getFullNameAttribute().',';
		                                			 echo '</a>';
		                                		    }
		                                	    }else{
		                                	    	echo 'N/A';
		                                	    }
		                                    }else{
 												echo 'N/A';
		                                    }
		                                	@endphp
		                                </td>
		                                <td class="action">
		                                	@if($value->remark)
		                                		<a class="btn" href="{{url('/dashboard/findInternalStudyDetails/details')}}/{{$value->remark}}"><i class="material-icons-outlined text-secondary">visibility</i></a>
		                                	@else
		                                		<a class="btn" href="{{url('/dashboard/ViewSavedTrial')}}/{{$value->id}}"><i class="material-icons-outlined text-secondary">visibility</i></a>
		                                	@endif

		                                	<!-- <button type="button" class="btn" onclick="deleteTrial({{$value->id}})">
	                                    		<i class="material-icons-outlined text-danger">delete</i>
	                                    	</button> -->

	                                    	<button type="button" class="btn" onclick="getHistory({{$value->id}})">
	                                    		<i class="material-icons-outlined text-warning">update</i>
	                                    	</button>
	                                    	
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
	</div>
</main>

<div class="modal fade" id="findPatient">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header align-items-center">
				<h5 class="modal-title mb-0 text-secondary">Invite A Patient</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<form class="form" action="{{route('Dashboard.savedPatient')}}" method="post">
					@csrf
					<div class="row gutters-2">
						<div class="col-md-6 form-group">
							<label>First Name</label>
							<input type="text" required name="fname" value="{{ old('fname') }}" class="form-control">
							@error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>

						<div class="col-md-6 form-group">
							<label>Last Name</label>
							<input type="text" required name="lname" value="{{ old('lname') }}" class="form-control">
							@error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>

						<div class="col-md-12 form-group">
							<label>Patient Id</label>
							<input type="text" name="patient_id" value="{{ old('patient_id') }}" class="form-control">
							@error('patient_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>

						<div class="col-md-6 form-group">
							<label>Email</label>
							<input type="email" required name="email" value="{{ old('email') }}" class="form-control">
							@error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="col--6 form-group">
							<label>Phone</label>
							<input type="number" required name="phone" value="{{ old('phone') }}" class="form-control">
							@error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<!-- <div class="col-md-6 form-group">
							<label>Sex</label>
							<div class="custom-radio">
                                <div class="radio">
                                    <label>
                                        <input type="radio" required class="form-check-input" name="sex" checked="">
                                        <i class="form-icon"></i>Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" required class="form-check-input" name="sex">
                                        <i class="form-icon"></i>Female
                                    </label>
                                </div>
                            </div>
                            @error('sex')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> -->
						<div class="col-md-6 form-group">
							<label>DOB</label>
							<input type="date" required name="dob" value="{{ old('dob') }}" class="form-control">
							@error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="col-md-12 form-group">
							<label>Message</label>
							<textarea name="address" required class="form-control">{{ old('city') }}</textarea>
							@error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="col-12 text-center mt-4">
							<button type="submit" class="btn btn-orange btn-wide">Save</button>
						</div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="Assignmentlog">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header align-items-center">
				<h5 class="modal-title mb-0 text-secondary">Assignment Log</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<div class="table-responsive">
				<table class="table">
					<tr>
						<th>Trial Title</th>
						<th>User Name</th>
						<th>Assigned To</th>
						<th>Assigned By</th>
						<th>Remark</th>
						<th>Operation</th>
						<th>Assigned At</th>
					</tr>
					<tbody id="assigned_table_body">
						
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
$(document).ready( function () {
  $('#savetriallist').DataTable();

  @if ($errors->count())
  	$('#findPatientModel').click();
  @endif
});

function getHistory(trial_id){
	$.ajax({
      url:"{{ route('Dashboard.TrialAssignmentLog') }}",
      method:"GET",
      data:{trial_id:trial_id},
      success:function(data){ 
       	$('#assigned_table_body').html(data.html);
       	$('#Assignmentlog').modal('show');
      }
    });
}

function deleteTrial(id){
	//Alert function
    swal({
	  title: "Are you sure you want to delete trial?",
	  text: "You will not be able to recover this action!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Yes, delete it!",
	  cancelButtonText: "Cancel",
	  closeOnConfirm: false,
	  closeOnCancel: false
	},
	function(isConfirm) {
	  if (isConfirm) {
	  	var trial_id = id;
        $.ajax({
          url:"{{ route('Dashboard.DeleteTrial') }}",
          method:"GET",
          data:{trial_id:trial_id},
          success:function(data){
           	// swal("Un-Assigned!", "Un-Assigned Investigator Successfully.", "success"); 
           	swal({
	            title: "Deleted!",
	            text: "Trial Deleted Successfully.",
	            type: "success"
	        }, function() {
	            location.reload();
	        });
          }
        });
	  } else {
	    swal("Cancelled", "Un-Assigned Fail", "error");
	  }
	});
    //End Alert
}
</script>
@endsection