@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')				
<div class="content-wrapper">
	<div class="p-3 p-md-4">
		<div class="wrapper">
			<div class="wrapper-title">
				<span>Manage Clinical Trial Visits</span>
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
						@if(Auth::user()->role != '6')
						<div class="col-md-6 col-lg-8 text-md-right">
							<button type="button" class="btn btn-secondary btn-wide" data-toggle="modal" data-target="#ClinicalTrialVisit">Create</button>
						</div>
						@endif
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
                        <table class="table table-rounded TrialVisitTable">
                            <thead class="text-secondary align-middle">
                                <tr>
                                	<th>Participant Name</th>
                                    <th>Name of Clinical Trail</th>
                                    <th>Research Site Address</th>
                                    <th>Date & Time of Visits</th>
                                    <th>Visits Status</th>
                                    <th>Case Notes</th>
                                    <th>Payment</th>
                                    <th>Update Details</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                            	@if($trialVisit)
                            		@foreach($trialVisit as $value)
                            		<tr>
	                                	<td>{{substr_replace($value['getTrial']->BriefTitle, "...", 50)}}</td>
	                                    <td>{{$value['getPatient']->firstname}} {{$value['getPatient']->lastname}}</td>
	                                    <td>{{$value->research_site_id}}</td>
	                                    <td>{{$value->date}} {{$value->time}}</td>
	                                    <td>{{$value->status}}</td>
	                                    <td>{{substr_replace($value->case_notes,"...",50)}}</td>
	                                    <td>N/A</td>
	                                    <td class="action">
		                                	<button type="button" class="btn" onclick="getClinicalTrialVisitData({{$value->id}})"><i class="material-icons-outlined text-secondary">visibility</i></button>
		                                	<button type="button" class="btn" onclick="deleteManageClinicalTrialVisit({{$value->id}})">
	                                    		<i class="material-icons-outlined text-danger">delete</i>
	                                    	</button>
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
					<h5 class="modal-title mb-0 text-secondary">Manage Clinical Trial Visits</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form action="{{route('Dashboard.submitPatientListByTrial')}}" method="POST">
						@csrf
						<div class="row gutters-1">
							<input type="hidden" name="id" id="id">
							<div class="col-md-6 form-group">
								@if($saveTrial)
									<label><span class="red_required">*</span>Study Name</label>
									<select class="form-control custom-select" name="trial" value="{{ old('trial') }}" id="trial" required>
										<option selected disabled="">Select Trial</option>
										@foreach($saveTrial as $key=>$value)
											<option value="{{$value->id}}">
												{{$value->Condition}} : {{substr_replace($value->BriefTitle, "...", 50)}}
											</option>
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
							
							<div class="col-md-6 form-group">
								<label>Site Id</label>
								<input type="text" name="research_site_id" id="research_site_id" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label><span class="red_required">*</span>Visit Name</label>
								<input type="text" name="visit_name" id="visit_name" class="form-control" required>
							</div>
							<div class="col-6 col-md-3 form-group">
								<label><span class="red_required">*</span>Date</label>
								<input type="date" name="date" id="date" class="form-control" required>
							</div>
							<div class="col-6 col-md-3 form-group">
								<label><span class="red_required">*</span>Time</label>
								<input type="time" name="time" id="time" class="form-control" required>
							</div>
							<div class="col-md-6 form-group">
								<label><span class="red_required">*</span>Status</label>
								<input type="text" name="status" id="status" class="form-control" required>
							</div>
							<div class="col-12 form-group">
								<label><span class="red_required">*</span>Case Notes</label>
								<textarea class="form-control" name="case_notes" id="case_notes" required rows="3"></textarea>
							</div>
							<div class="col-12 form-group text-center mt-4">
								<button type="submit" class="btn btn-orange btn-wide">Save Trial Details</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
@endsection

@section('script')
<script>
$(document).ready(function(){
	$('.TrialVisitTable').DataTable();
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
});

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