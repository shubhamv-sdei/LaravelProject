@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
<div class="content-wrapper">
	<div class="p-3 p-md-4">
		<div class="wrapper">
			<div class="wrapper-title">
				<span>Provider Network</span>
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
						<form class="form mt-4" action="{{route('Dashboard.SuperAdmin.updateprovidernetwork')}}" method="post" enctype="multipart/form-data">
							@csrf
							<input type="file" name="profile" class="hide" id="profilePic" value="{{Auth::user()->image}}">
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Block 1</i></label>
									<textarea name="provider_network_title_block_1" class="form-control" placeholder="Add Title" rows="3">{{$provider_network_title_block_1}}</textarea>
									@error('provider_network_title_block_1')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
									<textarea name="provider_network_content_block_1" class="form-control" placeholder="Add Content" rows="6">{{$provider_network_content_block_1}}</textarea>
									@error('provider_network_content_block_1')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>

								<div class="col-md-12 form-group">
									<label>Block 2</label>
									<textarea name="provider_network_title_block_2" class="form-control" placeholder="Add Title" rows="3">{{$provider_network_title_block_2}}</textarea>
									@error('provider_network_title_block_2')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
									<textarea name="provider_network_content_block_2" class="form-control" placeholder="Add Content" rows="6">{{$provider_network_content_block_2}}</textarea>
									@error('provider_network_content_block_2')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
								</div>

								<div class="col-md-12 form-group">
									<label>Block 3</label>
									<textarea name="provider_network_title_block_3" class="form-control" placeholder="Add Title" rows="3">{{$provider_network_title_block_3}}</textarea>
									@error('provider_network_title_block_3')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
                                	@enderror
									<textarea name="provider_network_content_block_3" class="form-control" placeholder="Add Content" rows="6">{{$provider_network_content_block_3}}</textarea>
									@error('provider_network_content_block_3')
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