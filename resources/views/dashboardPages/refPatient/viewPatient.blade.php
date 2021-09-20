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
					<span>View Ref. Patient Details</span>
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

							<div class="row">
				                <div class="col-xl-12">
				                    <a href="{{route('Dashboard.refPatient.refPatientList')}}" class="btn btn-secondary btn-sm py-2 pull-right m-2">Back</a>
				                </div>
				            </div>
							
								<div class="row">
									<div class="col-md-6 form-group">
										<label>Patient Name:</label>
									</div>
									<div class="col-md-6 form-group">
										<label>{{$patient['getPatientDetails']->getFullNameAttribute()}}</label>
									</div>

									<div class="col-md-6 form-group">
										<label>Ref. By:</label>
									</div>
									<div class="col-md-6 form-group">
										<label>{{$patient['getCreatedBy']->getFullNameAttribute()}}</label>
									</div>

									<div class="col-md-6 form-group">
										<label>Trial/Study:</label>
									</div>
									<div class="col-md-6 form-group">
										<label>{{$patient['getTrialDetails']->BriefTitle}}</label>
									</div>

	                                <div class="col-md-6 form-group">
										<label>Principal Inv. name:</label>
									</div>
									<div class="col-md-6 form-group">
										<label>{{Helper::getInvNameByTrialId($patient->trial_id)}}</label>
									</div>

									<div class="col-md-6 form-group">
										<label>Date patient referred:</label>
									</div>
									<div class="col-md-6 form-group">
										<label>{{date_format(date_create($patient->patient_ref_date),"d, M Y h:m A")}}</label>
									</div>

	                                <div class="col-md-6 form-group">
										<label>Chart Review:</label>
									</div>
									<div class="col-md-6 form-group">
										<label>{{date_format(date_create($patient->chart_rev_date),"d, M Y h:m A")}}</label>
									</div>

									<div class="col-md-6 form-group">
										<label>Eligibility Assessment:</label>
									</div>
									<div class="col-md-6 form-group">
										<label>{{date_format(date_create($patient->el_ass_date),"d, M Y h:m A")}}</label>
									</div>

	                                <div class="col-md-6 form-group">
										<label>Patient Contact For Study Interest:</label>
									</div>
									<div class="col-md-6 form-group">
										<label>{{$patient->patient_contact}}</label>
									</div>

	                                <div class="col-md-6 form-group">
										<label>Institution/Clinic name:</label>
									</div>
									<div class="col-md-6 form-group">
										<label>{{$patient->clinic_name}}</label>
									</div>

	                                <div class="col-md-6 form-group">
										<label>Institution address:</label>
									</div>
									<div class="col-md-6 form-group">
										<label>{{$patient->ins_address}}</label>
									</div>

									<div class="col-md-6 form-group">
										<label>Tax ID:</label>
									</div>
									<div class="col-md-6 form-group">
										<label>{{$patient->tax_id}}</label>
									</div>

									<div class="col-md-6 form-group">
										<label>Bank name:</label>
									</div>
									<div class="col-md-6 form-group">
										<label>{{$patient->bank_name}}</label>
									</div>

									<div class="col-md-6 form-group">
										<label>Routing:</label>
									</div>
									<div class="col-md-6 form-group">
										<label>{{$patient->routing}}</label>
									</div>

									<div class="col-md-6 form-group">
										<label>Account number:</label>
									</div>
									<div class="col-md-6 form-group">
										<label>{{$patient->account_no}}</label>
									</div>

									<div class="col-md-6 form-group">
										<label>Created Date:</label>
									</div>
									<div class="col-md-6 form-group">
										<label>{{date_format(date_create($patient->created_at),"d, M Y h:m A")}}</label>
									</div>

									<div class="col-md-6 form-group">
										<label>Trial Status:</label>
									</div>
									<div class="col-md-6 form-group">
										<label>{{(($patient['getStatusFromScreenVisit']->count() == '1') ? 'Completed' : 'In Process')}}</label>
									</div>
								</div>
								@if($patient['getStatusFromScreenVisit']->count())
									@if($patient->payment_log_id)
										@php
											$log = \App\Model\PaymentLog::where('id',$patient->payment_log_id)->first();
										@endphp

										<div class="row">
											<div class="col-md-6 form-group">
												<label>Payment Amount:</label>
											</div>
											<div class="col-md-6 form-group">
												<label>{{$log->amount}} {{strtoupper($log->currency)}}</label>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6 form-group">
												<label>Payment Date:</label>
											</div>
											<div class="col-md-6 form-group">
												<label>{{date_format(date_create($log->created_at),"d, M Y h:m A")}}</label>
											</div>
										</div>
									@else
										<form action="{{route('Dashboard.refPatient.initPaymentRef')}}" method="POST" id="payment-form">
										<div class="row">
												@csrf
					                            <span class="bank-errors" style="color:#de9183;"></span>
													<input type="hidden" name="id" value="{{$patient->id}}">

												<div class="col-md-6 form-group">
													<label>Amount :</label>
													<input type="number" name="amount" value="" class="form-control" required>
												</div>

												<div class="col-md-6 form-group">
													<label>Transaction Id:</label>
													<input type="text" name="txn_id" value="" class="form-control" required>
												</div>

												<div class="col-md-12 form-group">
													<label>Description:</label>
													<input type="text" name="description" value="Payout From Admin to Physician Offline" class="form-control" required>
												</div>

												<div class="col-md-6 form-group">
													<label>Country :</label>
													<input type="text" required="" data-stripe="country" class="form-control country" size="20" maxlength="20" readonly value='{{$patient->country}}'>
												</div>

												<div class="col-md-6 form-group">
													<label>Currency :</label>
													<input type="text" required="" data-stripe="currency" class="form-control currency" name="currency" readonly value='{{$patient->currency}}'>
												</div>

												<div class="col-md-6 form-group">
													<label>Routing Number :</label>
													<input readonly type="text" required="" data-stripe="routing_number" class="form-control routing_number" value='{{$patient->routing}}'>
												</div>

												<div class="col-md-6 form-group">
													<label>Account Number :</label>
													<input readonly type="text" required="" data-stripe="account_number" class="form-control account_number" value='{{$patient->account_no}}'>
												</div>

												<div class="col-md-6 form-group">
													<label>Account holder name :</label>
													<input type="text" required="" data-stripe="account_holder_name" class="form-control account_holder_name" readonly value='{{$patient->account_holder_name}}'>
												</div>

												<div class="col-md-6 form-group">
													<label>Account holder type :</label>
													<input type="text" required="" data-stripe="account_holder_type" class="form-control account_holder_type" readonly value='{{$patient->account_holder_type}}'>
												</div>
					                                
				                                <div class="col-md-12 text-center">
				                                    <button class="btn btn-primary submit" type="submit">Make Payment</button>
				                                </div>
					                        </div>
					                        </form>
				                        </div>
									@endif
								@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection