@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
<div class="content-wrapper">
	<div class="p-3 p-md-4">
		<div class="wrapper">
			<div class="wrapper-title">
				<span>Landing Page</span>
				<!-- <a href="dashboard.html" class="btn btn-secondary btn-wide">Back</a> -->
			</div>
			<div class="card">
				<div class="card-body">
					@if(Session::has('msg'))
					    <div class="alert alert-warning alert-dismissible fade show" role="alert">
					      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					        <span aria-hidden="true">&times;</span>
					      </button>
					      {{ Session::get('msg') }}
					    </div>
					@endif

					<div class="p-xl-5 container">
						<form class="form mt-4" action="{{route('Dashboard.SuperAdmin.updatelandingpage')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Find the perfect Clinical Trial for your Patients</i></label>
									<textarea name="landing_block_1" class="form-control" placeholder="Add Content" rows="3">{{$landing_block_1}}</textarea>
									@error('landing_block_1')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>

								<div class="col-md-12 form-group">
									<label>Trusted By Billions - Worldwide</label>
									<textarea name="landing_block_2" class="form-control" placeholder="Add Content" rows="3">{{$landing_block_2}}</textarea>
									@error('landing_block_2')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>

								<div class="col-md-12 form-group">
									<label>Consultation ease over one tap of video call</label>
									<textarea name="landing_block_3" class="form-control" placeholder="Add Content" rows="3">{{$landing_block_3}}</textarea>
									@error('landing_block_3')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>

								<div class="col-md-12 form-group">
									<label>Easy Tracking of assigned patient</label>
									<textarea name="landing_block_4" class="form-control" placeholder="Add Content" rows="3">{{$landing_block_4}}</textarea>
									@error('landing_block_4')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>

								<div class="col-md-12 form-group">
									<label>Find A Clinical Trial - Easy Sign Up</label>
									<textarea name="landing_block_5" class="form-control" placeholder="Add Content" rows="3">{{$landing_block_5}}</textarea>
									@error('landing_block_5')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>

								<div class="col-md-12 form-group">
									<label>Clinical Trial Management</label>
									<textarea name="landing_block_6" class="form-control" placeholder="Add Content" rows="3">{{$landing_block_6}}</textarea>
									@error('landing_block_6')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>

								<div class="col-md-12 form-group">
									<label>Large Database of Trials</label>
									<textarea name="landing_block_7" class="form-control" placeholder="Add Content" rows="3">{{$landing_block_7}}</textarea>
									@error('landing_block_7')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>

								<div class="col-md-12 form-group">
									<label>Easy Management Process</label>
									<textarea name="landing_block_8" class="form-control" placeholder="Add Content" rows="3">{{$landing_block_8}}</textarea>
									@error('landing_block_8')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>

								<div class="col-md-12 form-group">
									<label>Assign Investigator to Patients</label>
									<textarea name="landing_block_9" class="form-control" placeholder="Add Content" rows="3">{{$landing_block_9}}</textarea>
									@error('landing_block_9')
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