@extends('dashboardLayouts.app')

@section('title')
@endsection


@section('container')
<div class="content-wrapper">
	<div class="p-3 p-md-4">
		<div class="wrapper">
			<div class="wrapper-title">
				<span>FAQ Response</span>
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
					<form class="form" action="{{route('Dashboard.Physican.addAnswerQuestion')}}" method="POST">
						@csrf
						<input type="hidden" name="id" value="{{(isset($faq_question->id) ? $faq_question->id : '')}}">
						<div class="card mt-2 mb-4">
							<div class="card-body">
								<div class="row gutters-2">
									<div class="col-md-12 form-group">
										<a href="{{url('dashboard/ViewSavedTrial')}}/{{$faq_question['getTrial']->id}}" __target="blank" class="form-control">{{$faq_question['getTrial']->BriefTitle}}</a>
									</div>
									<div class="col-md-12 form-group">
										<label>"{{$faq_question['getCreatedBy']->getFullNameAttribute()}}" asked question on <u>{{date_format(date_create($faq_question->created_at),"d, M Y, h:m A")}}</u></label>
										<textarea readonly class="form-control">{{$faq_question->question}}</textarea>
									</div>
									<div class="col-md-12 form-group">
										<label>Add you answer here...</label>
										<textarea class="form-control" name="answer" required>{{$faq_question->answer}}</textarea>
									</div>
								</div>
							</div>
						</div>
						@if(Auth::user()->role != '1')
						<div class="text-center mt-4 mb-2">
							<button type="submit" class="btn btn-orange btn-wide">Add Answer</button>
							<button type="button" class="btn btn-danger btn-wide">Cancel</button>
						</div>
						@endif
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
	
</script>
@endsection