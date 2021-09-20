@extends('dashboardLayouts.app')

@section('title')
@endsection



@section('container')
<div class="content-wrapper">
	<div class="p-3 p-md-4">
		<div class="wrapper">
			
			<div class="wrapper-title">
				@if(isset($newsLetter))
				<span>Edit News Letter</span>
				@else
				<span>Add News Letter</span>
				@endif
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
						<form class="form" action="{{route('superadmin.addNewsLetter')}}" method="POST">
							@csrf
							@if(isset($newsLetter))
							<input type="hidden" name="id" value="{{$newsLetter->id}}">
							@endif
							<div class="card mt-2 mb-4">
								<div class="card-body">
									<div class="row gutters-2">
										<div class="col-md-12 form-group">
											<label><span class="red_required">*</span>Status</label>
											<div class="custom-radio">
			                                    <div class="radio">
			                                        <label>
			                                            <input type="radio" class="form-check-input" name="status" value="1" checked="">
			                                            <i class="form-icon"></i>Active
			                                        </label>
			                                    </div>
			                                    <div class="radio">
			                                        <label>
			                                            <input type="radio" class="form-check-input" name="status" value="2">
			                                            <i class="form-icon"></i>InActive
			                                        </label>
			                                    </div>
			                                    <div class="radio">
			                                        <label>
			                                            <input type="radio" class="form-check-input" name="status" value="3">
			                                            <i class="form-icon"></i>Draft
			                                        </label>
			                                    </div>
			                                </div>
			                            </div>
										<div class="col-md-12 form-group">
											<label><span class="red_required">*</span>Title</label>
											<input type="text" name="title" value="{{isset($newsLetter->title) ? $newsLetter->title : ''}}" required class="form-control" maxlength="20">
											@error('title')
			                                    <span class="invalid-feedback" role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
			                                @enderror
										</div>
			                            <div class="col-md-12 form-group">
											<label><span class="red_required">*</span>Body</label>
											<textarea name="body" value="{{old('body')}}" required class="form-control ckeditor" rows="15">{{isset($newsLetter->html_body) ? $newsLetter->html_body : ''}}</textarea>
											@error('body')
			                                    <span class="invalid-feedback" role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
			                                @enderror
										</div>
									</div>
								</div>
							</div>
							<div class="text-center mt-4 mb-2">
								<button type="submit" class="btn btn-orange btn-wide">Submit</button>
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

@section('script')
<!-- <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> -->
<script src="{{url('assets/plugins/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endscript