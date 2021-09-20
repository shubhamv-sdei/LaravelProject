@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')	
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>Professional Information</span>
					<a href="{{url('dashboard/professionalInfo')}}" class="btn btn-secondary btn-wide">Back</a>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="p-xl-5 container">
							@if(Auth::user()->role == 1)
							<form class="form" action="{{route('Dashboard.professionalInfo.update')}}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="row">
									<div class="col-md-6 form-group">
										<label>Job Title</label>
										<input type="text" name="job_title" class="form-control" value="{{Helper::placeValueFromArray($data,'job_title')}}">
									</div>
									<div class="col-md-6 form-group">
										<label>Are you currently conducting a clinical trial?</label>
										<div class="custom-radio">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="conducting_a_clinical_trial" value="1" {{(Helper::placeValueFromArray($data,"conducting_a_clinical_trial") == "1" ? "checked" : "")}}>
                                                    <i class="form-icon"></i>Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="conducting_a_clinical_trial" value="2" {{(Helper::placeValueFromArray($data,"conducting_a_clinical_trial") == "2" ? "checked" : "")}}>
                                                    <i class="form-icon"></i>No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
									<div class="col-md-6 form-group">
										<label>Tile</label>
										<input type="text" name="tile" class="form-control" value="{{Helper::placeValueFromArray($data,'tile')}}">
									</div>
									<div class="col-md-6 form-group">
										<label>EMR Name</label>
										<input type="text" name="emr_name" class="form-control" value="{{Helper::placeValueFromArray($data,'emr_name')}}">
									</div>
								</div>

								@php
									$specialty = explode(',',Helper::placeValueFromArray($data,'specialty'));
									$sub_specialty = explode(',',Helper::placeValueFromArray($data,'sub_specialty'));
									for($i=0;$i < count($specialty); $i++){
								@endphp
										<div class="SpecialtyBlock SB_{{$i}} row">
		                                    <div class="col-md-6 form-group">
												<label>Specialty</label>
												<input type="text" name="specialty[]" class="form-control" placeholder="Allergy & Immunology" value="{{$specialty[$i]}}">
											</div>
											<div class="col-md-6 form-group">
												<label>Specialty / Sub Specialty</label>
												<div class="media align-items-center">
													<div class="media-body mr-3">
														<input type="text" name="sub_specialty[]" class="form-control" placeholder="Clinical Pathology" value="{{$sub_specialty[$i]}}">
													</div>
													@if($i)
														<a href="javascript:void(0)" onclick="removeBlock('specialty','{{$i}}',event)"><i class="material-icons-outlined mi-24 text-danger ml-2">remove_circle_outline</i></a>
													@else
														<a href="javascript:void(0)" onclick="addBlock('specialty')"><i class="material-icons-outlined mi-24">add_circle_outline</i></a>
													@endif
												</div>
											</div>
										</div>
								@php
									}
								@endphp

								@php
									$medicalLicense = explode(',',Helper::placeValueFromArray($data,'medicalLicense'));
									$medicalLicenseState = explode(',',Helper::placeValueFromArray($data,'medicalLicenseState'));
									for($i=0;$i < count($medicalLicense); $i++){
								@endphp

								<div class="medicalLicense ML_{{$i}} row">
									<div class="col-md-6 form-group">
										<label>Medical License Number</label>
										<input type="text" name="medicalLicense[]" class="form-control" placeholder="60 123456" value="{{$medicalLicense[$i]}}">
									</div>
									<div class="col-md-6 form-group">
										<label>Medical License State</label>
										<div class="media align-items-center">
											<div class="media-body mr-3">
												<input type="text" name="medicalLicenseState[]" class="form-control" placeholder="Alaska" value="{{$medicalLicenseState[$i]}}">
											</div>
											@if($i)
												<a href="javascript:void(0)" onclick="removeBlock('medicalLicense','{{$i}}',event)"><i class="material-icons-outlined mi-24 text-danger ml-2">remove_circle_outline</i></a>
											@else
												<a href="javascript:void(0)" onclick="addBlock('medicalLicense')"><i class="material-icons-outlined mi-24">add_circle_outline</i></a>
											@endif
										</div>
									</div>
								</div>

								@php
									}
								@endphp

                                <div class="row">
									<div class="col-md-6 form-group">
										<label>Indications treated</label>
										<input type="text" name="indications_treated" class="form-control mb-3" value="{{Helper::placeValueFromArray($data,'indications_treated')}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                    	<label>Number of patients seen per week?</label>
										<div class="custom-radio">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="number_of_patients_seen_per_week" value="1" {{(Helper::placeValueFromArray($data,"number_of_patients_seen_per_week") == "1" ? "checked" : "")}}>
                                                    <i class="form-icon"></i>0-10
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="number_of_patients_seen_per_week" checked="" value="2" {{(Helper::placeValueFromArray($data,"number_of_patients_seen_per_week") == "2" ? "checked" : "")}}>
                                                    <i class="form-icon"></i>10-20
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="number_of_patients_seen_per_week" value="3" {{(Helper::placeValueFromArray($data,"number_of_patients_seen_per_week") == "3" ? "checked" : "")}}>
                                                    <i class="form-icon"></i>20-50
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="number_of_patients_seen_per_week" value="4" {{(Helper::placeValueFromArray($data,"number_of_patients_seen_per_week") == "4" ? "checked" : "")}}>
                                                    <i class="form-icon"></i>>50 
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                	<div class="col-12 form-group">
										<p class="text-secondary fw-500">Percentage of racial diversity of patient population?</p>
									</div>
                                </div>

                                <div class="row">
                                	<div class="col-md-4 form-group">
										<label>Caucasian</label>
										<input type="text" name="caucasian" class="form-control" value="{{Helper::placeValueFromArray($data,'caucasian')}}">
									</div>
									<div class="col-md-4 form-group">
										<label>Black/African American</label>
										<input type="text" name="black_african_american" class="form-control"  value="{{Helper::placeValueFromArray($data,'black_african_american')}}">
									</div>
									<div class="col-md-4 form-group">
										<label>Native Hawaiian and other Pacific Islander</label>
										<input type="text" name="native_hawaiian_and_other_pacific_islander" class="form-control" value="{{Helper::placeValueFromArray($data,'native_hawaiian_and_other_pacific_islander')}}">
									</div>
                                </div>

                                <div class="row">
                                	<div class="col-md-4 form-group">
										<label>Asian</label>
										<input type="text" name="asian" class="form-control" value="{{Helper::placeValueFromArray($data,'asian')}}">
									</div>
									<div class="col-md-4 form-group">
										<label>Native American</label>
										<input type="text" name="native_american" class="form-control" value="{{Helper::placeValueFromArray($data,'native_american')}}">
									</div>
									<div class="col-md-4 form-group">
										<label>Alaska Native</label>
										<input type="text" name="alaska_native" class="form-control" value="{{Helper::placeValueFromArray($data,'alaska_native')}}">
									</div>
                                </div>

                                <div class="row">

                                </div>
                                <!-- <div class="row"> -->
                                <div class="row">
                                	<div class="col-md-6 form-group">
										<label>Do you have clinical research experience?</label>
										<div class="custom-radio">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="do_you_have_clinical_research_experience" value="1" {{(Helper::placeValueFromArray($data,"do_you_have_clinical_research_experience") == "1" ? "checked" : "")}}>
                                                    <i class="form-icon"></i>Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="do_you_have_clinical_research_experience" value="2" {{(Helper::placeValueFromArray($data,"do_you_have_clinical_research_experience") == "2" ? "checked" : "")}}>
                                                    <i class="form-icon"></i>No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
									<div class="col-md-6 form-group">
										<label>Are You Interested in Becoming a Sub-Investigator?</label>
										<div class="custom-radio">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="are_you_interested_in_becoming_a_sub_investigator" value="1" {{(Helper::placeValueFromArray($data,"are_you_interested_in_becoming_a_sub_investigator") == "1" ? "checked" : "")}}>
                                                    <i class="form-icon"></i>Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="are_you_interested_in_becoming_a_sub_investigator" value="2" {{(Helper::placeValueFromArray($data,"are_you_interested_in_becoming_a_sub_investigator") == "2" ? "checked" : "")}}>
                                                    <i class="form-icon"></i>No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row">
									<div class="col-12 form-group">
										<label>Upload Resume</label>
										<input type="file" name="resume_path" class="form-control">
										@if(Helper::placeValueFromArray($data,'resume_path'))
										<a href="{{asset(Helper::placeValueFromArray($data,'resume_path'))}}">Download</a>
										@endif
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6 form-group">
										<label>Clinic Name</label>
										<input type="text" name="clinic_name" class="form-control" value="{{Helper::placeValueFromArray($data,'clinic_name')}}">
									</div>
									<div class="col-md-6 form-group">
										<label>Clinic Address</label>
										<input type="text" name="clinic_address" class="form-control" value="{{Helper::placeValueFromArray($data,'clinic_address')}}">
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 form-group">
										<label>Clinic Telephone</label>
										<input type="text" name="clinic_telephone" class="form-control" value="{{Helper::placeValueFromArray($data,'clinic_telephone')}}">
									</div>
									<div class="col-md-6 form-group">
										<label>Clinic Fax</label>
										<input type="text" name="clinic_fax" class="form-control" value="{{Helper::placeValueFromArray($data,'clinic_fax')}}">
									</div>
								</div>


								<div class="row">
									<div class="col-md-6 form-group">
										<label>Name of Contact person at clinic</label>
										<input type="text" name="name_of_contact_person_at_clinic" class="form-control" value="{{Helper::placeValueFromArray($data,'name_of_contact_person_at_clinic')}}">
									</div>
									<div class="col-md-6 form-group">
										<label>Email of Contact person at clinic</label>
										<input type="text" name="email_of_contact_person_at_clinic" class="form-control" value="{{Helper::placeValueFromArray($data,'email_of_contact_person_at_clinic')}}">
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 form-group">
										<label>Telephone of Contact person at clinic</label>
										<input type="text" name="telephone_of_contact_person_at_clinic" class="form-control" value="{{Helper::placeValueFromArray($data,'telephone_of_contact_person_at_clinic')}}">
									</div>
									<div class="col-md-6 form-group">
										<label>Size of patient Database</label>
										<input type="text" name="size_of_patient_database" class="form-control" value="{{Helper::placeValueFromArray($data,'size_of_patient_database')}}">
									</div>
								</div>		

								<div class="row">
									<div class="col-12 form-group">
										<label>Type of Medical Record Storage?</label>
										<div class="custom-radio">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="type_of_medical_record_storage" value="1" {{(Helper::placeValueFromArray($data,"type_of_medical_record_storage") == "1" ? "checked" : "")}}>
                                                    <i class="form-icon"></i>Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="type_of_medical_record_storage" value="2" {{(Helper::placeValueFromArray($data,"type_of_medical_record_storage") == "2" ? "checked" : "")}}>
                                                    <i class="form-icon"></i>No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
								</div>		

								<div class="row">
									<div class="col-12 form-group">
										<label>Type of Medical Establishment?</label>
										<div class="custom-radio">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="type_of_medical_establishment" value="1" {{(Helper::placeValueFromArray($data,"type_of_medical_establishment") == "1" ? "checked" : "")}}>
                                                    <i class="form-icon"></i>Academic Institution
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="type_of_medical_establishment" value="2" {{(Helper::placeValueFromArray($data,"type_of_medical_establishment") == "2" ? "checked" : "")}}>
                                                    <i class="form-icon"></i>Sale Provider private clinic
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="type_of_medical_establishment" value="3"{{(Helper::placeValueFromArray($data,"type_of_medical_establishment") == "3" ? "checked" : "")}}>
                                                    <i class="form-icon"></i>Multiple provider private clinic
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="type_of_medical_establishment" value="4" {{(Helper::placeValueFromArray($data,"type_of_medical_establishment") == "4" ? "checked" : "")}}>
                                                    <i class="form-icon"></i>Others
                                                </label>
                                            </div>
                                        </div>
                                    </div>
								</div>	

								<div class="row">
									<div class="col-12 form-group text-center mt-5">
										<button type="submit" class="btn btn-orange btn-wide">Update</button>
										<a href="{{route('Dashboard.professionalInfo')}}" class="btn btn-secondary btn-wide">Cancel</a>
									</div>
								</div>
							</form>


							@elseif(Auth::user()->role == 5)
							<form class="form" action="{{route('Dashboard.professionalInfo.update')}}" method="post">
								@csrf
								<div class="row">
									<div class="col-12 form-group">
										<label>Job Title</label>
										<input type="text" name="job_title" class="form-control" placeholder="Executive" value="{{Helper::placeValueFromArray($data,'job_title')}}">
									</div>
								</div>

								<!-- <div class="SpecialtyBlock row">
                                    <div class="col-md-6 form-group">
										<label>Specialty</label>
										<input type="text" name="specialty[]" class="form-control" placeholder="Allergy & Immunology" value="">
									</div>
									<div class="col-md-6 form-group">
										<label>Specialty / Sub Specialty</label>
										<div class="media align-items-center">
											<div class="media-body mr-3">
												<input type="text" name="sub_specialty[]" class="form-control" placeholder="Clinical Pathology">
											</div>
											<a href="javascript:void(0)" onclick="addBlock('specialty')"><i class="material-icons-outlined mi-24">add_circle_outline</i></a>
											<a href="javascript:void(0)" style="display:none;"><i class="material-icons-outlined mi-24 text-danger ml-2">remove_circle_outline</i></a>
										</div>
									</div>
								</div>

								<div class="medicalLicense row">
									<div class="col-md-6 form-group">
										<label>Medical License Number</label>
										<input type="text" name="medicalLicense[]" class="form-control" placeholder="60 123456">
									</div>
									<div class="col-md-6 form-group">
										<label>Medical License State</label>
										<div class="media align-items-center">
											<div class="media-body mr-3">
												<input type="text" name="medicalLicenseState[]" class="form-control" placeholder="Alaska">
											</div>
											<a href="javascript:void(0)" onclick="addBlock('medicalLicense')"><i class="material-icons-outlined mi-24">add_circle_outline</i></a>
											<a href="javascript:void(0)" style="display:none;"><i class="material-icons-outlined mi-24 text-danger ml-2">remove_circle_outline</i></a>
										</div>
									</div>
								</div> -->

								@php
									$specialty = explode(',',Helper::placeValueFromArray($data,'specialty'));
									$sub_specialty = explode(',',Helper::placeValueFromArray($data,'sub_specialty'));
									for($i=0;$i < count($specialty); $i++){
								@endphp
										<div class="SpecialtyBlock SB_{{$i}} row">
		                                    <div class="col-md-6 form-group">
												<label>Specialty</label>
												<input type="text" name="specialty[]" class="form-control" placeholder="Allergy & Immunology" value="{{$specialty[$i]}}">
											</div>
											<div class="col-md-6 form-group">
												<label>Specialty / Sub Specialty</label>
												<div class="media align-items-center">
													<div class="media-body mr-3">
														<input type="text" name="sub_specialty[]" class="form-control" placeholder="Clinical Pathology" value="{{$sub_specialty[$i]}}">
													</div>
													@if($i)
														<a href="javascript:void(0)" onclick="removeBlock('specialty','{{$i}}',event)"><i class="material-icons-outlined mi-24 text-danger ml-2">remove_circle_outline</i></a>
													@else
														<a href="javascript:void(0)" onclick="addBlock('specialty')"><i class="material-icons-outlined mi-24">add_circle_outline</i></a>
													@endif
												</div>
											</div>
										</div>
								@php
									}
								@endphp

								@php
									$medicalLicense = explode(',',Helper::placeValueFromArray($data,'medicalLicense'));
									$medicalLicenseState = explode(',',Helper::placeValueFromArray($data,'medicalLicenseState'));
									for($i=0;$i < count($medicalLicense); $i++){
								@endphp

								<div class="medicalLicense ML_{{$i}} row">
									<div class="col-md-6 form-group">
										<label>Medical License Number</label>
										<input type="text" name="medicalLicense[]" class="form-control" placeholder="60 123456" value="{{$medicalLicense[$i]}}">
									</div>
									<div class="col-md-6 form-group">
										<label>Medical License State</label>
										<div class="media align-items-center">
											<div class="media-body mr-3">
												<input type="text" name="medicalLicenseState[]" class="form-control" placeholder="Alaska" value="{{$medicalLicenseState[$i]}}">
											</div>
											@if($i)
												<a href="javascript:void(0)" onclick="removeBlock('medicalLicense','{{$i}}',event)"><i class="material-icons-outlined mi-24 text-danger ml-2">remove_circle_outline</i></a>
											@else
												<a href="javascript:void(0)" onclick="addBlock('medicalLicense')"><i class="material-icons-outlined mi-24">add_circle_outline</i></a>
											@endif
										</div>
									</div>
								</div>

								@php
									}
								@endphp

								<div class="row">
									<div class="col-md-6 form-group">
										<label>Therapeutic areas of clinical research experience</label>
										<input type="text" name="therapeutic_area_of_clinical_research_exp" class="form-control" placeholder="2 Years" value="{{Helper::placeValueFromArray($data,'therapeutic_area_of_clinical_research_exp')}}">
									</div>
									<div class="col-md-6 form-group">
										<label>Years of clinical research experience</label>
										<input type="text" name="yrs_of_clinical_research_exp" class="form-control" placeholder="10 Years" value="{{Helper::placeValueFromArray($data,'yrs_of_clinical_research_exp')}}">
									</div>
								</div>

								<div class="row">
									<div class="col-12 form-group">
										<label>Will you be accepting sub-investigators?</label>
										<div class="custom-radio">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="will_you_be_accept_sub_invstigators" {{(Helper::placeValueFromArray($data,"will_you_be_accept_sub_invstigators") == "1" ? "checked" : "")}} value="1">
                                                    <i class="form-icon"></i>Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="will_you_be_accept_sub_invstigators" {{(Helper::placeValueFromArray($data,"will_you_be_accept_sub_invstigators") == "2" ? "checked" : "")}} value="2">
                                                    <i class="form-icon"></i>No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<label>Site Name</label>
										<input type="text" name="research_site_name" class="form-control" placeholder="Center for Drug Evaluation and Research" value="{{Helper::placeValueFromArray($data,'research_site_name')}}">
									</div>
									<div class="col-md-6 form-group">
										<label>Site Address</label>
										<input type="text" name="research_site_address" class="form-control" placeholder="123 xyz Lorem ipsum road lane -49" value="{{Helper::placeValueFromArray($data,'research_site_address')}}">
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<label>Site Telephone</label>
										<input type="text" name="research_site_telephone" class="form-control" placeholder="+123 4567890" value="{{Helper::placeValueFromArray($data,'research_site_telephone')}}">
									</div>
									<div class="col-md-6 form-group">
										<label>Site Fax</label>
										<input type="text" name="research_site_fax" class="form-control" placeholder="+1 323 555 1234" value="{{Helper::placeValueFromArray($data,'research_site_fax')}}">
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 form-group">
										<label>Name of Contact Person at site</label>
										<input type="text" name="name_of_contact_person_at_research_site" class="form-control" placeholder="John Wik" value="{{Helper::placeValueFromArray($data,'name_of_contact_person_at_research_site')}}">
									</div>
									<div class="col-md-6 form-group">
										<label>Email of Contact person at site</label>
										<input type="text" name="email_of_contact_person_at_research_site" class="form-control" placeholder="johnwick123@gmail.com" value="{{Helper::placeValueFromArray($data,'email_of_contact_person_at_research_site')}}">
									</div>
								</div>
								<div class="row">
									
									<div class="col-md-6 form-group">
										<label>Telephone of Contact person at research site</label>
										<input type="text" name="telephone_of_contact_person_at_research_site" class="form-control" placeholder="+123 4567890" value="{{Helper::placeValueFromArray($data,'telephone_of_contact_person_at_research_site')}}">
									</div>
									<div class="col-12 text-center mt-4">
										<button type="submit" class="btn btn-orange btn-wide">Update</button>
										<a href="{{route('Dashboard.professionalInfo')}}" class="btn btn-secondary btn-wide">Cancel</a>
									</div>
								</div>
								</div>
							</form>
							@elseif(Auth::user()->role == 2)
							<form class="form" action="{{route('Dashboard.professionalInfo.update')}}" method="post">
								@csrf
								<div class="tab-pane container" id="patient_info">
									<div class="p-lg-3">
										<form class="form">
											<div class="row">
												<div class="col-md-6 form-group">
													<label>First Name</label>
													<input type="text" name="first_name" value="{{Helper::placeValueFromArray($data,'first_name')}}" class="form-control">
												</div>
												<div class="col-md-6 form-group">
													<label>Last Name</label>
													<input type="text" name="last_name" value="{{Helper::placeValueFromArray($data,'last_name')}}" class="form-control">
												</div>
												<div class="col-md-6 form-group">
													<label>Physician Name</label>
													<input type="text" name="physician_name" value="{{Helper::placeValueFromArray($data,'physician_name')}}" class="form-control">
												</div>
												<div class="col-md-6 form-group">
													<label>Physician Email</label>
													<input type="email" name="physician_email" value="{{Helper::placeValueFromArray($data,'physician_email')}}" class="form-control">
												</div>
												<div class="col-md-6 form-group">
													<label>Physician Phone</label>
													<input type="text" name="physician_phone" value="{{Helper::placeValueFromArray($data,'physician_phone')}}" class="form-control">
												</div>
												<div class="col-md-6 form-group">
													<label>Caregiver Name</label>
													<input type="text" name="caregiver_name" value="{{Helper::placeValueFromArray($data,'caregiver_name')}}" class="form-control">
												</div>
												<div class="col-md-6 form-group">
													<label>Caregiver Email</label>
													<input type="email" name="caregiver_email" value="{{Helper::placeValueFromArray($data,'caregiver_email')}}" class="form-control">
												</div>
												<div class="col-md-6 form-group">
													<label>Caregiver Phone</label>
													<input type="text" name="caregiver_phone" value="{{Helper::placeValueFromArray($data,'caregiver_phone')}}" class="form-control">
												</div>
												<div class="col-md-6 form-group">
													<label>Date of birth</label>
													<input type="date" name="dob" value="{{Helper::placeValueFromArray($data,'dob')}}" class="form-control">
												</div>
												<div class="col-md-6 form-group">
													<label>&nbsp;</label>
													<div class="custom-radio row no-gutters">
			                                            <div class="radio col-md-6">
			                                                <label>
			                                                    <input type="radio" class="form-check-input" name="clinical_trial_type" value="1" {{(Helper::placeValueFromArray($data,'clinical_trial_type') == 1 ? 'checked' : '')}}>
			                                                    <i class="form-icon"></i>I am volunteering for a clinical study
			                                                </label>
			                                            </div>
			                                            <div class="radio col-md-6">
			                                                <label>
			                                                    <input type="radio" class="form-check-input" name="clinical_trial" value="2" name="clinical_trial_type" {{(Helper::placeValueFromArray($data,'clinical_trial_type') == 2 ? 'checked' : '')}}>
			                                                    <i class="form-icon"></i>I have a medical condition
			                                                </label>
			                                            </div>
			                                        </div>
			                                    </div>
												<div class="col-md-6 form-group">
													<label>Gender</label>
													<div class="custom-radio">
			                                            <div class="radio">
			                                                <label>
			                                                    <input type="radio" class="form-check-input" name="gender" value="1" {{(Helper::placeValueFromArray($data,'gender') == 1 ? 'checked' : '')}}>
			                                                    <i class="form-icon"></i>Male
			                                                </label>
			                                            </div>
			                                            <div class="radio">
			                                                <label>
			                                                    <input type="radio" class="form-check-input" name="gender" value="2" {{(Helper::placeValueFromArray($data,'gender') == 2 ? 'checked' : '')}}>
			                                                    <i class="form-icon"></i>Female
			                                                </label>
			                                            </div>
			                                        </div>
												</div>
												<div class="col-md-6 form-group">
													<label>Ethnicity</label>
													<input type="text" name="ethnicity" value="{{Helper::placeValueFromArray($data,'ethnicity')}}" class="form-control">
												</div>
												<div class="col-md-6 form-group">
													<label>Race</label>
													<input type="text" name="race" value="{{Helper::placeValueFromArray($data,'race')}}" class="form-control">
												</div>
												<div class="col-md-6 form-group">
													<label>Preferred Language of comunication</label>
													<select class="form-control custom-select" name="preferred_lang_communication">
														<option value="English" {{(Helper::placeValueFromArray($data,'preferred_lang_communication') == "English" ? 'selected' : '')}}>English</option>
														<option value="French" {{(Helper::placeValueFromArray($data,'preferred_lang_communication') == "French" ? 'selected' : '')}}>French</option>
														<option value="Spanish" {{(Helper::placeValueFromArray($data,'preferred_lang_communication') == "Spanish" ? 'selected' : '')}}>Spanish</option>
													</select>
												</div>
												<!-- <div class="col-12 d-flex justify-content-center">
													<div class="media align-items-center">
			                                        	<i class="material-icons-outlined border rounded-circle p-1" style="font-size: 24px">lock</i>
			                                        	<div class="media-body fw-500 ml-2">
			                                        		All of your information is secure.
			                                        	</div>
			                                        </div>
			                                    </div> -->
											</div>
											<div class="row">
												<div class="col-12 form-group text-center mt-5">
													<button type="submit" class="btn btn-orange btn-wide">Update</button>
													<a href="{{route('Dashboard.professionalInfo')}}" class="btn btn-secondary btn-wide">Cancel</a>
												</div>
											</div>
										</form>
									</div>
								</div>
							</form>
							@endif

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
function addBlock(type){
	if(type == "specialty"){
		var blockSL = $('.SpecialtyBlock').length;
		var html = "";
		html += '<div class="SpecialtyBlock SB_'+blockSL+' row">';
	    html += '<div class="col-md-6 form-group">';
		html += '<label>Specialty '+blockSL+'</label>';
		html += '<input type="text" name="specialty[]" class="form-control" placeholder="Allergy & Immunology" value="">';
		html += '</div>';
		html += '<div class="col-md-6 form-group">';
		html += '<label>Specialty / Sub Specialty '+blockSL+'</label>';
		html += '<div class="media align-items-center">';
		html += '<div class="media-body mr-3">';
		html +=	'<input type="text" name="sub_specialty[]" class="form-control" placeholder="Clinical Pathology">';
		html += '</div>';
		// html += '<a href="javascript:void(0)" onclick="addBlock(\'specialty\')"><i class="material-icons-outlined mi-24">add_circle_outline</i></a>';
		html += '<a href="javascript:void(0)" onclick="removeBlock(\'specialty\','+blockSL+',event)"><i class="material-icons-outlined mi-24 text-danger ml-2">remove_circle_outline</i></a>';
		html += '</div>';
		html += '</div>';
		html += '</div>';
		$('.SpecialtyBlock:last').after(html);
	}else{
		var blockSL = $('.medicalLicense').length;
		var html = '<div class="medicalLicense ML_'+blockSL+' row">';
		html += '<div class="col-md-6 form-group">';
		html += '<label>Medical License Number '+blockSL+'</label>';
		html += '<input type="text" name="medicalLicense[]" class="form-control" placeholder="60 123456">';
		html += '</div>';
		html += '<div class="col-md-6 form-group">';
		html += '<label>Medical License State '+blockSL+'</label>';
		html += '<div class="media align-items-center">';
		html += '<div class="media-body mr-3">';
		html += '<input type="text" name="medicalLicenseState[]" class="form-control" placeholder="Alaska">';
		html += '</div>';
		// html += '<a href="javascript:void(0)" onclick="addBlock('medicalLicense')"><i class="material-icons-outlined mi-24">add_circle_outline</i></a>';
		html += '<a href="javascript:void(0)" onclick="removeBlock(\'medicalLicense\','+blockSL+',event)"><i class="material-icons-outlined mi-24 text-danger ml-2">remove_circle_outline</i></a>';
		html += '</div>';
		html += '</div>';
	    html += '</div>';
	    $('.medicalLicense:last').after(html);
	}
}

function removeBlock(type,blockSL){
	console.log('Yes Its There');
	if(type == "specialty"){
		$('.SpecialtyBlock.SB_'+blockSL+'').remove();
	}else{
		$('.medicalLicense.ML_'+blockSL+'').remove();
	}
}
</script>
@endsection