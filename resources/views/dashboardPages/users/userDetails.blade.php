@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
<div class="content-wrapper">
	<div class="p-3 p-md-4">
		<div class="wrapper">
			<div class="wrapper-title">
				<span>Professional Information</span>
			</div>
			<div class="card">
				<div class="card-header">
					<span class="lead fw-400">Overview</span>
				</div>
				@if(Session::has('msg'))
				    <div class="alert alert-warning alert-dismissible fade show" role="alert">
				      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				        <span aria-hidden="true">&times;</span>
				      </button>
				      {{ Session::get('msg') }}
				    </div>
				@endif
				<div class="card-body">
					<div class="p-xl-5 container">
						<div class="row">
							<div class="col-md-4 col-xl-3">
								<div class="border rounded d-flex flex-column align-items-center justify-content-center p-4 text-center">
									<div class="media-thumb xxl rounded-circle border mb-3">
										@if($user->image != "")
										<img src="{{asset(Auth::user()->image)}}">
										@else
										<img src="{{url('assets/avatar.jpg')}}">
										@endif
									</div>
									<h5>{{$user->getFullNameAttribute()}}</h5>
								</div>
							</div>
							<div class="col-md-8 col-xl-9 mt-3 mt-md-0">
								<div class="table-responsive">
									@if($user->role == 1)
									<table class="table">
										<tbody>
											<tr>
												<td>Job Title:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'job_title')}}</td>
											</tr>
											<tr>
												<td>
Are you currently conducting a clinical trial?</td>
												<td class="text-secondary">
												{{(Helper::placeValueFromArray($data,'conducting_a_clinical_trial') == 1 ? 'Yes' : 'No')}}
												
												</td>
											</tr>
											<tr>
												<td>Tile:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'tile')}}</td>
											</tr>
											<tr>
												<td>EMR Name:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'emr_name')}}</td>
											</tr>
											<tr>
												<td>Specialty:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'specialty')}}</td>
											</tr>
											<tr>
												<td>Sub Specialty:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'sub_specialty')}}</td>
											</tr>
											<tr>
												<td>Medical License Number:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'medicalLicense')}}</td>
											</tr>
											<tr>
												<td>Medical License State:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'medicalLicenseState')}}</td>
											</tr>
											<tr>
												<td>Indications treated:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'indications_treated')}}</td>
											</tr>
											<tr>
												<td>Number of patients seen per week?</td>
												<td class="text-secondary">
												@php
												$n_p_s_p_w = Helper::placeValueFromArray($data,'number_of_patients_seen_per_week');
												if($n_p_s_p_w == 1){
													echo '0-10';
												}else if($n_p_s_p_w == 2){
													echo '10-20';
												}else if($n_p_s_p_w == 3){
													echo '20-50';
												}else if($n_p_s_p_w == 4){
													echo '>50';
												}
												@endphp
												</td>
											</tr>
											<tr>
												<td>Caucasian:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'caucasian')}}</td>
											</tr>
											<tr>
												<td>Black/African American:</td>
												<td class="text-secondary">{{(Helper::placeValueFromArray($data,'black_african_american') == '1' ? 'Yes' : 'No')}}</td>
											</tr>
											<tr>
												<td>Native Hawaiian and other Pacific Islander:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'native_hawaiian_and_other_pacific_islander')}}</td>
											</tr>
											<tr>
												<td>Asian:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'asian')}}</td>
											</tr>
											<tr>
												<td>Native American:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'native_american')}}</td>
											</tr>
											<tr>
												<td>Alaska Native:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'alaska_native')}}</td>
											</tr>
											<tr>
												<td>Do you have clinical research experience?</td>
												<td class="text-secondary">{{(Helper::placeValueFromArray($data,'do_you_have_clinical_research_experience') == 1 ? 'Yes' : 'No')}}</td>
											</tr>
											<tr>
												<td>Are You Interested in Becoming a Sub-Investigator?</td>
												<td class="text-secondary">{{(Helper::placeValueFromArray($data,'are_you_interested_in_becoming_a_sub_investigator') == '1' ? 'Yes' : 'No')}}</td>
											</tr>
											<tr>
												<td>Resume:</td>
												<td class="text-secondary"><a href="{{asset(Helper::placeValueFromArray($data,'resume_path'))}}">Download</a></td>
											</tr>
											<tr>
												<td>Clinic Name:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'clinic_name')}}</td>
											</tr>
											<tr>
												<td>Clinic Address:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'clinic_address')}}</td>
											</tr>
											<tr>
												<td>Clinic Telephone:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'clinic_telephone')}}</td>
											</tr>
											<tr>
												<td>Clinic Fax:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'clinic_fax')}}</td>
											</tr>
											<tr>
												<td>Name of Contact person at clinic:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'name_of_contact_person_at_clinic')}}</td>
											</tr>
											<tr>
												<td>Email of Contact person at clinic:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'email_of_contact_person_at_clinic')}}</td>
											</tr>
											<tr>
												<td>Telephone of Contact person at clinic:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'telephone_of_contact_person_at_clinic')}}</td>
											</tr>
											<tr>
												<td>Size of patient Database:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'size_of_patient_database')}}</td>
											</tr>
											<tr>
												<td>Type of Medical Record Storage?</td>
												<td class="text-secondary">{{(Helper::placeValueFromArray($data,'type_of_medical_record_storage') == '1' ? 'Yes' : 'No')}}</td>
											</tr>
											<tr>
												<td>Type of Medical Establishment?</td>
												<td class="text-secondary">
												@php
												$t_o_m_e = Helper::placeValueFromArray($data,'type_of_medical_establishment');
												if($t_o_m_e == 1){
													echo 'Academic Institution';
												}else if($t_o_m_e == 2){
													echo 'Sale Provider private clinic';
												}else if($t_o_m_e == 3){
													echo 'Multiple provider private clinic';
												}else if($t_o_m_e == 4){
													echo 'Others';
												}
												@endphp
												</td>
											</tr>
										</tbody>
									</table>
									@elseif($user->role == 5)
									<table class="table">
										<tbody>
											<tr>
												<td>Job Title:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'job_title')}}</td>
											</tr>
											<tr>
												<td>Specialty:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'specialty')}}</td>
											</tr>
											<tr>
												<td>Sub Specialty:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'sub_specialty')}}</td>
											</tr>
											<tr>
												<td>Medical License Number:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'medical_license_number')}}</td>
											</tr>
											<tr>
												<td>Medical License State:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'medical_license_state')}}</td>
											</tr>
											<tr>
												<td>Years of clinical research Experience:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'yrs_of_clinical_research_exp')}}</td>
											</tr>
											<tr>
												<td>Therapeutic areas of clinical research experience:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'therapeutic_area_of_clinical_research_exp')}}</td>
											</tr>
											<tr>
												<td>Will you be accepting sub-investigators?</td>
												<td class="text-secondary">{{(Helper::placeValueFromArray($data,'will_you_be_accept_sub_invstigators') == '1' ? 'Yes' : 'No')}}</td>
											</tr>
											<tr>
												<td>Site Name:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'research_site_name')}}</td>
											</tr>
											<tr>
												<td>Site Address:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'research_site_address')}}</td>
											</tr>
											<tr>
												<td>Site Telephone:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'research_site_telephone')}}</td>
											</tr>
											<tr>
												<td>Site Fax:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'research_site_fax')}}</td>
											</tr>
											<tr>
												<td>Name of Contact Person at site</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'name_of_contact_person_at_research_site')}}</td>
											</tr>
											<tr>
												<td>Email of Contact Person at Site:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'email_of_contact_person_at_research_site')}}</td>
											</tr>
											<tr>
												<td>Telephone of contact person at site</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'telephone_of_contact_person_at_research_site')}}</td>
											</tr>
										</tbody>
									</table>
									@elseif($user->role == 2)
									<table class="table">
										<tbody>
											<tr>
												<td>First Name:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'first_name')}}</td>
											</tr>
											<tr>
												<td>Last Name:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'last_name')}}</td>
											</tr>
											<tr>
												<td>Physician Name:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'physician_name')}}</td>
											</tr>
											<tr>
												<td>Physician Email:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'physician_email')}}</td>
											</tr>
											<tr>
												<td>Physician Phone:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'physician_phone')}}</td>
											</tr>
											<tr>
												<td>Caregiver Name:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'caregiver_name')}}</td>
											</tr>
											<tr>
												<td>Caregiver Email:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'caregiver_email')}}</td>
											</tr>
											<tr>
												<td>Caregiver Phone:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'caregiver_phone')}}</td>
											</tr>
											<tr>
												<td>Date of birth:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'dob')}}</td>
											</tr>
											<tr>
												<td>Type:</td>
												<td class="text-secondary">{{(Helper::placeValueFromArray($data,'clinical_trial_type') == "1" ? 'I am volunteering for a clinical study' : 'I have a medical condition')}}</td>
											</tr>
											<tr>
												<td>Gender:</td>
												<td class="text-secondary">{{(Helper::placeValueFromArray($data,'gender') == "1" ? 'Male' : 'Female')}}</td>
											</tr>
											<tr>
												<td>Ethnicity:</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'ethnicity')}}</td>
											</tr>
											<tr>
												<td>Race</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'race')}}</td>
											</tr>
											<tr>
												<td>Preferred Language of comunication</td>
												<td class="text-secondary">{{Helper::placeValueFromArray($data,'preferred_lang_communication')}}</td>
											</tr>
										</tbody>
									</table>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</main>
@endsection