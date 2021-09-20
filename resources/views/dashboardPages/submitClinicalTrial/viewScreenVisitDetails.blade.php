@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
<style>
	.requiredcolor{
		color:red;
	}
</style>
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>View Clinical Screen Visits</span>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="p-xl-5 container">
							<div class="row">
								<div class="col-md-6 form-group">
									<label>Full Title of Study :</label>
								</div>
								<div class="col-md-6 form-group">
									<label>{{$value['getTrial']->BriefTitle}}</label>
								</div>

								<div class="col-md-6 form-group">
									<label>Investigator Name :</label>
								</div>
								<div class="col-md-6 form-group">
									<label>{{$value['getInvistigator']->firstname}} {{$value['getInvistigator']->lastname}}</label>
								</div>
                                
								<div class="col-md-6 form-group">
									<label>Patient Name :</label>
								</div>
								<div class="col-md-6 form-group">
									<label>{{$value['getPatient']->firstname}} {{$value['getPatient']->lastname}}</label>
								</div>

								<div class="col-md-6 form-group">
									<label>Screen Visit Scheduled Date :</label>
								</div>

								<div class="col-md-6 form-group">
									<label>{{date('Y-m-d', strtotime($value->screen_visit_schedule_date))}}</label>
								</div>

                                <div class="col-md-6 form-group">
                                	@if($value->type == '1')
                                	<label>Patient/Volunteer has completed required procedures for a Screen visit :</label>
                                	@else
									<label>Patient/Volunteer has completed required procedures for a Screen visit :</label>
									@endif
								</div>
								<div class="col-md-6 form-group">
									<label>{{($value->screen_visit_complete == 1 ? 'Yes' : 'No')}}</label>
								</div>

								<div class="col-md-6 form-group">
									<label>Reason(s) :</label>
								</div>
								<div class="col-md-6 form-group">
									<label>{{$value->reason}}</label>
								</div>

                                <div class="col-md-6 form-group">
									<label>Date Screen Visit Completed :</label>
								</div>
								<div class="col-md-6 form-group">
									<label>{{date('Y-m-d', strtotime($value->screen_visit_complete_date))}}</label>
								</div>

								@if($value->screen_visit_complete == '1')
								<div class="col-md-6 form-group">
									<label>Payment Status :</label>
								</div>
								<div class="col-md-6 form-group">
									<label>{{($value->status == '2' ? 'Approved' : 'Pending')}}</label>
								</div>

								<div class="row">
									<form action="{{route('Dashboard.initPayment')}}" method="POST">
										@csrf
											<div class="col-md-12 form-group">
												<label>Amount :</label>
												<input type="number" name="amount" value="" class="form-control" required>
											</div>
											<input type="hidden" name="id" value="{{$value->id}}">
											<div class="col-md-12 form-group">
												<button type="submit" class="btn btn-primary">Make Payment</button>
											</div>
									</form>
								</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection