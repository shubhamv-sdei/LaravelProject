@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>Assign Patient</span>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
	                        <table class="table table-rounded assigned_inv_trial">
	                            <thead class="text-secondary">
	                                <tr>
	                                    <th>Sr.No</th>
	                                    <th>Patient Name</th>
	                                    <th>Sex</th>
	                                    <th>DOB</th>
	                                    <th>Is Reimburs</th>
	                                    <th>Status</th>
	                                    <th>Actions</th>
	                                </tr>
	                            </thead>
	                            <tbody class="align-middle">
	                            	@foreach($patients as $key=>$value)
	                                <tr>
	                                    <td>{{$key+1}}</td>
	                                    <td>
	                                    	{{$value->firstname}} {{$value->lastname}}
	                                    </td>
	                                    <td>
	                                    	{{($value->sex == '1' ? 'Male' : 'Female')}}
	                                    </td>
	                                    <td>
	                                    	{{$value->dob}}
	                                    </td>
	                                    <td>{{Helper::IsReimbursPatient($assignment->trial_id,$value->id)}}</td>
	                                    <td>
	                                    	@if($assignment->patient_status == '1')
                                			<span class="badge badge-primary p-2 w-100">Pending</span>
                                			@elseif($assignment->patient_status == '2')
                                			<span class="badge badge-success p-2 w-100">Approved</span>
                                			@elseif($assignment->patient_status == '3')
                                			<span class="badge badge-danger p-2 w-100">Declined</span>
                                			@endif
	                                    </td>
	                                    <td class="action">
	                                    	@if(Auth::user()->role == '1') <!-- Physician -->
	                                    	<button type="button" class="btn">
	                                    		<a class="btn" href="{{url('/dashboard/patient/view/')}}/{{$value->id}}"><i class="material-icons-outlined text-secondary">visibility</i></a>
	                                    	</button>
	                                    	<!-- button type="button" class="btn" onclick="trialId({{$value->id}})" id="CancelAssignment">
	                                    		<i class="material-icons-outlined text-danger">cancel</i>
	                                    	</button> -->
	                                    	@elseif(Auth::user()->role == '5') <!-- Principal Inv. -->
	                                    	<button type="button" class="btn">
	                                    		<a class="btn" href="{{url('/dashboard/patient/view/')}}/{{$value->id}}"><i class="material-icons-outlined text-secondary">visibility</i></a>
	                                    	</button>
	                                    	<button type="button" class="btn" onclick="DeletePatientFromTrial({{$value->id}},{{$assignment->id}})" id="CancelAssignment">
	                                    		<i class="material-icons-outlined text-danger">cancel</i>
	                                    	</button>
	                                    	@endif
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
@endsection

@section('script')
<script>
$(document).ready( function () {
 	$('.assigned_inv_trial').DataTable();
});

function DeletePatientFromTrial(p_id,a_id){
	//Alert function
	    swal({
		  title: "Are you sure you want to remove Patient?",
		  text: "You will not be able to recover this action!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Yes, Remove it!",
		  cancelButtonText: "Cancel",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm) {
		  if (isConfirm) {
		  	var trial_id = $('#trial_name').val();
            $.ajax({
              url:"{{url('/dashboard/remove/patient/')}}/"+p_id+"/"+a_id,
              method:"GET",
              success:function(data){
               	swal({
		            title: "Remove!",
		            text: "Remove Patient Successfully.",
		            type: "success"
		        }, function() {
		            location.reload();
		        });
              }
            });
		  } else {
		    swal("Cancelled", "Approved Fail", "error");
		  }
		});
	//End Alert
}
</script>
@endsection
