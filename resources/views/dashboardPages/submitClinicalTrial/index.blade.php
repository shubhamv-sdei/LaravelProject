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
					<span>Submit Clinical Trials</span>
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
							<form class="form" action="{{route('Dashboard.addSubmitClinicalTrial')}}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="row">
									<div class="col-md-12 form-group">
										<label><span class="requiredcolor">*</span>Full Title of Study</label>
										<!-- <input type="text" name="" class="form-control"> -->

										<textarea class="form-control" name="trial" rows="3">{{old('trial')}}</textarea>
										@error('trial')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror

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
										<label><span class="requiredcolor">*</span>Research Site Name</label>
										<input type="text" name="research_site_name" value="{{old('research_site_name')}}" class="form-control">
										@error('research_site_name')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-md-6 form-group">
										<label><span class="requiredcolor">*</span>NCT number</label>
										<input type="text" name="nct_number" value="{{old('nct_number')}}" class="form-control">
										@error('nct_number')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

	                                <div class="col-md-12 form-group">
										<label><span class="requiredcolor">*</span>Brief Description of Study Visits @if(Auth::user()->role != '1')(e.g. number of visits, frequency,etc)@endif</label>
										<textarea class="form-control" name="no_of_visit" rows="3">{{old('no_of_visit')}}</textarea>
										@error('no_of_visit')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
									<div class="col-md-6 form-group">
										<label><span class="requiredcolor">*</span>Address</label>
										<input type="text" name="address" value="{{old('address')}}" class="form-control">
										@error('address')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
	                                <div class="col-md-6 form-group">
										<label><span class="requiredcolor">*</span>City</label>
										<input type="text" name="city" value="{{old('city')}}" class="form-control">
										@error('city')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
									<div class="col-6 col-xl-3 form-group">
										<label><span class="requiredcolor">*</span>State</label>
										<input type="text" name="state" value="{{old('state')}}" class="form-control">
										@error('state')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
	                                <div class="col-6 col-xl-3 form-group">
										<label><span class="requiredcolor">*</span>Zip Code</label>
										<input type="text" name="zipcode" value="{{old('zipcode')}}" class="form-control">
										@error('zipcode')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
	                                <div class="col-md-6 col-xl-3 form-group">
										<label><span class="requiredcolor">*</span>Email</label>
										<input type="email" name="email" value="{{old('email')}}" class="form-control">
										@error('email')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
	                                <div class="col-md-6 col-xl-3 form-group">
										<label>Phone No.</label>
										<input type="text" name="phone_no" value="{{old('phone_no')}}" class="form-control">
										@error('phone_no')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
									<div class="col-12 form-group">
										<label><span class="requiredcolor">*</span>Purpose of the study </label>
										<textarea class="form-control" name="purpose_of_the_study" rows="3">{{old('purpose_of_the_study')}}</textarea>
										@error('purpose_of_the_study')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
									<div class="col-md-6 form-group">
										<label><span class="requiredcolor">*</span>Expiry Date</label>
										<input type="date" name="expiry_date" value="{{old('expiry_date')}}" class="form-control">
										@error('expiry_date')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
									<div class="col-12 form-group">
										<label>Summary of the inclusion and exclusion criteria</label>
										<textarea class="form-control" name="summary" rows="3">{{old('summary')}}</textarea>
										@error('summary')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
									<div class="col-12 form-group">
										<label><span class="requiredcolor">*</span>Is Placebo drug involved?</label>
										<div class="custom-radio">
	                                        <div class="radio">
	                                            <label>
	                                                <input type="radio" class="form-check-input" name="drug_involved" value="1">
	                                                <i class="form-icon"></i>yes
	                                            </label>
	                                        </div>
	                                        <div class="radio">
	                                            <label>
	                                                <input type="radio" class="form-check-input" name="drug_involved" checked="" value="2">
	                                                <i class="form-icon"></i>No
	                                            </label>
	                                        </div>
	                                    </div>
	                                </div>
									<div class="col-12 form-group">
										<label>List of participation benefits @if(Auth::user()->role != '1')(e.g., a no-cost health examination)@endif</label>
										<textarea class="form-control" rows="3" name="list_of_participation">{{old('list_of_participation')}}</textarea>
										@error('list_of_participation')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
									<div class="col-12 form-group">
										<label>Informed Consent Language(s)</label>
										<textarea class="form-control" rows="3" name="lang_of_trial">{{old('lang_of_trial')}}</textarea>
										@error('lang_of_trial')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
									<div class="col-12 form-group">
										<label>Upload the most current ICF</label>
										<div class="media align-items-center upload_file_block upload_file_length_1">
											<div class="media-body mr-3">
												<input type="file" name="icf[]" class="form-control">
											</div>
											<a href="javascript:void(0)" onclick="addUploadBlock()"><i class="material-icons-outlined mi-24 text-danger ml-2">add_circle_outline</i></a>
										</div>
									</div>

									<!-------------------- ------->
									<div class="col-12 form-group">
										<label>Synopsis @if(Auth::user()->role != '1')(Note: some Sponsors require permission before sharing this information)@endif</label>
										<textarea class="form-control" rows="3" name="synopsis">{{old('synopsis')}}</textarea>
										@error('synopsis')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<!-- <div class="col-12 form-group">
										<span>OR</span>
									</div> -->

									<div class="col-12 form-group">
										<label>Synopsis File</label>
										<input type="file" class="form-control" name="synopsis_upload_files">{{old('synopsis_upload_files')}}</textarea>
										@error('synopsis_upload_files')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-12 form-group">
										<label>Objective @if(Auth::user()->role != '1')(skip if Synopsis provided)@endif</label>
										<textarea class="form-control" rows="3" name="objective">{{old('objective')}}</textarea>
										@error('objective')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-12 form-group">
										<label>Design @if(Auth::user()->role != '1')(skip if Synopsis provided)@endif</label>
										<textarea class="form-control" rows="3" name="design">{{old('design')}}</textarea>
										@error('design')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-12 form-group">
										<label>Complete Inclusion Criteria</label>
										<textarea class="form-control" rows="3" name="complete_inclusion_criteria">{{old('complete_inclusion_criteria')}}</textarea>
										@error('complete_inclusion_criteria')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-12 form-group">
										<label>Complete Exclusion Criteria</label>
										<textarea class="form-control" rows="3" name="complete_exclusion_criteria">{{old('complete_exclusion_criteria')}}</textarea>
										@error('complete_exclusion_criteria')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-12 form-group">
										<label>Citations @if(Auth::user()->role != '1')(You may share links to publications here)@endif</label>
										<textarea class="form-control" rows="3" name="citations">{{old('citations')}}</textarea>
										@error('citations')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-12 form-group">
										<label>Citations File</label>
		                                <input type="file" class="form-control" name="citations_upload_files">
										@error('citations_upload_files')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-12 form-group">
										<label>Additional information</label>
										<textarea class="form-control" rows="3" name="additional_information">{{old('additional_information')}}</textarea>
										@error('additional_information')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
									<!-------------------- ------->

									<div class="col-12 form-group">
										<label>Additional Information/Documents @if(Auth::user()->role != '1')<small>(Patient facing materials, recruitment materials, patient talking points,etc)</small>@endif</label>
										<textarea class="form-control" rows="3" name="additional_doc_name">{{old('lang_of_trial')}}</textarea>
										@error('lang_of_trial')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-12 form-group">
										<label>Upload Additional Information/Documents</label>
		                                <input type="file" class="form-control" name="additional_doc_file">
										@error('additional_doc_file')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>

									<div class="col-12 text-center mt-4">
										<button type="submit" class="btn btn-orange btn-wide">Submit</button>
									</div>
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
<script>
function addUploadBlock(){
	var upload_file_length = $('.upload_file_block').length + 1;
	var html = "";
	html += '<div class="media align-items-center upload_file_block upload_file_length_'+upload_file_length+'">';
	html += '<div class="media-body mr-3">';
	html += '<input type="file" name="icf[]" class="form-control">';
	html += '</div>';
	html += '<a href="javascript:void(0)" onclick="removeUploadBlock('+upload_file_length+')"><i class="material-icons-outlined mi-24 text-danger ml-2">remove_circle_outline</i></a>';
	html += '</div>';
	$('.upload_file_length_'+$('.upload_file_block').length).after(html);
}

function removeUploadBlock(list){
	$('.upload_file_length_'+list).remove();
}
</script>
@endsection