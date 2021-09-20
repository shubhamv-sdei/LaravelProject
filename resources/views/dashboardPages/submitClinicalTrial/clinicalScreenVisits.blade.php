@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')				
<div class="content-wrapper">
	<div class="p-3 p-md-4">
		<div class="wrapper">
			<div class="wrapper-title">
				<span>Manage Clinical Screen Visits</span>
			</div>
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-6 col-lg-4">
							<!-- <div class="input-group input-group-inner">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="material-icons-outlined">search</i></span>
								</div>
								<input type="text" name="" class="form-control" placeholder="Search">
							</div> -->
						</div>
						@if(Auth::user()->role != '6' && Auth::user()->role != '4')
						<div class="col-md-6 col-lg-8 text-md-right">
							<button type="button" class="btn btn-secondary btn-wide" data-toggle="modal" data-target="#ClinicalTrialVisit">Create</button>
						</div>
						@endif
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
                        <table class="table table-rounded ScreenVisitTable">
                            <thead class="text-secondary align-middle">
                                <tr>
                                	<th>Patient Name</th>
                                	<th>Inv. Name</th>
                                    <th>Name of Clinical Trial</th>
                                    <th>Screen Visit Scheduled Date</th>
                                    <th>Screen Status</th>
                                    <th>Added by</th>
                                    <th>Payment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                            	@if($screenVisit)
                            		@foreach($screenVisit as $value)
                            		<tr>
                            			<td>{{$value['getPatient']->firstname}} {{$value['getPatient']->lastname}}</td>
                            			<td>{{$value['getInvistigator']->firstname}} {{$value['getInvistigator']->lastname}}</td>
	                                	<td>{{substr_replace($value['getTrial']->BriefTitle, "...", 50)}}</td>
	                                	<td>{{date('Y-m-d', strtotime($value->screen_visit_schedule_date))}}</td>
		                                    <td>{{($value->	screen_visit_complete == '1' ? 'Complete' : 'Inprocess')}}</td>
	                                    <td>{{Helper::getUserNameWithRole($value->created_by)}}</td>
	                                    <td class="action"><button type="button" class="btn" onclick="getPaymentHistory({{$value->id}})">
	                                    		<i class="material-icons-outlined text-warning">update</i>
	                                    	</button></td>
	                                    <td class="action">
	                                    	<a class="btn" href="{{url('/dashboard/ViewClinicalScreenVisit/')}}/{{$value->id}}"><i class="material-icons-outlined text-secondary">visibility</i></a>
		                                </td>
	                                </tr>
                            		@endforeach
                            	@else
                                <tr>
                                	<td colspan="20">
                                		<h4 class="text-center mt-4">No data available in table</h4>
                                	</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
</main>

<div class="modal fade" id="ClinicalTrialVisit">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mb-0 text-secondary">Clinical Screen Visits</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form action="{{route('Dashboard.SubmitClinicalScreenVisit')}}" method="POST">
						@csrf
						<div class="row gutters-1">
							<div class="row gutters-1 step_1">
								<input type="hidden" name="id" id="id">
								<div class="col-md-6 form-group">
									@if($saveTrial)
										<label><span class="red_required">*</span>Clinical Research</label>
										<select class="form-control custom-select" name="trial_id" value="{{ old('trial_id') }}" id="trial" required>
											<option selected disabled="">Select Trial</option>
											
												@foreach($saveTrial as $key=>$value)
													@if(isset($value['getTrial']) && $value['getTrial'])
													<option value="{{$value['getTrial']->id}}">

														{{$value['getTrial']->Condition}} : {{substr_replace($value['getTrial']->BriefTitle, "...", 50)}}
													</option>
													@else
													<option value="{{$value->id}}">
														{{$value->Condition}} : {{substr_replace($value->BriefTitle, "...", 50)}}
													</option>
													@endif
												@endforeach
										</select>
										@error('trial')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									@endif
								</div>
								<div class="col-md-6 form-group">
										<label><span class="red_required">*</span>Patient Name</label>
										<select class="form-control custom-select" name="patient_id" value="{{ old('patient_id') }}" id="patient_id" required>
											<option selected disabled="">Select Patient</option>
										</select>
										@error('patient_id')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
								</div>

								@if(Auth::user()->role == '5')
								<!--Invistigator Block-->
								<!-- <div class="col-md-12">
								<label><b><u>Screen Visit Status details for Investigator</u></b></label>
								</div> -->
								<div class="col-6 form-group">
									<label><span class="red_required">*</span>Screen Visit Scheduled Date</label>
									<input type="date" name="inv_screen_visit_schedule_date" id="visit_schedule_date" class="form-control" required>
								</div>
								<div class="col-6 form-group">
									<label><span class="red_required">*</span>Patient/Volunteer has completed required procedures for a Screen visit</label>
									<div class="custom-radio">
	                                    <div class="radio">
	                                        <label>
	                                            <input type="radio" required class="form-check-input screen_visit" name="inv_screen_visit_complete" value="1">
	                                            <i class="form-icon"></i>Yes
	                                        </label>
	                                    </div>
	                                    <div class="radio">
	                                        <label>
	                                            <input type="radio" required class="form-check-input screen_visit" name="inv_screen_visit_complete" value="2">
	                                            <i class="form-icon"></i>No
	                                        </label>
	                                    </div>
	                                </div>
								</div>
								<div class="col-12 form-group hide" id="screen_visit_no">
									<label><span class="red_required">*</span>Provide Reason(s)</label>
									<textarea class="form-control" name="inv_reason" id="case_notes" rows="3"></textarea>
								</div>
								<div class="col-6 form-group hide" id="screen_visit_yes">
									<label><span class="red_required">*</span>Date Screen Visit Completed</label>
									<input type="date" name="inv_screen_visit_complete_date" id="visit_comp_date" class="form-control">
								</div>

								@elseif(Auth::user()->role == '2')
								<!--Patient Block-->
								<!-- <div class="col-md-12">
									<label><b><u>Screen Visit Status details for Patient/Volunteer</u></b></label>	
								</div> -->
								
								<div class="col-6 form-group">
									<label><span class="red_required">*</span>Screen Visit Scheduled Date</label>
									<input type="date" name="patient_screen_visit_schedule_date" id="visit_schedule_date_patient" class="form-control" required>
								</div>
								<div class="col-6 form-group">
									<label><span class="red_required">*</span>Have you completed all required procedures for the Screen visit? <small>(Please check with the site if you are not sure)</small> </label>
									<div class="custom-radio">
	                                    <div class="radio">
	                                        <label>
	                                            <input type="radio" required class="form-check-input screen_visit_patient" name="patient_screen_visit_complete" value="1">
	                                            <i class="form-icon"></i>Yes
	                                        </label>
	                                    </div>
	                                    <div class="radio">
	                                        <label>
	                                            <input type="radio" required class="form-check-input screen_visit_patient" name="patient_screen_visit_complete" value="2">
	                                            <i class="form-icon"></i>No
	                                        </label>
	                                    </div>
	                                </div>
								</div>
								<div class="col-12 form-group hide" id="screen_visit_no_patient">
									<label><span class="red_required">*</span>Provide Reason(s)</label>
									<textarea class="form-control" name="patient_reason" id="case_notes_patient" rows="3"></textarea>
								</div>
								<div class="col-6 form-group hide" id="screen_visit_yes_patient">
									<label><span class="red_required">*</span>Date Screen Visit Completed</label>
									<input type="date" name="patient_screen_visit_complete_date" id="visit_comp_date_patient" class="form-control">
								</div>
								@endif
								<div class="col-12 form-group text-center mt-4">
									<button type="button" class="btn btn-orange btn-wide" onclick="NextBlock()">Next</button>
								</div>
							</div>
							<div class="row gutters-0 step_2 hide">
								<p>
									Due diligence has been done by the referring physician and/or CM in identifying a potential eligible patient/volunteer for your clinical trial. The Principal Investigator agrees to the following:
								</p>
								<ul>
									<li>Abide by the Code of Federal Regulations, 45CFR46, governing the protection of human subjects in research and Good clinical practice (GCP) guidelines. That the personal health information (PHI) that you receive from ClinicalMatch and the Volunteer shall be used for the sole purpose of enrolling the volunteer for your clinical trial.</li>
									<li>Eligibility determined by a referring healthcare provider is based on the patient/volunteer current demographic, medical, and laboratory and other information provided.</li>
									<li>Investigator will make a final determination before proceeding with matched patient/volunteer. Investigator may contact the matched patient/volunteer and setup a Screen visit.</li>
									<li>Investigator will pay ClinicalMatch the agreed matching fee for a Screen visit completed by the matched patient/volunteer.</li>
									<li>A Screen visit is said to be completed if the patient/volunteer signed the Informed Consent Form and completed the required procedures for a Screen visit as defined by the study protocol.</li>
									<li>The full amount of the Matching Fee shall be due and payable upon completion of the Screen visit.</li>
									<li>The Investigator shall inform ClinicalMatch when the Volunteer has met conditions for completion of a Screen Visit as set in 4 above.</li>
								</ul>
									<p>The preliminary determination about a patient/volunteer’s eligibility does not guarantee that the patient /volunteer will successfully screen for the study. It is the responsibility of the Investigator to carefully assess the chances of the patient/volunteer passing a Screen visit.</p>
<p>The Matching Fee shall be considered earned by ClinicalMatch and therefore nonrefundable regardless if the Volunteer is a Screen Fail. The Investigator can re-screen the Volunteer per study protocol at no extra cost to the Investigator.</p>
								<div class="col-6 form-group">
									<input type="checkbox" id="agree" name="vehicle1" value="Bike" required>
									<label for="agree"> I agree all then above conditions.</label>
								</div>
								<div class="col-12 form-group text-center mt-4">
									<button type="button" class="btn btn-warning btn-wide" onclick="moveBack()">Back</button>
									<button type="submit" class="btn btn-orange btn-wide">Submit</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	

<div class="modal fade" id="Paymentlog">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header align-items-center">
				<h5 class="modal-title mb-0 text-secondary">Payment Log</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<div class="table-responsive">
				<table class="table">
					<tr>
						<th>User Name</th>
						<th>Description</th>
						<th>Amount</th>
						<th>Txn Id</th>
						<th>Status</th>
						<th>Date</th>
					</tr>
					<tbody id="assigned_table_body">
						
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function(){
	$('.ScreenVisitTable').DataTable();
	
	$('#trial').change(function(){
		var trial_id = $(this).val();
		$.ajax({
		  url:"{{ route('Dashboard.getPatientListByTrial') }}",
		  method:"GET",
		  data:{trial_id:trial_id},
		  success:function(data){
		  	console.log(data);
		    $('#patient_id').html(data);
		   
		  }
		});
	});

	$('.screen_visit').change(function(){
		$('#screen_visit_no').addClass('hide');
		$('#screen_visit_yes').addClass('hide');
		if($(this).val() == '1'){
			// Yes
			$('#screen_visit_yes').removeClass('hide');
		}else{
			// No
			$('#screen_visit_no').removeClass('hide');
		}
	});

	$('.screen_visit_patient').change(function(){
		$('#screen_visit_no_patient').addClass('hide');
		$('#screen_visit_yes_patient').addClass('hide');
		if($(this).val() == '1'){
			// Yes
			$('#screen_visit_yes_patient').removeClass('hide');
		}else{
			// No
			$('#screen_visit_no_patient').removeClass('hide');
		}
	});
});

function getPaymentHistory(id){
	$.ajax({
      url:"{{ route('Dashboard.screenVisitlog') }}",
      method:"GET",
      data:{"id":id},
      success:function(data){ 
       	$('#assigned_table_body').html(data);
       	$('#Paymentlog').modal('show');
      }
    });
}

function NextBlock(){
	var msg = 'Please fill all the required fields.';
	var trial = $('#trial').val();
	var patient_id = $('#patient_id').val();
	var visit_schedule_date = $('#visit_schedule_date').val();
	var screen_visit = $('input[name="inv_screen_visit_complete"]:checked').val();

	var visit_schedule_date_patient = $('#visit_schedule_date_patient').val();
	var screen_visit_patient = $('input[name="patient_screen_visit_complete"]:checked').val();

	@if(Auth::user()->role == '5') // Principal Inv.
	if(trial && patient_id && visit_schedule_date && screen_visit){
		var flag = false;
		
		if(screen_visit == '1' && $('#visit_comp_date').val()){
			flag = true;
		}else if(screen_visit == '2' && $('#case_notes').val()){
			flag = true;
		}else{
			flag = false;
		}
		if(flag){
			moveNext();
		}else{
			alert(msg);
		}
	}else{
		// console.log('Intake');
		alert(msg);
	}
	@endif

	@if(Auth::user()->role == '2') // Patient
	if(trial && patient_id && visit_schedule_date_patient && screen_visit_patient){
		var flag1 = false;
		if(screen_visit_patient == '1' && $('#visit_comp_date_patient').val()){
			flag1 = true;
		}else if(screen_visit_patient == '2' && $('#case_notes_patient').val()){
			flag1 = true;
		}else{
			flag1 = false;
		}
		if(flag1){
			moveNext();
		}else{
			alert(msg);
		}
	}else{
		// console.log('Intake');
		alert(msg);
	}
	@endif
}

function moveNext(){
	$('.step_1').addClass('hide');
	$('.step_2').removeClass('hide');
}

function moveBack(){
	$('.step_1').removeClass('hide');
	$('.step_2').addClass('hide');
}

function getClinicalTrialVisitData(id){
	$.ajax({
	  url:"{{ url('dashboard/getDetails/trialVisit') }}"+"/"+id,
	  method:"GET",
	  success:function(data){
		data=JSON.parse(data);
		var saveTrial = data.saveTrial;
		var trialVisit = data.trialVisit;
		var TrialHtml = data.TrialHtml;
		var PatientHtml = data.PatientHtml;
	  	
		var htmlSaveTrial = '<option selected disabled="">Select Trial</option>';
		htmlSaveTrial += TrialHtml;

		var htmlPatient = '<option selected disabled="">Select Patient</option>';
		htmlPatient += PatientHtml;

		$('#trial').html(htmlSaveTrial);
		$('#patient_id').html(htmlPatient);

		$('#id').val(trialVisit.id);
		$('#trial').val(trialVisit.clinical_id);
		$('#patient_id').val(trialVisit.patient_id);
		$('#research_site_id').val(trialVisit.research_site_id);
		$('#visit_name').val(trialVisit.visit_name);
		$('#date').val(trialVisit.date);
		$('#time').val(trialVisit.time);
		$('#status').val(trialVisit.status);
		$('#case_notes').val(trialVisit.case_notes);

		$('#trial').val(trialVisit.clinical_id);
		$('#patient_id').val(trialVisit.patient_id);
		$('#ClinicalTrialVisit').modal('show');
	  }
	});
}

function deleteManageClinicalTrialVisit(id){
	//Alert function
    swal({
	  title: "Are you sure you want to delete trial visit?",
	  text: "You will not be able to recover this action!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Yes, delete it!",
	  cancelButtonText: "Cancel",
	  closeOnConfirm: false,
	  closeOnCancel: false
	},
	function(isConfirm) {
	  if (isConfirm) {
        $.ajax({
          url:"{{ url('dashboard/DeleteClinicalTrialVisit/') }}/"+id,
          method:"GET",
          success:function(data){
           	swal({
	            title: "Deleted!",
	            text: "Trial Visit Deleted Successfully.",
	            type: "success"
	        }, function() {
	            location.reload();
	        });
          }
        });
	  } else {
	    swal("Cancelled", "Trial Visit Fail", "error");
	  }
	});
    //End Alert
}
</script>
@endsection