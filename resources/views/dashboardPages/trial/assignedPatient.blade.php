@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					@if(Auth::user()->role == '5')
					<span>Request Assign Patient</span>
					@else
					<span>Assign Patient</span>
					@endif
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
						<div class="table-responsive">
	                        <table class="table table-rounded assigned_inv_trial">
	                            <thead class="text-secondary">
	                                <tr>
	                                    <th>Sr.No</th>
	                                    <th>Clinical Trial Name</th>
	                                    <th>Patient Name</th>
	                                    <th>Assigned Investigator</th>
	                                    <th>Added By</th>
	                                    <th>Status</th>
	                                    <th>Actions</th>
	                                </tr>
	                            </thead>
	                            <tbody class="align-middle">
	                            	@foreach($trial as $key=>$value)
	                                <tr>
	                                    <td>{{$key+1}}</td>
	                                    <td style="width: 300px;">{{$value->BriefTitle}}</td>
	                                    <td>
	                                    	<?php
	                                    		if(isset($value['getAssignment']->patient_ids)){
	                                    			$patient_ids = explode(",",$value['getAssignment']->patient_ids);
	                                    			foreach($patient_ids as $Pa_value){
	                                    				echo App\User::find($Pa_value)->getFullNameAttribute();
	                                    				echo ',';
	                                    			}
	                                    		}
	                                    	?>
	                                    </td>
	                                    <td>{{(isset($value['getAssignment']->investigator_id) && App\User::where('id',$value['getAssignment']->investigator_id)->count())  ? App\User::find($value['getAssignment']->investigator_id)->getFullNameAttribute() : 'N/A'}}</td>
	                                    <td>{{(isset($value['getAssignment']->assigned_by) && App\User::where('id',$value['getAssignment']->assigned_by)->count())  ? App\User::find($value['getAssignment']->assigned_by)->getFullNameAttribute() : 'N/A'}}</td>
	                                    <td>
	                                    	@if(isset($value['getAssignment']->patient_status) && $value['getAssignment']->patient_status == '1')
                                			<span class="badge badge-primary p-2 w-100">Pending</span>
                                			@elseif(isset($value['getAssignment']->patient_status) && $value['getAssignment']->patient_status == '2')
                                			<span class="badge badge-success p-2 w-100">Approved</span>
                                			@elseif(isset($value['getAssignment']->patient_status) && $value['getAssignment']->patient_status == '3')
                                			<span class="badge badge-danger p-2 w-100">Declined</span>
                                			@endif
	                                    </td>
	                                    <td class="action">
	                                    	@if(Auth::user()->role == '1') <!-- Physician -->
	                                    	@if(isset($value->id) && $value->id)
	                                    	@if($value->remark)
		                                		<a class="btn" href="{{url('/dashboard/findInternalStudyDetails/details')}}/{{$value->remark}}"><i class="material-icons-outlined text-secondary">visibility</i></a>
		                                	@else
	                                    	<button type="button" class="btn">
	                                    		<a class="btn" href="{{url('/dashboard/ViewSavedTrial')}}/{{$value->id}}"><i class="material-icons-outlined text-secondary">visibility</i></a>
	                                    	</button>
	                                    	@endif
	                                    	@endif
	                                    	@if(isset($value['getAssignment']->id) && $value['getAssignment']->id)
	                                    	<button type="button" class="btn">
	                                    		<a class="btn" href="{{url('/dashboard/ViewAssigned/patient/')}}/{{$value['getAssignment']->id}}"><i class="material-icons-outlined text-success">list</i></a>
	                                    	</button>
	                                    	@endif

	                                    	@if(isset($value['getAssignment']->investigator_id) && App\User::where('id',$value['getAssignment']->investigator_id)->count())
	                                    	<button type="button" class="btn" data-toggle="modal" data-target="#assignInvestigator" onclick="trialId({{$value->id}},'{{isset($value['getAssignment']->patient_ids) ? $value['getAssignment']->patient_ids : '' }}')">
	                                    		<i class="material-icons-outlined text-primary">person_add</i>
	                                    	</button>
	                                    	@endif
	                                    	<button type="button" class="btn" onclick="trialId({{$value->id}})" id="CancelAssignment">
	                                    		<i class="material-icons-outlined text-danger">cancel</i>
	                                    	</button>
	                                    	<button type="button" class="btn">
	                                    		<a href="{{url('/dashboard/startchat/')}}/{{(isset($value['getAssignment']->investigator_id) ? $value['getAssignment']->investigator_id : 'null')}}"
	                                    		<i class="material-icons-outlined text-success">chat_bubble_outline</i>
	                                    		</a>
	                                    	</button>
	                                    	@elseif(Auth::user()->role == '5') <!-- Principal Inv. -->
	                                    	@if($value->remark)
		                                		<a class="btn" href="{{url('/dashboard/findInternalStudyDetails/details')}}/{{$value->remark}}"><i class="material-icons-outlined text-secondary">visibility</i></a>
		                                	@else
	                                    	<button type="button" class="btn">
	                                    		<a class="btn" href="{{url('/dashboard/ViewSavedTrial')}}/{{$value->id}}"><i class="material-icons-outlined text-secondary">visibility</i></a>
	                                    	</button>
	                                    	@endif
	                                    	<button type="button" class="btn">
	                                    		<a class="btn" href="{{url('/dashboard/ViewAssigned/patient/')}}/{{$value['getAssignment']->id}}"><i class="material-icons-outlined text-success">list</i></a>
	                                    	</button>
	                                    	<button type="button" class="btn">
	                                    		<a class="btn" href="javascript:void(0);" onclick="ApprovedTrial({{$value['getAssignment']->id}})"><i class="material-icons-outlined text-success">check_circle</i></a>
	                                    	</button>
	                                    	<button type="button" class="btn">
	                                    		<a class="btn" href="javascript:void(0);" onclick="DisApprovedTrial({{$value['getAssignment']->id}})"><i class="material-icons-outlined text-danger">disabled_by_default</i></a>
	                                    	</button>
	                                    	<button type="button" class="btn">
	                                    		<a href="{{url('/dashboard/startchat/')}}/{{(isset($value['getAssignment']->assigned_by) ? $value['getAssignment']->assigned_by : 'null')}}"
	                                    		<i class="material-icons-outlined text-success">chat_bubble_outline</i>
	                                    		</a>
	                                    	</button>

	                                    	<button type="button" class="btn" onclick="getHistory({{$value->id}})">
	                                    		<i class="material-icons-outlined text-warning">update</i>
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
</main>
	
	<div class="modal fade" id="assignInvestigator">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header align-items-center">
					<h5 class="modal-title mb-0 text-secondary">Assign Patient</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<!--HIPPA Notification-->
					<div class="HIPPANotification">
						<div class="col-12 mt-4">
							<p>As a provider, you are ethically obligated to ensure that the interests of the patient you are about to refer are protected and to safeguard patient’s’ welfare, safety, and comfort. To fulfill these obligations, you must agree to the following:</p>
							<ul>
								<li>That you have reviewed the research protocol and found it to be scientifically sound ,and that the study meets ethical guidelines for research with human participants.</li>
								<li>That the patient’s chart has been reviewed and eligibility has been assessed based on study criteria.</li>
								<li>That in your best judgement this study is relevant to this patient.</li>
								<li>That the patient has received the information they need to make well-considered decisions, including informing them about the nature of the research and potential harms involved.</li>
								<li>That voluntary consent has been obtained from the patient or from the participant’s legally authorized representative if the participant lacks the capacity to consent.</li>
								<li>That reasonable efforts have been made to ensure that the patient understands that the study is not intended to benefit them individually and that the patient may refuse to participate or may withdraw from the protocol at any time.</li>
							</ul>
						</div>
						<div class="col-12 text-center mt-4 option-block">
							<button type="button" id="agree" class="btn btn-primary btn-wide">Agree</button>
							<button type="button" id="not_agree" class="btn btn-danger btn-wide">Not Agree</button>
						</div>
					</div>
					<div class="assignmentBlock hide">
						<form class="form" action="{{route('Dashboard.assignPatientProcess')}}" method="POST" id="payment-form">
						@csrf
							<div class="row gutters-2">
								<div class="col-md-12" style="text-align:justify;">
									According to the U.S. Food and Drug Administration’s Center for Drug Evaluation and Research, FDA regulations do not prohibit payments to physicians or other health care professionals for referrals of prospective study subjects.  Providing reimbursement to physicians for efforts to identify potential subjects may be acceptable, when reimbursing physicians for activities such as reviewing charts, assessing eligibility based on study criteria, and contacting patients for interest in receiving more information. Please complete the form below to satisfy this requirement.
								</div>
							</div>
							<span class="bank-errors" style="color:#de9183;"></span>
							<br/>
							<div class="row gutters-2">
								<div class="col-md-12 form-group selectInvBlock">
									<label><span class="red_required">*</span>Select Patient</label>
									<select class="form-control selectpicker" id="select-country" multiple data-live-search="true" name="patient[]">
									@foreach($patient_list as $key=>$value)
										<option value="{{$value->id}}">{{$value->firstname}} {{$value->lastname}} - {{$value->email}}</option>
									@endforeach
									</select>
									@error('patient')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>

								<input type="hidden" name="trial_id" value="" id="trial_name">

								<div class="col-md-12 form-group selectInvBlock notagreeBlock">
									<label><span class="red_required">*</span>Would you like to get reimbursed for your administrative efforts in identifying this patient?</label>
									<div class="custom-radio">
										<div class="radio">
				                            <label>
				                                <input type="radio" class="form-check-input" onclick="openRemberceForm('yes')" name="role" value="1" id="openRemberceFormid">
				                                <i class="form-icon"></i>Yes
				                            </label>
				                        </div>
				                        <div class="radio">
				                            <label>
				                                <input type="radio" class="form-check-input" onclick="openRemberceForm('no')" name="role" value="2">
				                                <i class="form-icon"></i>No
				                            </label>
				                        </div>
				                    </div>
				                    @error('role')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>

								<div class="yes_block hide">
									<div class="col-md-12 form-group">
										<label>Trial/Study</label>
										<input type="text" readonly class="form-control" name="trial_name_static" value="" id="trial_name_static">
										@error('trial_name_static')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
									</div>

									<div class="col-md-12 form-group">
										<label>Principal Inv. name</label>
										<input type="text" readonly class="form-control" name="inv_name_static" value="" id="inv_name_static">
										<input type="hidden" name="inv_id" value="" id="inv_id_static">
										@error('inv_name_static')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Date patient referred</label>
										<input type="date" name="date_patient_ref" id="date_patient_ref" value="{{old('date_patient_ref')}}" class="form-control">
										@error('date_patient_ref')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Chart Review</label>
										<input type="date" name="date_chart_review" id="date_patient_ref" value="{{old('date_chart_review')}}" class="form-control">
										@error('date_patient_ref')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Eligibility Assessment</label>
										<input type="date" name="date_eli_ass" id="date_patient_ref" value="{{old('date_eli_ass')}}" class="form-control">
										@error('date_patient_ref')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-md-12 form-group">
										<label>Date Patient was Contacted for Study Interest</label>
										<input type="text" name="study_intrest" value="{{old('study_intrest')}}" class="form-control">
										@error('study_intrest')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-md-12 form-group">
										<h6><b>Payment deposit information: Please provide details of where you would like your funds deposited.</b></h6>
									</div>

									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Institution/Clinic name</label>
										<input type="text" name="clinic_name" value="{{old('clinic_name')}}" class="form-control">
										@error('clinic_name')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Institution address</label>
										<input type="text" name="ins_address" value="{{old('ins_address')}}" class="form-control">
										@error('ins_address')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Tax ID</label>
										<input type="text" name="tax_id" value="{{old('tax_id')}}" class="form-control">
										@error('tax_id')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Country</label>
										<input type="text" data-stripe="country" class="form-control country" name="country" size="20" maxlength="20" value='US'>
									</div>

									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Currency</label>
										<input type="text" name="currency" data-stripe="currency" class="form-control currency" value='USD'>
									</div>

									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Account holder name :</label>
										<input type="text" name="account_holder_name" data-stripe="account_holder_name" class="form-control account_holder_name" value="{{old('account_holder_name')}}">
									</div>

									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Account holder type :</label>
										<input type="text" name="account_holder_type" data-stripe="account_holder_type" class="form-control account_holder_type" value=''>
									</div>

									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Bank name</label>
										<input type="text" name="bnk_name" value="{{old('bnk_name')}}" class="form-control">
										@error('bnk_name')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Routing</label>
										<input type="text" name="routing" value="{{old('routing')}}" data-stripe="routing_number" class="form-control routing_number">
										@error('routing')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Account number</label>
										<input type="text" name="acc_no" value="{{old('acc_no')}}" data-stripe="account_number" class="form-control account_number">
										@error('acc_no')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-md-12 form-group">
										<label><span class="red_required">*</span>Confirm Account number</label>
										<input type="text" name="conf_acc_no" value="{{old('conf_acc_no')}}" class="form-control">
										@error('conf_acc_no')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
								</div>
								
								<div class="agree_block">
									<div class="col-12 text-center mt-4">
									<button type="submit" class="btn btn-orange btn-wide">Assign</button>
									<button type="button" class="btn btn-secondary btn-wide">Cancel</button>
									</div>
								</div>
	                        </div>
	                    </form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="patientHIPPAAgree">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header align-items-center">
					<h5 class="modal-title mb-0 text-secondary">Information</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				
			</div>
		</div>
	</div>

	<div class="modal fade" id="Assignmentlog">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header align-items-center">
					<h5 class="modal-title mb-0 text-secondary">Assignment Log</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<div class="table-responsive">
					<table class="table">
						<tr>
							<th>Trial Title</th>
							<th>User Name</th>
							<th>Assigned To</th>
							<th>Assigned By</th>
							<th>Remark</th>
							<th>Operation</th>
							<th>Assigned At</th>
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
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
$(document).ready( function () {
  @if($errors->count())
  	$('#assignInvestigator').modal();
  	$('.HIPPANotification').addClass('hide');
  	$('.assignmentBlock').removeClass('hide');
  	$('.notagreeBlock').removeClass('hide');
  	$('#openRemberceFormid').click();
  @endif

  $('#agree').click(function(){
  	$('.HIPPANotification').addClass('hide');
  	$('.assignmentBlock').removeClass('hide');
  	$('.notagreeBlock').removeClass('hide');
  	$('.form').prop('id','payment-form');
  });

  $('#not_agree').click(function(){
  	$('.HIPPANotification').addClass('hide');
  	$('.assignmentBlock').removeClass('hide');
  	$('.notagreeBlock').addClass('hide');
  	$('.form').prop('id','no-payment-form');
  });


  $('.assigned_inv_trial').DataTable();

  $('#add_new_inv').click(function(){
  	if($(this).find('span').text() == "Add New"){
  		$(this).find('span').text('Remove');
  		$(this).find('i').text('remove');
  		$('.selectInvBlock').hide();
  	}else{
  		$(this).find('span').text('Add New');
  		$(this).find('i').text('add');
  		$('.selectInvBlock').show();
  	}
  	$('.add_new_block').toggle();
  });

  $('#CancelAssignment').click(function(){
	  	//Alert function
	    swal({
		  title: "Are you sure you want to un-assign investigator?",
		  text: "You will not be able to recover this action!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Yes, un-assign it!",
		  cancelButtonText: "Cancel",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm) {
		  if (isConfirm) {
		  	var trial_id = $('#trial_name').val();
            $.ajax({
              url:"{{ route('Dashboard.unAssignInv') }}",
              method:"GET",
              data:{trial_id:trial_id},
              success:function(data){
               	// swal("Un-Assigned!", "Un-Assigned Investigator Successfully.", "success"); 
               	swal({
		            title: "Un-Assigned!",
		            text: "Un-Assigned Investigator Successfully.",
		            type: "success"
		        }, function() {
		            location.reload();
		        });
              }
            });
		  } else {
		    swal("Cancelled", "Un-Assigned Fail", "error");
		  }
		});
	    //End Alert
  });

});

function openRemberceForm(option){
	if(option == 'yes'){
		$('.yes_block').removeClass('hide');
		$('.form').prop('id','payment-form');
	}else{
		$('.yes_block').addClass('hide');
		$('.form').prop('id','no-payment-form');
	}
}

function getHistory(trial_id){
	$.ajax({
      url:"{{ route('Dashboard.TrialAssignmentLog') }}",
      method:"GET",
      data:{trial_id:trial_id},
      success:function(data){ 
       	$('#assigned_table_body').html(data.html);
       	$('#Assignmentlog').modal('show');
      }
    });
}

function trialId(Id,patient_ids){
	
	$('#trial_name').val(Id);

	var selectedOptions = patient_ids.split(",");
	if(selectedOptions[0]){
		for(var i in selectedOptions) {
		    var optionVal = selectedOptions[i];
		    $(".selectpicker").find("option[value="+optionVal+"]").prop("selected", "selected");
		}
	}
	$(".selectpicker").selectpicker('refresh');

	$.ajax({
          url:"{{url('/dashboard/get/trial_inv/')}}/"+Id,
          method:"GET",
          success:function(data){
           	var pData = JSON.parse(data);
           	$('#trial_name_static').val(pData.trial_name);
           	$('#inv_name_static').val(pData.inv_name);
           	$('#inv_id_static').val(pData.inv_id);
          }
        });

	@if(!$errors->count())
	$('.HIPPANotification').removeClass('hide');
  	$('.assignmentBlock').addClass('hide');
  	$('.notagreeBlock').addClass('hide');
  	@endif
}

function ApprovedTrial(id){
	//Alert function
	    swal({
		  title: "Are you sure you want to Approve Patient?",
		  text: "You will not be able to recover this action!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Yes, Approve it!",
		  cancelButtonText: "Cancel",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm) {
		  if (isConfirm) {
		  	var trial_id = $('#trial_name').val();
            $.ajax({
              url:"{{url('/dashboard/approve/patient/')}}/"+id,
              method:"GET",
              success:function(data){
               	// swal("Un-Assigned!", "Un-Assigned Investigator Successfully.", "success"); 
               	swal({
		            title: "Approve!",
		            text: "Approved Patient Successfully.",
		            type: "success"
		        }, function() {
		            location.reload();
		        });
              }
            });
		  } else {
		    swal("Cancelled", "Approved Fail", "error");
		  }
		});
	//End Alert
}

function DisApprovedTrial(id){
	//Alert function
	    swal({
		  title: "Are you sure you want to Dis-Approve Patient?",
		  text: "You will not be able to recover this action!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Yes, Dis-Approve it!",
		  cancelButtonText: "Cancel",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm) {
		  if (isConfirm) {
		  	var trial_id = $('#trial_name').val();
            $.ajax({
              url:"{{url('/dashboard/disapprove/patient/')}}/"+id,
              method:"GET",
              success:function(data){
               	// swal("Un-Assigned!", "Un-Assigned Investigator Successfully.", "success"); 
               	swal({
		            title: "Dis-Approve!",
		            text: "Dis-Approve Patient Successfully.",
		            type: "success"
		        }, function() {
		            location.reload();
		        });
              }
            });
		  } else {
		    swal("Cancelled", "Dis-Approve Fail", "error");
		  }
		});
	//End Alert
}

Stripe.setPublishableKey("{{env('STRIPE_KEY')}}");
$(function() {
var $form = $('#payment-form');
$form.submit(function(event) {
	if($('.form').prop('id') != 'payment-form'){
		return true;
	}

// Disable the submit button to prevent repeated clicks:
$form.find('.submit').prop('disabled', true);// Request a token from Stripe:
Stripe.bankAccount.createToken($form, stripeResponseHandler);// Prevent the form from being submitted:
return false;
});
});

function stripeResponseHandler(status, response) {

  // Grab the form:
  var $form = $('#payment-form');

  if (response.error) { // Problem!

    // Show the errors on the form:
    $form.find('.bank-errors').text(response.error.message);
    $form.find('button').prop('disabled', false); // Re-enable submission

  } else { // Token created!

    // Get the token ID:
    var token = response.id;

    // Insert the token into the form so it gets submitted to the server:
    $form.append($('<input type="hidden" name="stripeToken" />').val(token));

    // Submit the form:
    $form.get(0).submit();

  }
}
</script>
@endsection
