@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>All Invites</span>
				</div>
				<div class="card">
					<div class="card-header p-2">
						<button type="button" data-toggle="modal" data-target="#InviteUser" class="btn btn-warning pull-right">Invite User</button>
						&nbsp
					</div>
					<div class="card-body">
						@if(Session::has('msg'))
						    <div class="alert alert-warning alert-dismissible fade show" role="alert">
						      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						        <span aria-hidden="true">&times;</span>
						      </button>
						      {{ Session::get('msg') }}
						    </div>
						@endif
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
			                                    <th>Invited By</th>
			                                    <th>Status</th>
			                                </tr>
			                            </thead>
			                            <tbody class="align-middle">
			                            	@if($all)
			                                @foreach($all as $key=>$value)
			                                @php
			                                $value = $value['getUser'];
			                                @endphp
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
		                                				Patient/Volunteer
		                                			@elseif($value->role == '5')
		                                				Principal Inv.
		                                			@endif
		                                		</td>
		                                		<td>
		                                			{{Auth::user()->getFullNameAttribute()}}
		                                		</td>
		                                		<td>
		                                			@if($value->verified == '1')
		                                				<span class="badge badge-success p-2 w-100">Created</span>
		                                			@else
		                                				<span class="badge badge-danger p-2 w-100">Pending</span>
		                                			@endif
		                                		</td>
		                                	</tr>
		                                	@endforeach
		                                	@else
		                                	@endif
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
				<form class="form" action="{{route('Dashboard.InviteUsers')}}" method="post">
					@csrf
					<div class="row gutters-2">
						<div class="col-md-12 form-group">

							<!-- <b>Patient inviting another patient</b>
							<p>"I joined the ClinicalMatch platform to volunteer for a clinical trial and I think you should too"</p>
							<b>Patient inviting their physician</b>
							<p>"I enrolled into a clinical trial on ClinicalMatch and I would like you get regular updates on my progress from he Principal Investigator by signing up."</p>
							<b>Physician inviting another physician</b>
							<p>"I joined the ClinicalMatch platform to search for alternative treatments for my patients and I think you will find their resources very useful"</p>
							<b>Investigator inviting another investigator</b>
							<p>"I signed up with the ClinicalMatch platform to enroll quality patients/volunteers for my studies, I think you should too!"</p> -->
							<label><span class="red_required">*</span>User Types</label>
							<div class="custom-radio">
								@if(Auth::user()->role == '1')
		                        <div class="radio">
		                            <label>
		                                <input type="radio" class="form-check-input" name="role" value="1" required checked="">
		                                <i class="form-icon"></i>Physicians
		                            </label>
		                        </div>
		                        @elseif(Auth::user()->role == '5')
		                        <div class="radio">
		                            <label>
		                                <input type="radio" required class="form-check-input" name="role" value="5">
		                                <i class="form-icon"></i>Principal Inv.
		                            </label>
		                        </div>
		                        @elseif(Auth::user()->role == '2')
		                        <div class="radio">
		                            <label>
		                                <input type="radio" required class="form-check-input" name="role" value="2">
		                                <i class="form-icon"></i>Patient/Volunteer
		                            </label>
		                        </div>
		                        @endif
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
						<input type="hidden" name="nct_id" value="">
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