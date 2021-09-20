
@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')	
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>Invite / Save Patient/Volunteer List</span>
					<button type="button" class="btn btn-secondary btn-wide" data-toggle="modal" data-target="#findPatient" id="findPatientModel">Invite A Patient/Volunteer</button>
					
					<a href="{{route('Dashboard.patientAdd')}}" class="btn btn-secondary btn-wide" id="findPatientModel"> <i class="material-icons-outlined mr-2">add</i> New Patient/Volunteer</a>
				</div>
				<div class="card">
					<div class="card-body px-0">
						<ul class="product-tab-list nav tab-border">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#upcomingAppointments">
									<span>Invite / Save Patient List</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#pastAppointments">
									<span>Added Patient</span>
								</a>
							</li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane p-3 active" id="upcomingAppointments">
								<div class="row">
									@if(Session::has('msg'))
			                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
			                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                                <span aria-hidden="true">&times;</span>
			                              </button>
			                              {{ Session::get('msg') }}
			                            </div>
			                        @endif
								</div>
								<div class="table-responsive">
									<table class="table table-rounded AppointmentTable" id="savePatientlist">
				                        <thead class="text-secondary">
				                            <tr>
				                            	
				                                <th style="width: 150px;">First Name</th>
				                                <th style="width: 150px;">Last Name</th>
				                                <th>Email</th>
				                                <th style="width: 150px;">Status</th>
				                                <th style="width: 150px;">Verified</th>
				                                <th style="width: 200px;">Created At</th>
				                                <th style="width: 100px;">Action</th>
				                            </tr>
				                        </thead>

				                        <tbody class="align-middle">
				                        	@foreach($data as $key=>$value)
				                            <tr>
				                                <td>{{$value['getUsers']->firstname}}</td>
				                                <td>{{$value['getUsers']->lastname}}</td>
				                                <td>{{$value['getUsers']->email}}</td>
				                                <td>{{($value['getStatusFromScreenVisit']->count() ? 'Completed Screen Visit' : 'Inprocess')}}</td>
				                                <td>
				                                	@if($value['getUsers']->verified)
				                                		<span class="badge badge-success p-2 w-100">Verified</span>
				                                	@else
				                                		<span class="badge badge-danger p-2 w-100">Not Verified</span>
				                                	@endif
				                                </td>
				                                <td>{{$value['getUsers']->created_at}}</td>
				                                <td class="action">
				                                	<a class="btn" href="{{url('/dashboard/patient/view')}}/{{$value['getUsers']->id}}"><i class="material-icons-outlined text-secondary">visibility</i></a>

				                                	@if($value['getUsers']->verified)
				                                	<button type="button" class="btn">
			                                    		<a href="{{url('/dashboard/startchat/')}}/{{($value['getUsers']->id ? $value['getUsers']->id : 'null')}}"
			                                    		<i class="material-icons-outlined text-success">chat_bubble_outline</i>
			                                    		</a>
			                                    	</button>
			                                    	@endif
				                                </td>
				                            </tr>
				                            @endforeach
				                        </tbody>
				                    </table>
			                    </div>
							</div>
							<div class="tab-pane p-3 fade" id="pastAppointments">
								<div class="table-responsive">
									<table class="table table-rounded AppointmentTable" id="savePatientlist2">
				                        <thead class="text-secondary">
				                            <tr>
				                                <th style="width: 150px;">First Name</th>
				                                <th style="width: 150px;">Last Name</th>
				                                <th>Email</th>
				                                <th style="width: 150px;">Status</th>
				                                <th style="width: 150px;">Verified</th>
				                                <th style="width: 200px;">Created At</th>
				                                <th style="width: 100px;">Action</th>
				                            </tr>
				                        </thead>
				                        <tbody class="align-middle">
				                        	@foreach($data2 as $key=>$value)
				                            <tr>
				                                <td>{{$value->firstname}}</td>
				                                <td>{{$value->lastname}}</td>
				                                <td>{{$value->email}}</td>
				                                <td>{{($value['getStatusFromScreenVisit']->count() ? 'Completed Screen Visit' : 'Inprocess')}}</td>
				                                <td>
				                                	
				                                	@if($value->verified)
				                                		<span class="badge badge-success p-2 w-100">Verified</span>
				                                	@else
				                                		<span class="badge badge-danger p-2 w-100">Not Verified</span>
				                                	@endif

				                                </td>
				                                <td>{{$value->created_at}}</td>
				                                <td class="action"><a class="btn" href="{{url('/dashboard/patient/view')}}/{{$value->id}}"><i class="material-icons-outlined text-secondary">visibility</i></a>
				                                	@if($value->verified)
				                                	<button type="button" class="btn">
			                                    		<a href="{{url('/dashboard/startchat/')}}/{{($value->id ? $value->id : 'null')}}"
			                                    		<i class="material-icons-outlined text-success">chat_bubble_outline</i>
			                                    		</a>
			                                    	</button>
			                                    	@endif
				                                </td>
				                            </tr>
				                            @endforeach
				                        </tbody>
				                    </table>
			                    </div>
			                </div>
						</div>		
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<div class="modal fade" id="findPatient">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header align-items-center">
				<h5 class="modal-title mb-0 text-secondary">Invite A Patient</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<form class="form" action="{{route('Dashboard.savedPatient')}}" method="post">
					@csrf
					<div class="row gutters-2">
						<div class="col-md-6 form-group">
							<label><span class="red_required">*</span>First Name</label>
							<input type="text" required name="fname" value="{{ old('fname') }}" maxlength="20" class="form-control">
							@error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>

						<div class="col-md-6 form-group">
							<label><span class="red_required">*</span>Last Name</label>
							<input type="text" maxlength="20" required name="lname" value="{{ old('lname') }}" class="form-control">
							@error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>

						<!-- <div class="col-md-12 form-group">
							<label>Patient Id</label>
							<input type="text" name="patient_id" value="{{ old('patient_id') }}" class="form-control">
							@error('patient_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div> -->

						<div class="col-md-6 form-group">
							<label><span class="red_required">*</span>Email</label>
							<input type="email" maxlength="50" required name="email" value="{{ old('email') }}" class="form-control">
							@error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<!-- <div class="col--6 form-group">
							<label>Phone</label>
							<input type="number" required name="phone" value="{{ old('phone') }}" class="form-control">
							@error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="col-md-6 form-group">
							<label>DOB</label>
							<input type="date" required name="dob" value="{{ old('dob') }}" class="form-control">
							@error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="col-md-12 form-group">
							<label>Message</label>
							<textarea name="address" required class="form-control">{{ old('city') }}</textarea>
							@error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div> -->
						<input type="hidden" name="redirect" value="Dashboard.patientList">
						<div class="col-12 text-center mt-4">
							<button type="submit" class="btn btn-orange btn-wide">Invite</button>
						</div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="PatientAgreement">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header align-items-center">
				<h5 class="modal-title mb-0 text-secondary">Warning</h5>
				<!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<p>By approving this volunteer, you agree to abide by the following:</p>
				<ul>
				<li>Code of Federal Regulations, 45CFR46, governing the protection of human subjects in research.</li>
				<li>Not to discriminate based on race,sex, sexual preference ,religion,and socio-economic status.</li>
				<li>Good clinical practice (GCP) guidelines, by assuring that the rights, safety, and wellbeing of trial subjects are protected, consistent with the principles that have their origin in the Declaration of Helsinki, and that the clinical trial data are credible.</li>
				<li>That the personal information that you receive from Volunteers shall be used for the sole purpose of enrolling volunteers for clinical trials.</li>
				<li>You attest that the clinical trial you listed was reviewed and approved by an Institutional Review Board or similar regulatory agency.</li>
				<li>HIPAA Privacy Rule that establishes the conditions under which protected health information may be used or disclosed by covered entities for research purposes.</li>
				</ul>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary agree-btn">Agree</button>
				<a href="{{url('dashboard')}}" class="btn btn-warning">Not Agree</a>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
$(document).ready( function () {
  $('.agree-btn').click(function(){
  	$('#PatientAgreement').modal('hide');
  });
  // $('#PatientAgreement').modal('show');

  $('#savePatientlist').DataTable();
  $('#savePatientlist2').DataTable();

  @if ($errors->count())
  	$('#findPatientModel').click();
  @endif

});
</script>
@endsection