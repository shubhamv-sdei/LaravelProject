@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
<div class="content-wrapper">
	<div class="p-3 p-md-4">
		<div class="wrapper">
			<div class="wrapper-title">
				<span>Invite User</span>
				<a href="{{route('Dashboard.DeligateUser.getUserList')}}" class="btn btn-secondary btn-wide">Back</a>
			</div>
			<div class="card">
				<div class="card-body">
					<div class="p-xl-5 container">
						@if(Session::has('msg'))
						    <div class="alert alert-warning alert-dismissible fade show" role="alert">
						      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						        <span aria-hidden="true">&times;</span>
						      </button>
						      {{ Session::get('msg') }}
						    </div>
						@endif
						<!-- <div class="media align-items-center">
							<div class="media-thumb xl rounded-circle border mr-4">
								<img src="{{url('assets/avatar.jpg')}}" id="profileView">
							</div>
							<div class="media-body">
								
								<button  onclick="browseFile()" type="button" class="btn btn-secondary">Upload Photo</button>
								@error('profile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
						</div> -->
						<form class="form mt-4" action="{{route('Dashboard.DeligateUser.insertDeligateUser')}}" method="post" enctype="multipart/form-data">
							@csrf
							<input type="file" name="profile" class="hide" id="profilePic" value="">
							<div class="row">
								<div class="col-md-6 form-group">
									<label><span class="red_required">*</span>First Name</label>
									<input required type="text" maxlength="20" name="firstname" class="form-control" placeholder="John" value="{{old('firstname')}}">
									@error('firstname')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>
								<div class="col-md-6 form-group">
									<label><span class="red_required">*</span>Last Name</label>
									<input type="text" name="lastname" class="form-control" required maxlength="20" placeholder="Wick" value="{{old('lastname')}}">
									@error('lastname')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>
								<div class="col-md-6 form-group">
									<label><span class="red_required">*</span>Email Address</label>
									<input type="email" required maxlength="25" name="email" class="form-control" placeholder="johnwick@yopmail.com" value="{{old('email')}}">
									@error('email')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>

								<!-- <div class="col-md-6 form-group">
									<label>Contact No</label>
									<input type="text" name="contact" class="form-control" placeholder="123-456-7890" value="{{old('contact')}}">
									@error('contact')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div> -->

								<!-- <div class="col-md-6 form-group">
		                            <label for="password">{{ __('Password') }}</label>
	                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

	                                @error('password')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
		                        </div>

		                        <div class="col-md-6 form-group">
		                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
		                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
		                        </div> 

								<div class="col-12 form-group">
									<label>Address</label>
									<input type="text" name="address" class="form-control" placeholder="123 xyz road lane -49" value="{{old('address')}}">
									@error('address')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div> -->
								<div class="col-12 text-center mt-4">
									<button type="submit" class="btn btn-orange btn-wide">Invite Users</button>
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