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
					<span>View Clinical Trials</span>
					<!-- <div>
						<a href="submit-clinical-trial.html" class="btn btn-outline-white">IRB Approval Required</a>
						<a href="submit-clinical-trial-2.html" class="btn btn-secondary ml-2">IRB Approval not Required</a>
					</div> -->
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
				                    @if(Auth::user()->role == '6')
				                        <a href="{{route('Dashboard.SuperAdmin.getSavedTrial')}}" class="btn btn-secondary btn-sm py-2 pull-right m-2">Back</a>
				                    @else
				                        <a href="{{route('Dashboard.getSavedTrial')}}" class="btn btn-secondary btn-sm py-2 pull-right m-2">Back</a>
				                    @endif

				                    <button type="button" data-toggle="modal" data-target="#InviteUser" class="btn btn-warning btn-sm py-2 pull-right m-2">Share / Invite User</button>
				                </div>
				            </div>
							<form class="form" action="{{route('Dashboard.addSubmitClinicalTrial')}}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="row">
									<div class="col-md-12 form-group">
										<label>Full Title of Study</label>
										<!-- <input type="text" name="" class="form-control"> -->

										<textarea class="form-control" name="trial" rows="3" readonly>{{$clinical_trials->trial}}</textarea>

										<!-- <select class="form-control custom-select" name="trial" value="{{ old('trial') }}">
											<option selected disabled="">Select Trial</option>
											@foreach($trials as $key=>$value)
												<option value="{{$value->id}}">{{$value->Condition}} : {{substr_replace($value->BriefTitle, "...", 50)}}</option>
											@endforeach
										</select>
										@error('trial')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror -->

									</div>
	                                <!-- <div class="col-md-6 form-group">
										<label>Principal Investigator’s Name</label>
										<select class="form-control custom-select" name="principal_inv" value="{{ old('principal_inv') }}">
											<option selected disabled="">Select Principal Inv.</option>
											@foreach($principal_inv as $key=>$value)
												<option value="{{$value->id}}">{{$value->firstname}} {{$value->lastname}}</option>
											@endforeach
										</select>
										@error('principal_inv')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div> -->
									<div class="col-md-6 form-group">
										<label>Research Site Name</label>
										<input type="text" name="research_site_name" value="{{$clinical_trials->research_site_name}}" readonly class="form-control">
									</div>

									<div class="col-md-6 form-group">
										<label>NCT number</label>
										<input type="text" name="nct_number" value="{{$clinical_trials->nct_number}}" readonly class="form-control">
									</div>

	                                <div class="col-md-12 form-group">
										<label>Brief Description of Study Visits (e.g. number of visits, frequency,etc)</label>
										<textarea class="form-control" name="no_of_visit" rows="3" readonly>{{$clinical_trials->no_of_visit}}</textarea>
									</div>
									<div class="col-md-6 form-group">
										<label>Address</label>
										<input type="text" name="address" value="{{$clinical_trials->address}}" class="form-control" readonly>
									</div>
	                                <div class="col-md-6 form-group">
										<label>City</label>
										<input type="text" name="city" value="{{$clinical_trials->city}}" class="form-control" readonly>
									</div>
									<div class="col-6 col-xl-3 form-group">
										<label>State</label>
										<input type="text" name="state" value="{{$clinical_trials->state}}" class="form-control" readonly>
									</div>
	                                <div class="col-6 col-xl-3 form-group">
										<label>Zip Code</label>
										<input type="text" name="zipcode" value="{{$clinical_trials->zipcode}}" class="form-control" readonly>
									</div>
	                                <div class="col-md-6 col-xl-3 form-group">
										<label>Email</label>
										<input type="email" name="email" value="{{$clinical_trials->email}}" class="form-control" readonly>
									</div>
	                                <div class="col-md-6 col-xl-3 form-group">
										<label>Phone No.</label>
										<input type="text" name="phone_no" value="{{$clinical_trials->phone_no}}" class="form-control" readonly>
									</div>
									<div class="col-12 form-group">
										<label>Purpose of the study </label>
										<textarea class="form-control" name="purpose_of_the_study" rows="3" readonly>{{$clinical_trials->purpose_of_the_study}}</textarea>
									</div>
									<div class="col-md-6 form-group">
										<label>Expiry Date</label>
										<input type="date" name="expiry_date" value="{{$clinical_trials->expiry_date}}" class="form-control" readonly>
									</div>
									<div class="col-12 form-group">
										<label>Summary of the inclusion and exclusion criteria</label>
										<textarea class="form-control" name="summary" rows="3" readonly>{{$clinical_trials->summary}}</textarea>
									</div>
									<div class="col-12 form-group">
										<label>Is Placebo drug involved?</label>
										<div class="custom-radio">
	                                        <div class="radio">
	                                            <label>
	                                                <input type="radio" class="form-check-input" name="drug_involved" value="1" {{$clinical_trials->drug_involved == '1' ? 'checked' : ''}}>
	                                                <i class="form-icon"></i>yes
	                                            </label>
	                                        </div>
	                                        <div class="radio">
	                                            <label>
	                                                <input type="radio" class="form-check-input" name="drug_involved" checked="" value="2" {{$clinical_trials->drug_involved == '2' ? 'checked' : ''}}>
	                                                <i class="form-icon"></i>No
	                                            </label>
	                                        </div>
	                                    </div>
	                                </div>
									<div class="col-12 form-group">
										<label>List of participation benefits (e.g., a no-cost health examination)</label>
										<textarea class="form-control" rows="3" name="list_of_participation" readonly>{{$clinical_trials->list_of_participation}}</textarea>
									</div>
									<div class="col-12 form-group">
										<label>Informed Consent Language(s)</label>
										<textarea class="form-control" rows="3" name="lang_of_trial" readonly>{{$clinical_trials->lang_of_trial}}</textarea>
									</div>
									@if($clinical_trials->upload_files)
									<div class="col-12 form-group">
										<label>Upload the most current ICF</label>
										<div class="media align-items-center upload_file_block upload_file_length_1">
											<?php
												if($clinical_trials->upload_files){
													$files = explode(",", $clinical_trials->upload_files);
													$i = 1;
													foreach($files as $file){
														echo '<a href="'.$file.'">File '.$i.'</a>';
														echo '&nbsp | &nbsp';
														$i++;
													}
												}
											?>
										</div>
									</div>
									@endif
									<!--------------------------->

									<div class="col-12 form-group">
										<label>Synopsis</label>
										<textarea class="form-control" rows="3" name="synopsis" readonly>{{$clinical_trials->synopsis}}</textarea>
									</div>

									@if($clinical_trials->synopsis_upload_files)
									<div class="col-12 form-group">
										<label>Synopsis File</label>
										<div class="media align-items-center upload_file_block upload_file_length_1">
											<?php
												if($clinical_trials->synopsis_upload_files){
													$files = explode(",", $clinical_trials->synopsis_upload_files);
													$i = 1;
													foreach($files as $file){
														echo '<a href="'.$file.'">File '.$i.'</a>';
														echo '&nbsp | &nbsp';
														$i++;
													}
												}
											?>
										</div>
									</div>
									@endif

									<div class="col-12 form-group">
										<label>Objective</label>
										<textarea class="form-control" rows="3" name="objective" readonly>{{$clinical_trials->objective}}</textarea>
									</div>

									<div class="col-12 form-group">
										<label>Design</label>
										<textarea class="form-control" rows="3" name="design" readonly>{{$clinical_trials->design}}</textarea>
									</div>

									<div class="col-12 form-group">
										<label>Complete Inclusion Criteria</label>
										<textarea class="form-control" rows="3" name="complete_inclusion_criteria" readonly>{{$clinical_trials->complete_inclusion_criteria}}</textarea>
									</div>

									<div class="col-12 form-group">
										<label>Complete Exclusion Criteria</label>
										<textarea class="form-control" rows="3" name="complete_exclusion_criteria" readonly>{{$clinical_trials->complete_exclusion_criteria}}</textarea>
									</div>

									<div class="col-12 form-group">
										<label>Citations</label>
										<textarea class="form-control" rows="3" name="citations" readonly>{{$clinical_trials->citations}}</textarea>
									</div>

									@if($clinical_trials->citations_upload_files)
									<div class="col-12 form-group">
										<label>Citations File</label>
										<div class="media align-items-center upload_file_block upload_file_length_1">
											<?php
												if($clinical_trials->citations_upload_files){
													$files = explode(",", $clinical_trials->citations_upload_files);
													$i = 1;
													foreach($files as $file){
														echo '<a href="'.$file.'">File '.$i.'</a>';
														echo '&nbsp | &nbsp';
														$i++;
													}
												}
											?>
										</div>
									</div>
									@endif

									<div class="col-12 form-group">
										<label>Additional information</label>
										<textarea class="form-control" rows="3" name="additional_information" readonly>{{$clinical_trials->additional_information}}</textarea>
									</div>

									<!--------------------------->
									<!-- <div class="col-12 text-center mt-4">
										<button type="submit" class="btn btn-orange btn-wide">Submit</button>
									</div> -->
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<div class="modal fade" id="InviteUser">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header align-items-center">
                <h5 class="modal-title mb-0 text-secondary">Share/Invite User</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form class="form" action="{{route('Dashboard.InviteUsers')}}" method="post">
                    @csrf
                    <div class="row gutters-2">
                        <div class="col-md-12 form-group">
                            <label>Share Link for Trial:</label>
                            <a href="{{url('/findInternalStudyDetails/details/')}}/{{$clinical_trials->id}}" target="__blank">{{url('/findInternalStudyDetails/details/')}}/{{$clinical_trials->id}}</a>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>User Types</label>
                            <div class="custom-radio">
                                @if(Auth::user()->role == '1')
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="form-check-input" name="role" value="1" checked="">
                                        <i class="form-icon"></i>Physicians
                                    </label>
                                </div>
                                @elseif(Auth::user()->role == '5')
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="form-check-input" name="role" value="5">
                                        <i class="form-icon"></i>Principal Inv.
                                    </label>
                                </div>
                                @endif
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="form-check-input" name="role" value="2">
                                        <i class="form-icon"></i>Patient/Volunteer
                                    </label>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input type="text" required name="fname" value="{{ old('fname') }}" class="form-control">
                            @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input type="text" required name="lname" value="{{ old('lname') }}" class="form-control">
                            @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input type="email" required name="email" value="{{ old('email') }}" class="form-control">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" name="nct_id" value="{{$clinical_trials->id}}">
                        <input type="hidden" name="share_link" value="{{url('/findInternalStudyDetails/details/')}}/{{$clinical_trials->id}}">
                        <input type="hidden" name="redirect" value="Dashboard.patientList">
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-orange btn-wide">Share / Invite</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection