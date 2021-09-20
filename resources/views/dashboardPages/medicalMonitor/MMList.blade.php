@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>All Medical Monitor</span>

					<div class="col-md-6 col-lg-8 text-md-right">
						<button type="button" class="btn btn-secondary btn-wide"><a href="{{route('Dashboard.MM.addMM')}}" style="color:white;">Invite Medical Monitor</a></button>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane active" id="all">
								<div class="table-responsive">
			                        <table class="table table-rounded all_trails">
			                            <thead class="text-secondary">
			                                <tr>
			                                    <th>Profile</th>
			                                    <th>User Name</th>
			                                    <th>Email</th>
			                                    <th>Role</th>
			                                    <th>Status</th>
			                                    <th>Action</th>
			                                </tr>
			                            </thead>
			                            <tbody class="align-middle">
			                                @foreach($all as $key=>$value)
		                                	<tr>
		                                		<td class="user-nav">
		                                			@if($value->image != "")
													<img src="{{Auth::user()->image}}">
													@else
													<img src="{{url('assets/avatar.jpg')}}">
													@endif
		                                		</td>
		                                		<td>{{$value->firstname}} {{$value->lastname}}</td>
		                                		<td>{{$value->email}}</td>
		                                		<td>
		                                			@if($value->role == '1')
		                                				Physician
		                                			@elseif($value->role == '2')
		                                				Patient
		                                			@elseif($value->role == '5')
		                                				Principal Inv.
		                                			@elseif($value->role == '4')
		                                				Medical Monitor
		                                			@endif
		                                		</td>
		                                		<td>
		                                			@if($value->verified == '1')
		                                				<span class="badge badge-success p-2 w-100">Verified</span>
		                                			@else
		                                				<span class="badge badge-danger p-2 w-100">UnVerified</span>
		                                			@endif
		                                		</td>
		                                		<td class="action">
		                                				<button type="button" class="btn">
			                                    		<a href="{{url('/dashboard/startchat/')}}/{{($value->id ? $value->id : 'null')}}"
			                                    		<i class="material-icons-outlined text-success">chat_bubble_outline</i>
			                                    		</a>
			                                    	</button>
			                                			@if($value->verified != '1')
			                                			<button type="button" class="btn">
				                                    		<a class="btn" href="javascript:void(0);" onclick="ApprovedUser({{$value->id}})"><i class="material-icons-outlined text-success">check_circle</i></a>
				                                    	</button>
				                                    	@else
				                                    	<button type="button" class="btn">
				                                    		<a class="btn" href="javascript:void(0);" onclick="DisApprovedUser({{$value->id}})"><i class="material-icons-outlined text-danger">disabled_by_default</i></a>
				                                    	</button>
				                                    	@endif
				                                    	<button type="button" class="btn">
				                                    		<a class="btn" href="javascript:void(0);" onclick="DeleteUser({{$value->id}})"><i class="material-icons-outlined text-danger">delete</i></a>
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
		</div>
	</div>
</main>

@endsection

@section('script')
<script>
	$(document).ready(function(){
		$('.all_trails').DataTable();
		$('.approved_trails').DataTable();
		$('.pending_trails').DataTable();
		$('.declined_trails').DataTable();
	})

	function ApprovedUser(id){
		//Alert function
	    swal({
		  title: "Are you sure you want to Approve MM?",
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
            $.ajax({
              url:"{{url('/superadmin/dashboard/approve/user/')}}/"+id,
              method:"GET",
              success:function(data){
               	// swal("Un-Assigned!", "Un-Assigned Investigator Successfully.", "success"); 
               	swal({
		            title: "Approve!",
		            text: "Approve MM Successfully.",
		            type: "success"
		        }, function() {
		            location.reload();
		        });
              }
            });
		  } else {
		    swal("Cancelled", "Approve Fail", "error");
		  }
		});
		//End Alert
	}

	function DisApprovedUser(id){
		//Alert function
	    swal({
		  title: "Are you sure you want to Dis-Approve MM?",
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
            $.ajax({
              url:"{{url('/superadmin/dashboard/disapprove/user/')}}/"+id,
              method:"GET",
              success:function(data){
               	// swal("Un-Assigned!", "Un-Assigned Investigator Successfully.", "success"); 
               	swal({
		            title: "Dis-Approve!",
		            text: "Dis-Approve MM Successfully.",
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

	function DeleteUser(id){
		//Alert function
	    swal({
		  title: "Are you sure you want to Delete Medical Monitor Invite?",
		  text: "You will not be able to recover this action!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Yes, Delete it!",
		  cancelButtonText: "Cancel",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm) {
		  if (isConfirm) {
            $.ajax({
              url:"{{url('/dashboard/MM/deleteUsers/')}}/"+id,
              method:"GET",
              success:function(data){
               	// swal("Un-Assigned!", "Un-Assigned Investigator Successfully.", "success"); 
               	swal({
		            title: "Delete!",
		            text: "Delete Medical Monitor Successfully.",
		            type: "success"
		        }, function() {
		            location.reload();
		        });
              }
            });
		  } else {
		    swal("Cancelled", "Delete Fail", "error");
		  }
		});
		//End Alert
	}
</script>
@endsection