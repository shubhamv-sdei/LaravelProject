@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>All Users Payment History</span>
				</div>
				<div class="card">
					<div class="card-body">
						<!-- Tab panes -->
						<div class="tab-content">
							<a href="{{url('users/paymentlog/all')}}" class="btn btn-warning pull-right p-2 m-tb-5">Export Payment Log</a>
							<div class="tab-pane active" id="all">
								<div class="table-responsive">
			                        <table class="table table-rounded all_trails">
			                            <thead class="text-secondary">
			                                <tr>
			                                	<th>By User</th>
			                                    <th>Payment Description</th>
			                                    <th>Amount</th>
			                                    <th>Transaction Id</th>
			                                    <th>Status</th>
			                                    <th>Date</th>
			                                    <th>Action</th>
			                                </tr>
			                            </thead>
			                            <tbody class="align-middle">
			                                @foreach($log as $key=>$value)
		                                	<tr>
		                                		<td>{{$value->getUser->getFullNameAttribute()}}</td>
		                                		<td>{{$value->description}}</td>
		                                		<td>{{$value->amount}} {{strtoupper($value->currency)}}</td>
		                                		<td>{{$value->transaction_id}}</td>
		                                		<td>
		                                			@if($value->status == '1')
		                                				InProcess
		                                			@elseif($value->status == '2')
		                                				Success
		                                			@elseif($value->status == '5')
		                                				Failed
		                                			@endif
		                                		</td>
		                                		<td>
		                                			{{$value->created_at}}
		                                		</td>
		                                		<td class="action">
		                                			@if($value->response)
			                                		<button type="button" class="btn">
				                                    	<a href="{{json_decode($value->response)->receipt_url}}" target="__blank"><i class="material-icons-outlined">visibility</i></a>
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
		</div>
	</div>
</main>

<div class="modal fade" id="InviteUser">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header align-items-center">
				<h5 class="modal-title mb-0 text-secondary">Invite Users</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<form class="form" action="{{route('Dashboard.SuperAdmin.InviteUsers')}}" method="post">
					@csrf
					<div class="row gutters-2">
						<div class="col-md-12 form-group">
							<label>User Types</label>
							<div class="custom-radio">
		                        <div class="radio">
		                            <label>
		                                <input type="radio" class="form-check-input" name="role" value="1" checked="">
		                                <i class="form-icon"></i>Physicians
		                            </label>
		                        </div>
		                        <div class="radio">
		                            <label>
		                                <input type="radio" class="form-check-input" name="role" value="5">
		                                <i class="form-icon"></i>Principal Inv.
		                            </label>
		                        </div>
		                    </div>
		                </div>

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

						<div class="col-md-6 form-group">
							<label>Email</label>
							<input type="email" required name="email" value="{{ old('email') }}" class="form-control">
							@error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<input type="hidden" name="redirect" value="Dashboard.patientList">
						<div class="col-12 text-center mt-4">
							<button type="submit" class="btn btn-orange btn-wide">Invite</button>
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
	$(document).ready(function(){
		$('.all_trails').DataTable();
		$('.approved_trails').DataTable();
		$('.pending_trails').DataTable();
		$('.declined_trails').DataTable();
	})

	function ApprovedUser(id){
		//Alert function
	    swal({
		  title: "Are you sure you want to Approve User?",
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
		            text: "Approve User Successfully.",
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
		  title: "Are you sure you want to Dis-Approve User?",
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
		            text: "Dis-Approve User Successfully.",
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