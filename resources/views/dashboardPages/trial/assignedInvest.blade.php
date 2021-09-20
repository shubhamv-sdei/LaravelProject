@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					@if(Auth::user()->role == '5')
					<span>Request Trial</span>
					@else
					<span>Assign Investigator</span>
					@endif
				</div>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
	                        <table class="table table-rounded assigned_inv_trial">
	                            <thead class="text-secondary">
	                                <tr>
	                                    <th>Sr.No</th>
	                                    <th>Clinical Trial Name</th>
	                                    <th>Patient Name</th>
	                                    <th>Assigned Investigator</th>
	                                    <th>Added By</th>
	                                    <th>Status</th>
	                                    <th>Actions</th>
	                                </tr>
	                            </thead>
	                            <tbody class="align-middle">
	                            	@foreach($trial as $key=>$value)
	                                <tr>
	                                    <td>{{$key+1}}</td>
	                                    <td style="width: 300px;">{{$value->BriefTitle}}</td>
	                                    <td>
	                                    	
	                                    	<?php
	                                    		if(isset($value['getAssignment']->patient_ids)){
	                                    			$patient_ids = explode(",",$value['getAssignment']->patient_ids);
	                                    			foreach($patient_ids as $Pa_value){
	                                    				$flag = App\User::where('id',$Pa_value)->count();
	                                    				if($flag){
	                                    					echo App\User::find($Pa_value)->getFullNameAttribute();
	                                    					echo ',';
	                                    				}
	                                    				
	                                    			}
	                                    		}
	                                    	?>

	                                    </td>
	                                    <td>{{isset($value['getAssignment']->investigator_id) ? App\User::find($value['getAssignment']->investigator_id)->getFullNameAttribute() : 'N/A'}}</td>
	                                    <td>{{(isset($value['getAssignment']->assigned_by) && App\User::where('id',$value['getAssignment']->assigned_by)->count())  ? App\User::find($value['getAssignment']->assigned_by)->getFullNameAttribute() : 'N/A'}}</td>
	                                    <td>
	                                    	@if(isset($value['getAssignment']->inv_status) && $value['getAssignment']->inv_status == '1')
                                			<span class="badge badge-primary p-2 w-100">Pending</span>
                                			@elseif(isset($value['getAssignment']->inv_status) && $value['getAssignment']->inv_status == '2')
                                			<span class="badge badge-success p-2 w-100">Approved</span>
                                			@elseif(isset($value['getAssignment']->inv_status) && $value['getAssignment']->inv_status == '3')
                                			<span class="badge badge-danger p-2 w-100">Declined</span>
                                			@endif
	                                    </td>
	                                    <td class="action">
	                                    	@if(Auth::user()->role == '1') <!-- Physician -->
	                                    	@if($value->remark)
		                                		<a class="btn" href="{{url('/dashboard/findInternalStudyDetails/details')}}/{{$value->remark}}"><i class="material-icons-outlined text-secondary">visibility</i></a>
		                                	@else
	                                    	<button type="button" class="btn">
	                                    		<a class="btn" href="{{url('/dashboard/ViewSavedTrial')}}/{{$value->id}}"><i class="material-icons-outlined text-secondary">visibility</i></a>
	                                    	</button>
	                                    	@endif

	                                    	<button type="button" class="btn" data-toggle="modal" data-target="#assignInvestigator" onclick="trialId({{$value->id}})">
	                                    		<i class="material-icons-outlined text-primary">person_add</i>
	                                    	</button>
	                                    	<button type="button" class="btn" onclick="trialId({{$value->id}})" id="CancelAssignment">
	                                    		<i class="material-icons-outlined text-danger">cancel</i>
	                                    	</button>
	                                    	<button type="button" class="btn">
	                                    		<a href="{{url('/dashboard/startchat/')}}/{{(isset($value['getAssignment']->investigator_id) ? $value['getAssignment']->investigator_id : 'null')}}"
	                                    		<i class="material-icons-outlined text-success">chat_bubble_outline</i>
	                                    		</a>
	                                    	</button>
	                                    	@elseif(Auth::user()->role == '5') <!-- Principal Inv. -->
	                                    	@if($value->remark)
		                                		<a class="btn" href="{{url('/dashboard/findInternalStudyDetails/details')}}/{{$value->remark}}"><i class="material-icons-outlined text-secondary">visibility</i></a>
		                                	@else
	                                    	<button type="button" class="btn">
	                                    		<a class="btn" href="{{url('/dashboard/ViewSavedTrial')}}/{{$value->id}}"><i class="material-icons-outlined text-secondary">visibility</i></a>
	                                    	</button>
	                                    	@endif
	                                    	<button type="button" class="btn">
	                                    		<a class="btn" href="javascript:void(0);" onclick="ApprovedTrial({{$value['getAssignment']->id}})"><i class="material-icons-outlined text-success">check_circle</i></a>
	                                    	</button>
	                                    	<button type="button" class="btn">
	                                    		<a class="btn" href="javascript:void(0);" onclick="DisApprovedTrial({{$value['getAssignment']->id}})"><i class="material-icons-outlined text-danger">disabled_by_default</i></a>
	                                    	</button>
	                                    	<button type="button" class="btn">
	                                    		<a href="{{url('/dashboard/startchat/')}}/{{(isset($value['getAssignment']->assigned_by) ? $value['getAssignment']->assigned_by : 'null')}}"
	                                    		<i class="material-icons-outlined text-success">chat_bubble_outline</i>
	                                    		</a>
	                                    	</button>

	                                    	<button type="button" class="btn" onclick="getHistory({{$value->id}})">
	                                    		<i class="material-icons-outlined text-warning">update</i>
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

	<div class="modal fade" id="assignInvestigator">
		<div class="modal-dialog modal-dialog-centered modal-md">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header align-items-center">
					<h5 class="modal-title mb-0 text-secondary">Assign Investigator</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<form class="form" action="{{route('Dashboard.assignInvestigatorProcess')}}" method="POST">
						@csrf
						<div class="row gutters-2">
							<div class="col-md-12 form-group selectInvBlock">
								<label>Select Investigator <small><i>( CM will contact and connect you with this Investigator)</i></small></label>
								<select class="form-control selectpicker" id="select-country" data-live-search="true" name="inv">
								@foreach($inv_list as $key=>$value)
									<option value="{{$value->id}}">{{$value->firstname}} {{$value->lastname}} - {{$value->email}}</option>
								@endforeach
								</select>
							</div>

							<input type="hidden" name="trial_id" value="" id="trial_name">
							
							<!-- <div class="col-12 form-group">
								<button type="button" class="btn btn-secondary d-flex align-items-center" id="add_new_inv"><i class="material-icons-outlined mr-2">add</i> <span>Add New</span></button>
							</div>
							
							<div class="col-md-6 form-group add_new_block" style="display:none;">
								<label>Investigator Name</label>
								<input type="text" name="" class="form-control">
							</div>
							<div class="col-md-6 form-group add_new_block" style="display:none;">
								<label>Email</label>
								<input type="email" name="" class="form-control">
							</div> -->

							<div class="col-12 text-center mt-4">
								<button type="submit" class="btn btn-orange btn-wide">Assign</button>
								<button type="button" class="btn btn-secondary btn-wide" data-dismiss="modal">Cancel</button>
							</div>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</main>

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
  $('.assigned_inv_trial').DataTable();

  $('#add_new_inv').click(function(){
  	if($(this).find('span').text() == "Add New"){
  		$(this).find('span').text('Remove');
  		$(this).find('i').text('remove');
  		$('.selectInvBlock').hide();
  	}else{
  		$(this).find('span').text('Add New');
  		$(this).find('i').text('add');
  		$('.selectInvBlock').show();
  	}
  	$('.add_new_block').toggle();
  });

  $('#CancelAssignment').click(function(){
	  	//Alert function
	    swal({
		  title: "Are you sure you want to un-assign investigator?",
		  text: "You will not be able to recover this action!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Yes, un-assign it!",
		  cancelButtonText: "Cancel",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm) {
		  if (isConfirm) {
		  	var trial_id = $('#trial_name').val();
            $.ajax({
              url:"{{ route('Dashboard.unAssignInv') }}",
              method:"GET",
              data:{trial_id:trial_id},
              success:function(data){
               	// swal("Un-Assigned!", "Un-Assigned Investigator Successfully.", "success"); 
               	swal({
		            title: "Un-Assigned!",
		            text: "Un-Assigned Investigator Successfully.",
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
  });

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

function trialId(Id){
	$('#trial_name').val(Id);
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
              url:"{{url('/dashboard/approve/trial/')}}/"+id,
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
              url:"{{url('/dashboard/disapprove/trial/')}}/"+id,
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
