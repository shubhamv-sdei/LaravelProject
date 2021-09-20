@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
<div class="content-wrapper">
	<div class="p-3 p-md-4">
		<div class="wrapper">
			<div class="wrapper-title">
				<span>User information</span>
			</div>
			<div class="card">
				<div class="card-header">
					<span class="lead fw-400">Overview</span>
				</div>
				@if(Session::has('msg'))
				    <div class="alert alert-warning alert-dismissible fade show" role="alert">
				      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				        <span aria-hidden="true">&times;</span>
				      </button>
				      {{ Session::get('msg') }}
				    </div>
				@endif
				<div class="card-body">
					<div class="p-xl-5 container">
						<div class="row">
							<div class="col-md-4 col-xl-3">
								<div class="border rounded d-flex flex-column align-items-center justify-content-center p-4 text-center">
									<div class="media-thumb xxl rounded-circle border mb-3">
										@if(Auth::user()->image != "")
										<img src="{{asset(Auth::user()->image)}}">
										@else
										<img src="{{url('assets/avatar.jpg')}}">
										@endif
									</div>
									<h5>{{Auth::user()->getFullNameAttribute()}}</h5>
								</div>
							</div>
							<div class="col-md-8 col-xl-9 mt-3 mt-md-0">
								<div class="table-responsive">
									<table class="table">
										<tbody>
											<tr>
												<td>First Name:</td>
												<td class="text-secondary">{{Auth::user()->firstname}}</td>
											</tr>
											<tr>
												<td>Last Name:</td>
												<td class="text-secondary">{{Auth::user()->lastname}}</td>
											</tr>
											<tr>
												<td>Email Address:</td>
												<td class="text-secondary">{{Auth::user()->email}}</td>
											</tr>
											<tr>
												<td>Contact No:</td>
												<td class="text-secondary">{{Auth::user()->contact}}</td>
											</tr>
											<tr>
												<td>Address:</td>
												<td class="text-secondary">{{Auth::user()->address}}</td>
											</tr>
											<tr>
												<td>Role:</td>
												<td class="text-secondary">
													@if(Auth::user()->role == 1)
														Physician
													@elseif(Auth::user()->role == 2)
														Patient
													@elseif(Auth::user()->role == 3)
														Family & Friends
													@elseif(Auth::user()->role == 4)
														Sponsors
													@elseif(Auth::user()->role == 5)
														Principal Investigator
													@elseif(Auth::user()->role == 6)
														Super Admin
													@elseif(Auth::user()->role == 7)
														UnAssigned
													@endif
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="mt-3 text-right">
									<a href="{{route('Dashboard.profile.edit')}}" class="btn btn-orange btn-wide">EDIT</a>
								</div>
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