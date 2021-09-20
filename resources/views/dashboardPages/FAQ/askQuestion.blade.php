@extends('dashboardLayouts.app')

@section('title')
@endsection


@section('container')
<div class="content-wrapper">
	<div class="p-3 p-md-4">
		<div class="wrapper">
			<div class="wrapper-title">
				@if(isset($faq_question->id) && $faq_question->id)
				<span>Update Question</span>
				@else
				<span>Add Question</span>
				@endif
			</div>
			<div class="card">
				@if(Session::has('msg'))
				    <div class="alert alert-warning alert-dismissible fade show" role="alert">
				      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				        <span aria-hidden="true">&times;</span>
				      </button>
				      {{ Session::get('msg') }}
				    </div>
				@endif
				<div class="card-body">
					<form class="form" action="{{route('Dashboard.Physican.addQuestionProcess')}}" method="POST">
						@csrf
						<input type="hidden" name="id" value="{{(isset($faq_question->id) ? $faq_question->id : '')}}">
						<div class="card mt-2 mb-4">
							<div class="card-body">
								<div class="row gutters-2">
									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Clinical Trial</label>
										<select class="form-control custom-select" id="trial" name="trial" required value="{{ old('trial') }}">
										<option selected disabled="">Select Clinical Trial</option>
											@foreach($saveTrial as $key=>$value)
												<option value="{{$value->id}}">{{$value->BriefTitle}}</option>
											@endforeach
									</select>
										@error('trial')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Principal Investigator</label>
										<select class="form-control custom-select" name="inv" id="inv" required value="{{ old('inv') }}">
										<option selected disabled="">Select Principal Inv.</option>
											
									</select>
										@error('inv')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Question</label>
										<textarea name="question" class="form-control" rows="7">{{(isset($faq_question->question) ? $faq_question->question : '')}}</textarea>
										@error('question')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
								</div>
						</div>
						<div class="text-center mt-4 mb-2">
							@if(isset($faq_question->id) && $faq_question->id)
							<button type="submit" class="btn btn-orange btn-wide">Update Question</button>
							@else
							<button type="submit" class="btn btn-orange btn-wide">Create Question</button>
							@endif
							<button type="button" class="btn btn-danger btn-wide">Cancel</button>
						</div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
</main>
@endsection

@section('script')
<script>

	$('#trial').change(function(){
		var trial_id = $(this).val();
		$.ajax({
		  url:"{{ route('Dashboard.getInvListByTrial') }}",
		  method:"GET",
		  data:{trial_id:trial_id},
		  success:function(data){
		    $('#inv').html(data);
		    @if(isset($faq_question->id) && $faq_question->id)
		    	$('#inv').val("{{$faq_question->inv_id}}");
		    @endif
		  }
		});
	});

	@if(isset($faq_question->id) && $faq_question->id)
		$('#trial').val("{{$faq_question->trial_id}}");
		$('#trial').change();
	@endif
</script>
@endsection