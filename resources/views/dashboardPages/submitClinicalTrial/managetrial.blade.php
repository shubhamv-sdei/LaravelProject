@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>Manage Clinical Trials</span>
				</div>
				<div class="card">
					<!-- <div class="card-header">
						<div class="row">
							<div class="col-md-6 col-lg-4">
								<div class="input-group input-group-inner">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="material-icons-outlined">search</i></span>
									</div>
									<input type="text" name="" class="form-control" placeholder="Search">
								</div>
							</div>
						</div>
					</div> -->
					<div class="card-body">
						<div class="table-responsive">
	                        <table class="table table-rounded manageClinicalTrial">
	                            <thead class="text-secondary">
	                                <tr>
	                                    <th>Name of Clinical Trial</th>
	                                    <th>Date of Submission</th>
	                                    <th>Enrolled Participants</th>
	                                    <th>Status</th>
	                                    <th>Action</th>
	                                </tr>
	                            </thead>
	                            <tbody class="align-middle">
                                	@foreach($submitTrials as $key=>$value)
                                	<tr>
                                		<td style="width:350px;">
                                		{{$value->trial}}
                                		<!-- {{substr_replace($value->getTrial['BriefTitle'], "...", 50)}} --></td>
                                		<td>{{date("d M, Y", strtotime($value->created_at))}}</td>
                                		<td>{{Helper::getTotalTrial($value->id)}}</td>
                                		<td>

                                			@if($value->status == '1')
                                			<span class="badge badge-success p-2 w-100">Approved</span>
                                			@elseif($value->status == '2')
                                			<span class="badge badge-primary p-2 w-100">Pending</span>
                                			@elseif($value->status == '3')
                                			<span class="badge badge-danger p-2 w-100">Declined</span>
                                			@endif

                                		</td>
                                		<td class="action">
                                			@if(Auth::user()->role == '1')
		                                	<a class="btn" href="{{url('/dashboard/ViewManageClinicalTrial')}}/{{$value->id}}"><i class="material-icons-outlined text-secondary">visibility</i></a>
		                                	<button type="button" class="btn" onclick="deleteManageClinicalTrial({{$value->id}})">
	                                    		<i class="material-icons-outlined text-danger">delete</i>
	                                    	</button>
	                                    	@elseif(Auth::user()->role == '5')
	                                    	<button type="button" class="btn">
	                                    		<a class="btn" href="javascript:void(0);" onclick="ApprovedTrial({{$value->id}})"><i class="material-icons-outlined text-success">check_circle</i></a>
	                                    	</button>
	                                    	<button type="button" class="btn">
	                                    		<a class="btn" href="javascript:void(0);" onclick="DisApprovedTrial({{$value->id}})"><i class="material-icons-outlined text-danger">disabled_by_default</i></a>
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

$(document).ready(function(){
	$('.manageClinicalTrial').DataTable();
});

function deleteManageClinicalTrial(id){
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
        $.ajax({
          url:"{{ url('/dashboard/DeleteManageClinicalTrial/') }}/"+id,
          method:"GET",
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


function ApprovedTrial(id){
	//Alert function
	    swal({
		  title: "Are you sure you want to Approve Trial?",
		  text: "You will not be able to recover this action!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Yes, Approve it!",
		  cancelButtonText: "Cancel",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm) {
		  if (isConfirm) {
		  	var trial_id = $('#trial_name').val();
            $.ajax({
              url:"{{url('/dashboard/approve/trialmanagement/')}}/"+id,
              method:"GET",
              success:function(data){
               	// swal("Un-Assigned!", "Un-Assigned Investigator Successfully.", "success"); 
               	swal({
		            title: "Approve!",
		            text: "Approved Trial Successfully.",
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

function DisApprovedTrial(id){
	//Alert function
	    swal({
		  title: "Are you sure you want to Dis-Approve Trial?",
		  text: "You will not be able to recover this action!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Yes, Dis-Approve it!",
		  cancelButtonText: "Cancel",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm) {
		  if (isConfirm) {
		  	var trial_id = $('#trial_name').val();
            $.ajax({
              url:"{{url('/dashboard/disapprove/trialmanagement/')}}/"+id,
              method:"GET",
              success:function(data){
               	// swal("Un-Assigned!", "Un-Assigned Investigator Successfully.", "success"); 
               	swal({
		            title: "Dis-Approve!",
		            text: "Dis-Approve Trial Successfully.",
		            type: "success"
		        }, function() {
		            location.reload();
		        });
              }
            });
		  } else {
		    swal("Cancelled", "Dis-Approve Fail", "error");
		  }
		});
	//End Alert
}
</script>
@endsection