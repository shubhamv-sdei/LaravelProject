@extends('dashboardLayouts.app')

@section('title')
@endsection
@section('container')
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>All Users</span>
				</div>
				<div class="card">
					<div class="card-header p-0">
						<ul class="product-tab-list nav tab-border justify-content-lg-center mt-5">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#all">
									<span>All Users</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#approved">
									<span>Physicians</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#declined">
									<span>Principal Inv.</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#pending">
									<span>Patient/Volunteer</span>
								</a>
							</li>
						</ul>
					</div>

					<div class="card-body">
						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane active" id="all">
								<button type="button" data-toggle="modal" data-target="#InviteUser" class="btn btn-primary pull-right p-2 m-tb-5">Invite User</button>
								<a href="{{url('users/export/')}}" class="btn btn-warning pull-right p-2 m-tb-5">Export User</a>
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
		                                		<td><a href="{{url('/superadmin/professionalInfo')}}/{{$value->id}}" target="__blank">{{$value->firstname}} {{$value->lastname}}</a></td>
		                                		<td>{{$value->email}}</td>
		                                		<td>
		                                			@if($value->role == '1')
		                                				Physician
		                                			@elseif($value->role == '2')
		                                				Patient/Volunteer
		                                			@elseif($value->role == '5')
		                                				Principal Inv.
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
				                                    	<a href="{{url('/superadmin/doLogin/')}}/{{$value->id}}"><i class="material-icons-outlined">login</i></a>
				                                    	</button>
				                                    	<button type="button" class="btn">
				                                    		<a class="btn" href="javascript:void(0);" onclick="deleteUser({{$value->id}})"><i class="material-icons-outlined text-danger">delete</i></a>
				                                    	</button>
			                                		</td>
		                                	</tr>
		                                	@endforeach
			                            </tbody>
			                        </table>
			                    </div>
							</div>
							<div class="tab-pane fade" id="approved">
								<button type="button" data-toggle="modal" data-target="#InviteUser" class="btn btn-primary pull-right p-2 m-tb-5">Invite User</button>
								<a href="{{url('users/export/1')}}" class="btn btn-warning pull-right p-2 m-tb-5">Export User</a>
								<div class="table-responsive">
			                        <table class="table table-rounded approved_trails">
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
			                                @foreach($physician as $key=>$value)
			                                	<tr>
			                                		<td class="user-nav">
			                                			@if($value->image != "")
														<img src="{{Auth::user()->image}}">
														@else
														<img src="{{url('assets/avatar.jpg')}}">
														@endif
			                                		</td>
			                                		<td><a href="{{url('/superadmin/professionalInfo')}}/{{$value->id}}" target="__blank">{{$value->firstname}} {{$value->lastname}}</a></td>
			                                		<td>{{$value->email}}</td>
			                                		<td>
			                                			@if($value->role == '1')
			                                				Physician
			                                			@elseif($value->role == '2')
			                                				Patient/Volunteer
			                                			@elseif($value->role == '5')
			                                				Principal Inv.
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
				                                    	<a href="{{url('/superadmin/doLogin/')}}/{{$value->id}}"><i class="material-icons-outlined">login</i></a>
				                                    	</button>
				                                    	<button type="button" class="btn">
				                                    		<a class="btn" href="javascript:void(0);" onclick="deleteUser({{$value->id}})"><i class="material-icons-outlined text-danger">delete</i></a>
				                                    	</button>
			                                		</td>
			                                	</tr>
		                                	@endforeach
			                            </tbody>
			                        </table>
			                    </div>
		                    </div>
							<div class="tab-pane fade" id="pending">
								<button type="button" data-toggle="modal" data-target="#InviteUser" class="btn btn-primary pull-right p-2 m-tb-5">Invite User</button>
								<a href="{{url('users/export/5')}}" class="btn btn-warning pull-right p-2 m-tb-5">Export User</a>
								<div class="table-responsive">
			                        <table class="table table-rounded pending_trails">
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
			                                @foreach($patient as $key=>$value)
			                                	<tr>
			                                		<td class="user-nav">
			                                			@if($value->image != "")
														<img src="{{Auth::user()->image}}">
														@else
														<img src="{{url('assets/avatar.jpg')}}">
														@endif
			                                		</td>
			                                		<td><a href="{{url('/superadmin/professionalInfo')}}/{{$value->id}}" target="__blank">{{$value->firstname}} {{$value->lastname}}</a></td>
			                                		<td>{{$value->email}}</td>
			                                		<td>
			                                			@if($value->role == '1')
			                                				Physician
			                                			@elseif($value->role == '2')
			                                				Patient/Volunteer
			                                			@elseif($value->role == '5')
			                                				Principal Inv.
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
				                                    	<a href="{{url('/superadmin/doLogin/')}}/{{$value->id}}"><i class="material-icons-outlined">login</i></a>
				                                    	</button>
				                                    	<button type="button" class="btn">
				                                    		<a class="btn" href="javascript:void(0);" onclick="deleteUser({{$value->id}})"><i class="material-icons-outlined text-danger">delete</i></a>
				                                    	</button>
			                                		</td>
			                                	</tr>
		                                	@endforeach
			                            </tbody>
			                        </table>
			                    </div>
							</div>
							<div class="tab-pane fade" id="declined">
								<button type="button" data-toggle="modal" data-target="#InviteUser" class="btn btn-primary pull-right p-2 m-tb-5">Invite User</button>
								<a href="{{url('users/export/2')}}" class="btn btn-warning pull-right p-2 m-tb-5">Export User</a>
								<div class="table-responsive">
			                        <table class="table table-rounded declined_trails">
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
			                                @foreach($principal_inv as $key=>$value)
			                                	<tr>
			                                		<td class="user-nav">
			                                			@if($value->image != "")
														<img src="{{Auth::user()->image}}">
														@else
														<img src="{{url('assets/avatar.jpg')}}">
														@endif
			                                		</td>
			                                		<td><a href="{{url('/superadmin/professionalInfo')}}/{{$value->id}}" target="__blank">{{$value->firstname}} {{$value->lastname}}</a></td>
			                                		<td>{{$value->email}}</td>
			                                		<td>
			                                			@if($value->role == '1')
			                                				Physician
			                                			@elseif($value->role == '2')
			                                				Patient/Volunteer
			                                			@elseif($value->role == '5')
			                                				Principal Inv.
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
				                                    	<a href="{{url('/superadmin/doLogin/')}}/{{$value->id}}"><i class="material-icons-outlined">login</i></a>
				                                    	</button>
				                                    	<button type="button" class="btn">
				                                    		<a class="btn" href="javascript:void(0);" onclick="deleteUser({{$value->id}})"><i class="material-icons-outlined text-danger">delete</i></a>
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
							<label><span class="red_required">*</span>User Types</label>
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
							<label><span class="red_required">*</span>First Name</label>
							<input type="text" maxlength="20" required name="fname" value="{{ old('fname') }}" class="form-control">
							@error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>

						<div class="col-md-6 form-group">
							<label><span class="red_required">*</span>Last Name</label>
							<input type="text" maxlength="20" required name="lname" value="{{ old('lname') }}" class="form-control">
							@error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>

						<div class="col-md-6 form-group">
							<label><span class="red_required">*</span>Email</label>
							<input type="email" maxlength="25" required name="email" value="{{ old('email') }}" class="form-control">
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

	function deleteUser(id){
		//Alert function
	    swal({
		  title: "Are you sure you want to Delete User?",
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
              url:"{{url('/superadmin/delete/user/')}}/"+id,
              method:"GET",
              success:function(data){
               	swal({
		            title: "Delete!",
		            text: "User Deleted Successfully.",
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