@extends('dashboardLayouts.app')

@section('title')
@endsection


@section('container')
<div class="content-wrapper">
	<div class="p-3 p-md-4">
		<div class="wrapper">
			
			<div class="wrapper-title">
				<span>Add Patient/Volunteer</span>
				<!-- <a href="dashboard.html" class="btn btn-secondary btn-wide">Back</a> -->
			</div>
			@if(Session::has('msg'))
			    <div class="alert alert-warning alert-dismissible fade show" role="alert">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			        <span aria-hidden="true">&times;</span>
			      </button>
			      {{ Session::get('msg') }}
			    </div>
			@endif
			<div class="card">
				<div class="card-body">
					<div class="p-xl-5 container">
						<form class="form" action="{{route('Dashboard.savedNewPatient')}}" method="POST">
							@csrf
							<h5>Basic Information (required)</h5>
							<div class="card mt-2 mb-4">
								<div class="card-body">
									<div class="row gutters-2">
										<div class="col-md-6 form-group">
											<label><span class="red_required">*</span>First Name</label>
											<input type="text" name="fname" value="{{old('fname')}}" required class="form-control" maxlength="20">
											@error('fname')
			                                    <span class="invalid-feedback" role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
			                                @enderror
										</div>
										<div class="col-md-6 form-group">
											<label><span class="red_required">*</span>Last Name</label>
											<input type="text" name="lname" value="{{old('lname')}}" required class="form-control" maxlength="20">
											@error('lname')
			                                    <span class="invalid-feedback" role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
			                                @enderror
										</div>
										<div class="col-md-6 form-group">
											<label><span class="red_required">*</span>Date of Birth</label>
											<input type="date" name="dob" value="{{old('dob')}}" required class="form-control">
											@error('dob')
			                                    <span class="invalid-feedback" role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
			                                @enderror
										</div>
										<div class="col-md-6 form-group">
											<label><span class="red_required">*</span>Sex</label>
											<div class="custom-radio">
			                                    <div class="radio">
			                                        <label>
			                                            <input type="radio" required class="form-check-input" name="sex" value="1" checked="">
			                                            <i class="form-icon"></i>Male
			                                        </label>
			                                    </div>
			                                    <div class="radio">
			                                        <label>
			                                            <input type="radio" required class="form-check-input" name="sex" value="2">
			                                            <i class="form-icon"></i>Female
			                                        </label>
			                                    </div>
			                                </div>
			                            </div>
										<!-- <div class="col-md-6 form-group">
											<label>Mobile</label>
											<input type="text" name="" class="form-control">
										</div> -->
										<div class="col-md-6 form-group">
											<label><span class="red_required">*</span>Phone</label>
											<input type="text" name="phone" value="{{old('phone')}}" required class="form-control">
											@error('phone')
			                                    <span class="invalid-feedback" role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
			                                @enderror
										</div>
										<div class="col-6 form-group">
											<label><span class="red_required">*</span>Email</label>
											<input type="email" name="email" value="{{old('email')}}" required class="form-control">
											<small>This is highly recommended to improve patient communications and appointment reminders</small>
											@error('email')
			                                    <span class="invalid-feedback" role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
			                                @enderror
										</div>
										<!-- <div class="col-12 text-right">
											<button type="button" class="btn btn-secondary btn-sm">Show More</button>
										</div> -->
									</div>
								</div>
							</div>
							<h5>Additional Contact Information (required)</h5>
							<div class="card mt-2">
								<div class="card-body">
									<div class="row gutters-2">
										<div class="col-md-6 form-group">
											<label><span class="red_required">*</span>Street Address</label>
											<input type="text" name="address1" value="{{old('address1')}}" value="{{old('address1')}}" class="form-control" maxlength="100">
											@error('address1')
			                                    <span class="invalid-feedback" required role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
			                                @enderror
										</div>
										<div class="col-md-6 form-group">
											<label>Apt/Suite</label>
											<input type="text" name="address2" value="{{old('address2')}}" class="form-control">
											@error('address2')
			                                    <span class="invalid-feedback" role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
			                                @enderror
										</div>
										<div class="col-6 col-lg-4 form-group">
											<label><span class="red_required">*</span>City</label>
											<input type="text" name="city" required value="{{old('city')}}" class="form-control" maxlength="50">
											@error('city')
			                                    <span class="invalid-feedback" role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
			                                @enderror
										</div>
										<div class="col-6 col-lg-4 form-group">
											<label><span class="red_required">*</span>State</label>
											<input type="text" name="state" required value="{{old('state')}}" class="form-control" maxlength="50">
											@error('state')
			                                    <span class="invalid-feedback" role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
			                                @enderror
										</div>
										<div class="col-lg-4 form-group">
											<label><span class="red_required">*</span>Zip Code</label>
											<input type="text" name="zip" required value="{{old('zip')}}" class="form-control" maxlength="6">
											@error('zip')
			                                    <span class="invalid-feedback" role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
			                                @enderror
										</div>
			                        </div>
			                    </div>
			                </div>
							<div class="text-center mt-4 mb-2">
								<button type="submit" class="btn btn-orange btn-wide">Create Patient</button>
								<button type="button" class="btn btn-danger btn-wide">Cancel</button>
							</div>
	                    </form>
	    			</div>
				</div>
			</div>
		</div>
	</div>
</div>
</main>
@endsection