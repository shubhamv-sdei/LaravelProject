@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
<div class="content-wrapper">
	<div class="p-3 p-md-4">
		<div class="wrapper">
			<div class="wrapper-title">
				<span>User information</span>
				<a href="{{url('/dashboard/profile')}}" class="btn btn-secondary btn-wide">Back</a>
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
						<div class="media align-items-center">
							<div class="media-thumb xl rounded-circle border mr-4">
								@if(Auth::user()->image != "")
								<img src="{{Auth::user()->image}}" id="profileView">
								@else
								<img src="{{url('assets/avatar.jpg')}}" id="profileView">
								@endif
							</div>
							<div class="media-body">
								
								<button  onclick="browseFile()" type="button" class="btn btn-secondary">Upload Photo</button>
								@error('profile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
						</div>
						<form class="form mt-4" action="{{route('Dashboard.profile.update')}}" method="post" enctype="multipart/form-data">
							@csrf
							<input type="file" name="profile" class="hide" id="profilePic" value="{{Auth::user()->image}}">
							<div class="row">
								<div class="col-md-6 form-group">
									<label><span class="red_required">*</span>First Name</label>
									<input type="text" name="firstname" class="form-control" required maxlength="20" placeholder="John" value="{{Auth::user()->firstname}}">
									@error('firstname')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>
								<div class="col-md-6 form-group">
									<label><span class="red_required">*</span>Last Name</label>
									<input type="text" name="lastname" required maxlength="20" class="form-control" placeholder="Wick" value="{{Auth::user()->lastname}}">
									@error('lastname')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>
								<div class="col-md-6 form-group">
									<label><span class="red_required">*</span>Email Address</label>
									<input type="email" name="email" required class="form-control" placeholder="johnwick@yopmail.com" value="{{Auth::user()->email}}" readonly>
									@error('email')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>
								<div class="col-md-6 form-group">
									<label>Contact No</label>
									<input type="text" name="contact" class="form-control" placeholder="123-456-7890" value="{{Auth::user()->contact}}">
									@error('contact')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>
								<div class="col-12 form-group">
									<label>Address</label>
									<input type="text" name="address" class="form-control" placeholder="123 xyz road lane -49" value="{{Auth::user()->address}}">
									@error('address')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>
								<div class="col-12 text-center mt-4">
									<button type="submit" class="btn btn-orange btn-wide">Update</button>
									<a href="{{route('Dashboard.profile')}}" class="btn btn-secondary btn-wide">Cancel</a>
								</div>
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

@section('script')
<script>
function browseFile(){
	$('#profilePic').click();
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profileView').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$('#profilePic').change(function(){
	readURL(this);
});
</script>
@endsection