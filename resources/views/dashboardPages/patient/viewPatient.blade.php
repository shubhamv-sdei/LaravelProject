@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>Patients</span>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="media align-items-center">
							<div class="media-thumb xl rounded-circle border mr-3">
								@if($patient->image != "")
								<img src="{{Auth::user()->image}}">
								@else
								<img src="{{url('assets/avatar.jpg')}}">
								@endif
							</div>
							<div class="media-body">
								<p class="mb-0 fw-500 lead">{{ucfirst($patient->firstname)}} {{ucfirst($patient->lastname)}}</p>
								<div>{{date_format(date_create($patient->dob),"d M, Y")}} ({{date("Y") - date_format(date_create($patient->dob),"Y") }} Yr)</div>
								<div>{{((isset($patient->sex) && $patient->sex == '1') ? 'Male' : 'Female')}}, {{$patient->contact}}</div>
							</div>

							@if(Session::has('msg'))
							    <div class="alert alert-warning alert-dismissible fade show" role="alert">
							      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							        <span aria-hidden="true">&times;</span>
							      </button>
							      {{ Session::get('msg') }}
							    </div>
							@endif
						</div>
					</div>
				</div>
				<div class="card">
								<div class="card-body px-0">
									<ul class="product-tab-list nav tab-border tab-icon">
<!-- 										<li class="nav-item">
											<a class="nav-link {{(Session::get('msg') == 'problem1' ? 'active' : '')}}" data-toggle="tab" href="#history">
												<img src="{{url('assets/images/profile/history.svg')}}">
												<span>History</span>
											</a>
										</li> -->
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#problems">
												<img src="{{url('assets/images/profile/problem.svg')}}">
												<spna>Problems</spna>
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#medications">
												<img src="{{url('assets/images/profile/medication.svg')}}">
												<span>Medications</span>
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#allergies">
												<img src="{{url('assets/images/profile/allergy.svg')}}">
												<span>Allergies</span>
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#vitals">
												<img src="{{url('assets/images/profile/vital.svg')}}">
												<span>Vitals</span>
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#notes">
												<img src="{{url('assets/images/profile/notes.svg')}}">
												<span>Notes</span>
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#labStudies">
												<img src="{{url('assets/images/profile/lab.svg')}}">
												<span>Lab/Studies</span>
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#uploadFile">
												<img src="{{url('assets/images/profile/upload.svg')}}">
												<span>Upload File</span>
											</a>
										</li>
										@if($is_add)
										<li class="nav-item">
											<a class="nav-link {{(Session::get('msg') == 'ccdafile' ? 'active' : '')}}" data-toggle="tab" href="#CCDAuploadFile">
												<img src="{{url('assets/images/profile/upload.svg')}}">
												<span>Import From CCDA</span>
											</a>
										</li>
										@endif
									</ul>
									<div class="tab-content">
										<div class="tab-pane" id="history">
											<div class="table-responsive">
												<table class="table table-wide">
													<thead class="thead-light">
														<tr>
															<th>Detail</th>
															<th style="width: 150px;">Last Update</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																<h5 class="text-secondary mb-0">Past Medical History (PMHx)</h5>
																<div class="media mb-2">
																	<span class="mr-2">Comments :</span>
																	<div class="media-body">Negative</div>
																</div>
															</td>
															<td>
																20 Jun 2020 <br> 12:05 AM
															</td>
														</tr>
														<tr>
															<td>
																<h5 class="text-secondary mb-0">Past Surgical History</h5>
																<div class="media mb-2">
																	<span class="mr-2">Cesarean section :</span>
																	<div class="media-body">at age 38 - 2013. According to reports from Al-Ain hospital, Uterine torsion and IUFD</div>
																</div>
																<div class="media">
																	<span class="mr-2">Comments :</span>
																	<div class="media-body">August, 2013: During pregnancy, around 32 weeks of gestation. The patient describes abnormal numbness of the left side of the body. The patient describes abnormal movement of the baby and shortness of breath. Then loss of fetal movement. Called Emergency and she was admitted to the hospital in labor. The mother was in shock upon arrival and diagnosed to have IUFD.</div>
																</div>
															</td>
															<td>
																20 Jun 2020 <br> 12:05 AM
															</td>
														</tr>
														<tr>
															<td>
																<h5 class="text-secondary mb-0">Family History (FHx)</h5>
																<div class="media mb-2">
																	<div class="media-body">No Family history has been documented for this patient</div>
																</div>
															</td>
															<td></td>
														</tr>
														<tr>
															<td>
																<h5 class="text-secondary mb-0">Social History (SHx)</h5>
																<div class="media mb-2">
																	<div class="media-body">No social history has been documented for this patient</div>
																</div>
															</td>
															<td></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane active" id="problems">
											<div class="p-3 bg-gray">
												<div class="media align-items-center justify-content-end">
													<div class="media-body mr-2">
														<ul class="nav nav-pills">
															<li class="nav-item">
																<a class="nav-link active" data-toggle="pill" href="#problem_active">Active</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="pill" href="#problem_nonActive">Non Active</a>
															</li>
														</ul>
													</div>
													@if($is_add)
													<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#newProblem">Add New</button>
													@endif
												</div>
											</div>
											<div class="p-3 border-bottom">
												<div class="row align-items-center">
													<div class="col-md-6 col-xl-8">
														<h4 class="mb-md-0">Problems</h4>
													</div>
													<div class="col-md-6 col-xl-4">
														<div class="input-group input-group-inner">
				                                        	<input type="text" class="form-control" name="" placeholder="Search">
					                                        <div class="input-group-append">
					                                            <button type="button" class="input-group-text">
					                                                <i class="material-icons-outlined">search</i>
					                                            </button>
					                                        </div>
					                                    </div>
													</div>
												</div>
											</div>
											<div class="tab-content">
												<div class="tab-pane active" id="problem_active">
													<div class="table-responsive">
								                        <table class="table table-wide">
								                            <thead class="text-secondary">
								                                <tr>
								                                    <th>Problem/Issues</th>
								                                    <th>Diagnosis Description</th>
								                                    <th>Type</th>
								                                    <th>Start Date</th>
								                                    <th>Last Modified</th>
								                                    <th style="width: 100px;">Actions</th>
								                                </tr>
								                            </thead>
								                            <tbody class="align-middle">
								                            	@foreach($problems as $key=>$value)
								                            	@if($value->status == '1')
								                            	<tr>
								                            		<td>{{Helper::c_decode($value->problem)}}</td>
								                                    <td>{{Helper::c_decode($value->diagnosis)}}</td>
								                                    <td>{{$value->type}}</td>
								                                    <td>{{date_format(date_create($value->created_at),"d M, Y H:i A")}}</td>
								                                    <td>{{date_format(date_create($value->updated_at),"d M, Y H:i A")}}</td>
								                                    <td class="action">
								                                    	<!-- <button class="btn" data-toggle="tooltip" title="Edit"><i class="material-icons-outlined text-secondary">edit</i></button> -->
								                                    	<button class="btn" data-toggle="tooltip" title="Delete" onclick="deleteProblem({{$value->id}})"><i class="material-icons-outlined text-danger">delete</i></button>
								                                    </td>
								                            	</tr>
								                            	@endif
								                            	@endforeach
								                            </tbody>
								                        </table>
								                    </div>
												</div>
												<div class="tab-pane fade" id="problem_nonActive">
													<div class="table-responsive">
								                        <table class="table table-wide">
								                            <thead class="text-secondary">
								                                <tr>
								                                    <th>Problem/Issues</th>
								                                    <th>Diagnosis Description</th>
								                                    <th>Type</th>
								                                    <th>Start Date</th>
								                                    <th>Last Modified</th>
								                                    <th style="width: 100px;">Actions</th>
								                                </tr>
								                            </thead>
								                            <tbody class="align-middle">
								                                @foreach($problems as $key=>$value)
								                                @if($value->status == '2')
								                            	<tr>
								                            		<td>{{Helper::c_decode($value->problem)}}</td>
								                                    <td>{{Helper::c_decode($value->diagnosis)}}</td>
								                                    <td>{{$value->type}}</td>
								                                    <td>{{date_format(date_create($value->created_at),"d M, Y H:i A")}}</td>
								                                    <td>{{date_format(date_create($value->updated_at),"d M, Y H:i A")}}</td>
								                                    <td class="action">
								                                    	<!-- <button class="btn" data-toggle="tooltip" title="Edit"><i class="material-icons-outlined text-secondary">edit</i></button> -->
								                                    	<button class="btn" data-toggle="tooltip" title="Delete" onclick="deleteProblem({{$value->id}})"><i class="material-icons-outlined text-danger">delete</i></button>
								                                    </td>
								                            	</tr>
								                            	@endif
								                            	@endforeach
								                            </tbody>
								                        </table>
								                    </div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="medications">
											<div class="p-3 bg-gray">
												<div class="media align-items-center justify-content-end">
													<div class="media-body mr-2">
														<ul class="nav nav-pills">
															<li class="nav-item">
																<a class="nav-link active" data-toggle="pill" href="#medication_active">Active</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="pill" href="#medication_discontinued">Discontinued</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="pill" href="#medication_notAdministered">Not Administered</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="pill" href="#medication_internalPrescription">Internal Prescription</a>
															</li>
														</ul>
													</div>
													@if($is_add)
													<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#newMedication">Add New</button>
													@endif
												</div>
											</div>
											<div class="p-3 border-bottom">
												<div class="row align-items-center">
													<div class="col-md-6 col-xl-8">
														<h4 class="mb-md-0">Medications</h4>
													</div>
													<div class="col-md-6 col-xl-4">
														<div class="input-group input-group-inner">
				                                        	<input type="text" class="form-control" name="" placeholder="Search">
					                                        <div class="input-group-append">
					                                            <button type="button" class="input-group-text">
					                                                <i class="material-icons-outlined">search</i>
					                                            </button>
					                                        </div>
					                                    </div>
													</div>
												</div>
											</div>
											<div class="tab-content">
												<div class="tab-pane active" id="medication_active">
													<div class="table-responsive">
								                        <table class="table table-wide">
								                            <thead class="text-secondary">
								                                <tr>
								                                    <th>Medicine</th>
								                                    <th>Pt. Instructions</th>
								                                    <th>Date Started</th>
								                                    <th style="width: 100px;">Actions</th>
								                                </tr>
								                            </thead>
								                            <tbody class="align-middle">
							                                    @foreach($medications as $key=>$value)
							                                    @if($value->status == 1)
							                                    <tr>
							                                    <td>{{Helper::c_decode($value->medicine)}}</td>
							                                    <td>{{Helper::c_decode($value->pt_instructions)}}</td>
							                                    <td>
							                                    	{{date_format(date_create($value->created_at),"d M, Y H:i A")}}
							                                    </td>
							                                    <td class="action">
							                                    	<!-- <button class="btn" data-toggle="tooltip" title="Edit"><i class="material-icons-outlined text-secondary">edit</i></button> -->
							                                    	<button class="btn" data-toggle="tooltip" title="Delete" onclick="deleteMedications({{$value->id}})"><i class="material-icons-outlined text-danger">delete</i></button>
							                                    </td>
							                                    </tr>
							                                    @endif
							                                    @endforeach
								                            </tbody>
								                        </table>
								                    </div>
												</div>
												<div class="tab-pane fade" id="medication_discontinued">
													<div class="table-responsive">
								                        <table class="table table-wide">
								                            <thead class="text-secondary">
								                                <tr>
								                                    <th>Medicine</th>
								                                    <th>Pt. Instructions</th>
								                                    <th>Date Started</th>
								                                    <th style="width: 100px;">Actions</th>
								                                </tr>
								                            </thead>
								                            <tbody class="align-middle">
								                               @foreach($medications as $key=>$value)
							                                    @if($value->status == 2)
							                                    <tr>
							                                    <td>{{Helper::c_decode($value->medicine)}}</td>
							                                    <td>{{Helper::c_decode($value->pt_instructions)}}</td>
							                                    <td>
							                                    	{{date_format(date_create($value->created_at),"d M, Y H:i A")}}
							                                    </td>
							                                    <td class="action">
							                                    	<!-- <button class="btn" data-toggle="tooltip" title="Edit"><i class="material-icons-outlined text-secondary">edit</i></button> -->
							                                    	<button class="btn" data-toggle="tooltip" title="Delete" onclick="deleteMedications({{$value->id}})"><i class="material-icons-outlined text-danger">delete</i></button>
							                                    </td>
							                                    </tr>
							                                    @endif
							                                    @endforeach
								                            </tbody>
								                        </table>
								                    </div>
												</div>
												<div class="tab-pane fade" id="medication_notAdministered">
													<div class="table-responsive">
								                        <table class="table table-wide">
								                            <thead class="text-secondary">
								                                <tr>
								                                    <th>Medicine</th>
								                                    <th>Pt. Instructions</th>
								                                    <th>Date Started</th>
								                                    <th style="width: 100px;">Actions</th>
								                                </tr>
								                            </thead>
								                            <tbody class="align-middle">
								                               @foreach($medications as $key=>$value)
							                                    @if($value->status == 3)
							                                    <tr>
							                                    <td>{{Helper::c_decode($value->medicine)}}</td>
							                                    <td>{{Helper::c_decode($value->pt_instructions)}}</td>
							                                    <td>
							                                    	{{date_format(date_create($value->created_at),"d M, Y H:i A")}}
							                                    </td>
							                                    <td class="action">
							                                    	<!-- <button class="btn" data-toggle="tooltip" title="Edit"><i class="material-icons-outlined text-secondary">edit</i></button> -->
							                                    	<button class="btn" data-toggle="tooltip" title="Delete" onclick="deleteMedications({{$value->id}})"><i class="material-icons-outlined text-danger">delete</i></button>
							                                    </td>
							                                    </tr>
							                                    @endif
							                                    @endforeach
								                            </tbody>
								                        </table>
								                    </div>
												</div>
												<div class="tab-pane fade" id="medication_internalPrescription">
													<div class="table-responsive">
								                        <table class="table table-wide">
								                            <thead class="text-secondary">
								                                <tr>
								                                    <th>Medicine</th>
								                                    <th>Pt. Instructions</th>
								                                    <th>Date Started</th>
								                                    <th style="width: 100px;">Actions</th>
								                                </tr>
								                            </thead>
								                            <tbody class="align-middle">
								                                @foreach($medications as $key=>$value)
							                                    @if($value->status == 4)
							                                    <tr>
							                                    <td>{{Helper::c_decode($value->medicine)}}</td>
							                                    <td>{{Helper::c_decode($value->pt_instructions)}}</td>
							                                    <td>
							                                    	{{date_format(date_create($value->created_at),"d M, Y H:i A")}}
							                                    </td>
							                                    <td class="action">
							                                    	<!-- <button class="btn" data-toggle="tooltip" title="Edit"><i class="material-icons-outlined text-secondary">edit</i></button> -->
							                                    	<button class="btn" data-toggle="tooltip" title="Delete" onclick="deleteMedications({{$value->id}})"><i class="material-icons-outlined text-danger">delete</i></button>
							                                    </td>
							                                    </tr>
							                                    @endif
							                                    @endforeach
								                            </tbody>
								                        </table>
								                    </div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="allergies">
											<div class="p-3 bg-gray">
												<div class="media align-items-center justify-content-end">
													<div class="media-body mr-2">
														<ul class="nav nav-pills">
															<li class="nav-item">
																<a class="nav-link active" data-toggle="pill" href="#allergy_active">Active</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="pill" href="#allergy_nonActive">Non Active</a>
															</li>
														</ul>
													</div>
													@if($is_add)
													<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#newAllergy">Add New</button>
													@endif
												</div>
											</div>
											<div class="p-3 border-bottom">
												<div class="row align-items-center">
													<div class="col-md-6 col-xl-8">
														<h4 class="mb-md-0">Allergies</h4>
													</div>
													<div class="col-md-6 col-xl-4">
														<div class="input-group input-group-inner">
				                                        	<input type="text" class="form-control" name="" placeholder="Search">
					                                        <div class="input-group-append">
					                                            <button type="button" class="input-group-text">
					                                                <i class="material-icons-outlined">search</i>
					                                            </button>
					                                        </div>
					                                    </div>
													</div>
												</div>
											</div>
											<div class="tab-content">
												<div class="tab-pane active" id="allergy_active">
													<div class="table-responsive">
								                        <table class="table table-wide">
								                            <thead class="text-secondary">
								                                <tr>
								                                    <th>Allergent</th>
								                                    <th>Severity</th>
								                                    <th>Reaction</th>
								                                    <th>Date onset</th>
								                                    <th>Updated</th>
								                                    <th style="width: 100px;">Actions</th>
								                                </tr>
								                            </thead>
								                            <tbody class="align-middle">
								                                @foreach($allergies as $key=>$value)
							                                    @if($value->status == 1)
							                                    <tr>
							                                    <td>{{Helper::c_decode($value->allergent)}}</td>
							                                    <td>{{Helper::c_decode($value->severity)}}</td>
							                                    <td>{{Helper::c_decode($value->Reaction)}}</td>
							                                    <td>
							                                    	{{date_format(date_create($value->created_at),"d M, Y H:i A")}}
							                                    </td>
							                                    <td>
							                                    	{{date_format(date_create($value->updated_at),"d M, Y H:i A")}}
							                                    </td>
							                                    <td class="action">
							                                    	<!-- <button class="btn" data-toggle="tooltip" title="Edit"><i class="material-icons-outlined text-secondary">edit</i></button> -->
							                                    	<button class="btn" data-toggle="tooltip" title="Delete" onclick="deleteAllergies({{$value->id}})"><i class="material-icons-outlined text-danger">delete</i></button>
							                                    </td>
							                                    </tr>
							                                    @endif
							                                    @endforeach
								                            </tbody>
								                        </table>
								                    </div>
												</div>
												<div class="tab-pane fade" id="allergy_nonActive">
													<div class="table-responsive">
								                        <table class="table table-wide">
								                            <thead class="text-secondary">
								                                <tr>
								                                    <th>Allergent</th>
								                                    <th>Severity</th>
								                                    <th>Reaction</th>
								                                    <th>Date onset</th>
								                                    <th>Updated</th>
								                                    <th style="width: 100px;">Actions</th>
								                                </tr>
								                            </thead>
								                            <tbody class="align-middle">
								                                @foreach($allergies as $key=>$value)
							                                    @if($value->status == 2)
							                                    <tr>
							                                    <td>{{Helper::c_decode($value->allergent)}}</td>
							                                    <td>{{Helper::c_decode($value->severity)}}</td>
							                                    <td>{{Helper::c_decode($value->Reaction)}}</td>
							                                    <td>
							                                    	{{date_format(date_create($value->created_at),"d M, Y H:i A")}}
							                                    </td>
							                                    <td>
							                                    	{{date_format(date_create($value->updated_at),"d M, Y H:i A")}}
							                                    </td>
							                                    <td class="action">
							                                    	<!-- <button class="btn" data-toggle="tooltip" title="Edit"><i class="material-icons-outlined text-secondary">edit</i></button> -->
							                                    	<button class="btn" data-toggle="tooltip" title="Delete" onclick="deleteAllergies({{$value->id}})"><i class="material-icons-outlined text-danger">delete</i></button>
							                                    </td>
							                                    </tr>
							                                    @endif
							                                    @endforeach
								                            </tbody>
								                        </table>
								                    </div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="vitals">
											<div class="p-3 bg-gray">
												<div class="media align-items-center justify-content-end">
													@if($is_add)
													<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#newVital">Add New</button>
													@endif
												</div>
											</div>
											<div class="p-3 border-bottom">
												<div class="row align-items-center">
													<div class="col-md-6 col-xl-8">
														<h4 class="mb-md-0">Vitals</h4>
													</div>
													<div class="col-md-6 col-xl-4">
														<div class="input-group input-group-inner">
				                                        	<input type="text" class="form-control" name="" placeholder="Search">
					                                        <div class="input-group-append">
					                                            <button type="button" class="input-group-text">
					                                                <i class="material-icons-outlined">search</i>
					                                            </button>
					                                        </div>
					                                    </div>
													</div>
												</div>
											</div>
											<div class="table-responsive">
						                        <table class="table table-wide">
						                            <thead class="text-secondary">
						                                <tr>
						                                    <th>BP</th>
						                                    <th>HR</th>
						                                    <th>RR</th>
						                                    <th>Temp.</th>
						                                    <th>Pain</th>
						                                    <th>Height</th>
						                                    <th>Weight</th>
						                                    <th>BMI</th>
						                                    <th>SPO2</th>
						                                    <th style="width: 100px;">Actions</th>
						                                </tr>
						                            </thead>
						                            <tbody class="align-middle">
						                            	@foreach($vitals as $key=>$value)
					                                    @if($value->status == 1)
					                                    <tr>
					                                    <td>{{Helper::c_decode(Helper::CheckVital($value->BP))}}</td>
					                                    <td>{{Helper::c_decode(Helper::CheckVital($value->HR))}}</td>
					                                    <td>{{Helper::c_decode(Helper::CheckVital($value->RR))}}</td>
					                                    <td>{{Helper::c_decode(Helper::CheckVital($value->temp))}}</td>
					                                    <td>{{Helper::c_decode(Helper::CheckVital($value->pain))}}</td>
					                                    <td>{{Helper::c_decode(Helper::CheckVital($value->height))}}</td>
					                                    <td>{{Helper::c_decode(Helper::CheckVital($value->weight))}}</td>
					                                    <td>{{Helper::c_decode(Helper::CheckVital($value->BMI))}}</td>
					                                    <td>{{Helper::c_decode(Helper::CheckVital($value->SPO2))}}</td>
					                                    <td class="action">
					                                    	<!-- <button class="btn" data-toggle="tooltip" title="Edit"><i class="material-icons-outlined text-secondary">edit</i></button> -->
					                                    	@if(!Helper::is_json($value->height))
					                                    	<button class="btn" data-toggle="tooltip" title="Delete" onclick="deleteVitals({{$value->id}})"><i class="material-icons-outlined text-danger">delete</i></button>
					                                    	@endif
					                                    </td>
					                                    </tr>
					                                    @endif
					                                    @endforeach
						                            </tbody>
						                        </table>
						                    </div>
										</div>
										<div class="tab-pane fade" id="notes">
											<div class="p-3 bg-gray">
												<div class="media align-items-center justify-content-end">
													@if($is_add)
													<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#newNote">Add New</button>
													@endif
												</div>
											</div>
											<div class="p-3 border-bottom">
												<div class="row align-items-center">
													<div class="col-md-6 col-xl-8">
														<h4 class="mb-md-0">Notes</h4>
													</div>
												</div>
											</div>
											<div class="p-3">
												@foreach($notes as $key=>$value)
												<div class="media p-3 align-items-center border shadow rounded mb-3">
													<div class="media-body mr-3">
														<div><span class="fw-500">{{Helper::c_decode($value->title)}}</span> <?php echo Helper::c_decode(Helper::CheckNotes($value->notes)); ?></div>
														<div>{{App\User::find($value->user_id)->getFullNameAttribute()}} (Dos - {{date_format(date_create($value->created_at),"d M, Y")}})</div>
													</div>
													@if(!Helper::is_json($value->notes))
													<button type="button" class="btn btn-secondary btn-wide" onclick="getDetailsFromBackEnd({{$value->id}})">Open</button>
													@endif
												</div>
												@endforeach
											</div>
										</div>
										<div class="tab-pane fade" id="labStudies">
											<div class="p-3 bg-gray">
												<div class="media align-items-center justify-content-end">
													@if($is_add)
													<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#newlabStudies">Add New</button>
													@endif
												</div>
											</div>
											<div class="p-3 border-bottom">
												<div class="row align-items-center">
													<div class="col-md-6 col-xl-8">
														<h4 class="mb-md-0">Lab/Studies</h4>
													</div>
												</div>
											</div>
											<div class="p-3">
												@foreach($labs as $key=>$value)
												<div class="media p-3 align-items-center border shadow rounded mb-3">
													<div class="media-body mr-3">
														<div><span class="fw-500">{{Helper::c_decode($value->title)}}</span> {{Helper::c_decode(Helper::CheckLab($value->notes))}}</div>
														<div>{{App\User::find($value->user_id)->getFullNameAttribute()}} (Dos - {{date_format(date_create($value->created_at),"d M, Y")}})</div>
													</div>
													@if(!Helper::is_json($value->notes))
													<button type="button" class="btn btn-secondary btn-wide" onclick="getDetailsFromBackEndLab({{$value->id}})">Open</button>
													@endif
												</div>
												@endforeach
											</div>
										</div>
										<div class="tab-pane fade" id="uploadFile">
											<div class="p-3 bg-gray">
												<div class="media align-items-center justify-content-end">
													@if($is_add)
													<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#newUpload">Add New File</button>
													@endif
												</div>
											</div>
											<div class="p-3 border-bottom">
												<div class="row align-items-center">
													<div class="col-md-6 col-xl-8">
														<h4 class="mb-md-0">Upload Files</h4>
													</div>
												</div>
											</div>
											<div class="p-3">
												@foreach($patientfileupload as $key=>$value)
												<div class="media p-3 align-items-center border shadow rounded mb-3">
													<div class="media-body mr-3">
														<div><span class="fw-500">{{Helper::c_decode($value->title)}}</span> {{Helper::c_decode($value->description)}}</div>
														<div>{{App\User::find($value->user_id)->getFullNameAttribute()}} (Dos - {{date_format(date_create($value->created_at),"d M, Y")}})</div>
													</div>
													<a href="{{$value->path}}" class="btn btn-secondary btn-wide">Download</a>
												</div>
												@endforeach
											</div>
										</div>
										<div class="tab-pane fade" id="CCDAuploadFile">
											<div class="p-3 bg-gray">
												<div class="media align-items-center justify-content-end">
													@if($is_add)
													<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#CCDAUpload">Import CCDA XML File</button>
													@endif
												</div>
											</div>
											<div class="p-3 border-bottom">
												<div class="row align-items-center">
													<div class="col-md-6 col-xl-8">
														<h4 class="mb-md-0">All Imported XML Files</h4>
													</div>
												</div>
											</div>
											<div class="p-3">
												@foreach($ccdafileimport as $key=>$value)
												<div class="media p-3 align-items-center border shadow rounded mb-3">
													<div class="media-body mr-3">
														<div><span class="fw-500">{{Helper::c_decode($value->description)}}</span> </div>
														<div>{{App\User::find($value->user_id)->getFullNameAttribute()}} (CCDA Xml File - {{date_format(date_create($value->created_at),"d M, Y")}}) - {{$value->status == '1' ? 'InProccess' : ($value->status == '2' ? 'Completed' : 'Failed')}}</div>
													</div>
													<a target="__blank" href="{{$value->file_path}}" class="btn btn-secondary btn-wide" download>Download</a>
												</div>
												@endforeach
											</div>
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

	<div class="modal fade" id="newProblem">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header align-items-center">
					<h5 class="modal-title mb-0 text-secondary">Add New Problem</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<form class="form" action="{{route('Dashboard.Patient.addProblem')}}" method="POST">
						@csrf
						<input type="hidden" name="patient_id" value="{{$patient->id}}">
						<div class="form-group">
							<div class="custom-radio">
	                            <div class="radio">
	                                <label>
	                                    <input type="radio" class="form-check-input" name="status" checked="" value="1">
	                                    <i class="form-icon"></i>Active
	                                </label>
	                            </div>
	                            <div class="radio">
	                                <label>
	                                    <input type="radio" class="form-check-input" name="status" value="2">
	                                    <i class="form-icon"></i>Non Active
	                                </label>
	                            </div>
	                        </div>
	                    </div>
						<div class="form-group">
							<label>Problem/Issues *</label>
							<select class="form-control custom-select" required name="problem">
								<option selected="" disabled="">Select problem/issues</option>
								<option value="Option 1">Option 1</option>
								<option value="Option 2">Option 2</option>
								<option value="Option 3">Option 3</option>
							</select>
						</div>
						<div class="form-group">
							<label>Type *</label>
							<select class="form-control custom-select" required name="type">
								<option selected="" disabled="">Select problem type</option>
								<option value="Option 1">Option 1</option>
								<option value="Option 2">Option 2</option>
								<option value="Option 3">Option 3</option>
							</select>
						</div>
						<div class="form-group">
							<label>Diagnosis Description *</label>
							<textarea class="form-control" rows="4" required name="diagnosis">{{old('diagnosis')}}</textarea>
						</div>
						<div class="form-group text-center mt-4">
							<button type="submit" class="btn btn-orange">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="newMedication">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header align-items-center">
					<h5 class="modal-title mb-0 text-secondary">Add New Medication</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<form class="form" action="{{route('Dashboard.Patient.addMedication')}}" method="POST">
						@csrf
						<input type="hidden" name="patient_id" value="{{$patient->id}}">
						<div class="form-group">
							<div class="custom-radio">
	                            <div class="radio">
	                                <label>
	                                    <input type="radio" required class="form-check-input" name="status" value="1" checked="">
	                                    <i class="form-icon"></i>Active
	                                </label>
	                            </div>
	                            <div class="radio">
	                                <label>
	                                    <input type="radio" required class="form-check-input" name="status" value="2">
	                                    <i class="form-icon"></i>Discontinued
	                                </label>
	                            </div>
	                            <div class="radio">
	                                <label>
	                                    <input type="radio" required class="form-check-input" name="status" value="3">
	                                    <i class="form-icon"></i>Not Administered
	                                </label>
	                            </div>
	                            <div class="radio">
	                                <label>
	                                    <input type="radio" required class="form-check-input" name="status" value="4">
	                                    <i class="form-icon"></i>Internal Prescription
	                                </label>
	                            </div>
	                        </div>
	                    </div>
						<div class="form-group">
							<label>Medicine</label>
							<select class="form-control custom-select" required name="medicine">
								<option selected="" disabled="">Select medicine</option>
								<option value="Option 1">Option 1</option>
								<option value="Option 2">Option 2</option>
								<option value="Option 3">Option 3</option>
							</select>
						</div>
						<div class="form-group">
							<label>Pt. Instructions</label>
							<textarea class="form-control" rows="4" required name="pt_instructions"></textarea>
						</div>
						<div class="form-group text-center mt-4">
							<button type="submit" class="btn btn-orange">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="newAllergy">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header align-items-center">
					<h5 class="modal-title mb-0 text-secondary">Add New Allergy</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<form class="form" action="{{route('Dashboard.Patient.addAllergie')}}" method="POST">
						@csrf
						<input type="hidden" name="patient_id" value="{{$patient->id}}">
						<div class="form-group">
							<div class="custom-radio">
	                            <div class="radio">
	                                <label>
	                                    <input type="radio" class="form-check-input" name="status" value="1" checked="">
	                                    <i class="form-icon"></i>Active
	                                </label>
	                            </div>
	                            <div class="radio">
	                                <label>
	                                    <input type="radio" class="form-check-input" name="status" value="2">
	                                    <i class="form-icon"></i>Non Active
	                                </label>
	                            </div>
	                        </div>
	                    </div>
						<div class="form-group">
							<label>Allergent</label>
							<input type="text" name="allergent" class="form-control">
						</div>
						<div class="form-group">
							<label>Severity</label>
							<select class="form-control custom-select" name="severity">
								<option selected="" disabled="">Select severity</option>
								<option value="Option 1">Option 1</option>
								<option value="Option 2">Option 2</option>
								<option value="Option 3">Option 3</option>
							</select>
						</div>
						<div class="form-group">
							<label>Reaction</label>
							<textarea class="form-control" rows="3" name="reaction"></textarea>
						</div>
						<div class="form-group text-center mt-4">
							<button type="submit" class="btn btn-orange">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="newVital">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header align-items-center">
					<h5 class="modal-title mb-0 text-secondary">Add New Vital</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<form class="form" action="{{route('Dashboard.Patient.addVital')}}" method="POST">
						@csrf
						<input type="hidden" name="patient_id" value="{{$patient->id}}">
						<div class="row">
							<div class="col-12 col-md-4 form-group">
								<label>BP</label>
								<input type="text" name="BP" required class="form-control">
							</div>
							<div class="col-6 col-md-4 form-group">
								<label>HR</label>
								<input type="text" name="HR" required class="form-control">
							</div>
							<div class="col-6 col-md-4 form-group">
								<label>RR</label>
								<input type="text" name="RR" required class="form-control">
							</div>
							<div class="col-6 col-md-4 form-group">
								<label>Temp.</label>
								<input type="text" name="temp" required class="form-control">
							</div>
							<div class="col-6 col-md-4 form-group">
								<label>Pain</label>
								<input type="text" name="pain" required class="form-control">
							</div>
							<div class="col-6 col-md-4 form-group">
								<label>Height</label>
								<input type="text" name="height" required class="form-control">
							</div>
							<div class="col-6 col-md-4 form-group">
								<label>Weight</label>
								<input type="text" name="weight" required class="form-control">
							</div>
							<div class="col-6 col-md-4 form-group">
								<label>BMI</label>
								<input type="text" name="BMI" required class="form-control">
							</div>
							<div class="col-6 col-md-4 form-group">
								<label>SPO2</label>
								<input type="text" name="SPO2" required class="form-control">
							</div>
							<div class="col-12 form-group text-center mt-4">
								<button type="submit" class="btn btn-orange">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="newNote">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header align-items-center">
					<h5 class="modal-title mb-0 text-secondary">Add New Notes</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<form class="form" action="{{route('Dashboard.Patient.addNote')}}" method="POST">
						@csrf
						<input type="hidden" name="patient_id" value="{{$patient->id}}">
						<input type="hidden" name="notes_id" id="notes_id" value="">
						<div class="form-group">
							<div class="custom-radio">
	                            <div class="radio">
	                                <label>
	                                    <input type="radio" id="notes_active" class="form-check-input" name="status" checked="" value="1">
	                                    <i class="form-icon"></i>Active
	                                </label>
	                            </div>
	                            <div class="radio">
	                                <label>
	                                    <input type="radio" id="notes_deactive" class="form-check-input" name="status" value="2">
	                                    <i class="form-icon"></i>Non Active
	                                </label>
	                            </div>
	                        </div>
	                    </div>
						<div class="row">
							<div class="col-12 col-md-12 form-group">
								<label>Title</label>
								<input type="text" name="title" id="notes_title" required class="form-control">
							</div>
							<div class="col-12 col-md-12 form-group">
								<label>Notes</label>
								<textarea name="notes" id="notes_notes" class="form-control" required></textarea>
							</div>
							<div class="col-12 form-group text-center mt-4">
								<button type="submit" class="btn btn-orange">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="newUpload">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header align-items-center">
					<h5 class="modal-title mb-0 text-secondary">Add New Upload</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<form class="form" action="{{route('Dashboard.Patient.uploadFile')}}" method="POST" enctype='multipart/form-data'>
						@csrf
						<input type="hidden" name="patient_id" value="{{$patient->id}}">
						<div class="row">
							<div class="col-12 col-md-12 form-group">
								<label>Title</label>
								<input type="text" name="title" class="form-control" required class="form-control">
							</div>
							<div class="col-12 col-md-12 form-group">
								<label>Upload</label>
								<input type="file" name="file" class="form-control" required class="form-control">
							</div>
							<div class="col-12 col-md-12 form-group">
								<label>Description</label>
								<textarea name="description" class="form-control" required></textarea>

							</div>
							<div class="col-12 form-group text-center mt-4">
								<button type="submit" class="btn btn-orange">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="CCDAUpload">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header align-items-center">
					<h5 class="modal-title mb-0 text-secondary">Add New Upload</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<form class="form" action="{{route('Dashboard.Patient.ccdaimportFile')}}" method="POST" enctype='multipart/form-data'>
						@csrf
						<input type="hidden" name="patient_id" value="{{$patient->id}}">
						<div class="row">
							<div class="col-12 col-md-12 form-group">
								<label>Description</label>
								<textarea name="description" class="form-control" required></textarea>
							</div>
							<div class="col-12 col-md-12 form-group">
								<label>Upload</label>
								<input type="file" name="file" class="form-control" required class="form-control" accept =".xml">
							</div>
							<div class="col-12 form-group text-center mt-4">
								<button type="submit" class="btn btn-orange">Import</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="newlabStudies">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header align-items-center">
					<h5 class="modal-title mb-0 text-secondary">Add New Lab Studies</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<form class="form" action="{{route('Dashboard.Patient.addLabStudies')}}" method="POST">
						@csrf
						<input type="hidden" name="patient_id" value="{{$patient->id}}">
						<input type="hidden" name="labs_id" id="labs_id" value="">
						<div class="form-group">
							<div class="custom-radio">
	                            <div class="radio">
	                                <label>
	                                    <input type="radio" id="labs_active" class="form-check-input" name="status" checked="" value="1">
	                                    <i class="form-icon"></i>Active
	                                </label>
	                            </div>
	                            <div class="radio">
	                                <label>
	                                    <input type="radio" id="labs_deactive" class="form-check-input" name="status" value="2">
	                                    <i class="form-icon"></i>Non Active
	                                </label>
	                            </div>
	                        </div>
	                    </div>
						<div class="row">
							<div class="col-12 col-md-12 form-group">
								<label>Title</label>
								<input type="text" name="title" id="labs_title" required class="form-control">
							</div>
							<div class="col-12 col-md-12 form-group">
								<label>Notes</label>
								<textarea name="notes" id="labs_notes" class="form-control" required></textarea>
							</div>
							<div class="col-12 form-group text-center mt-4">
								<button type="submit" class="btn btn-orange">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="labView">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header align-items-center">
					<h5 class="modal-title mb-0 text-secondary">View</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<div class="row mb-4 pb-3 border-bottom">
						<div class="col-xl-3 col-md-4 col-6">
							<small>Entered By</small>
							<div class="fw-500">Micheal Smith on 06/06/2020</div>
						</div>
						<div class="col-xl-3 col-md-4 col-6">
							<small>Performed By</small>
							<div class="fw-500">Micheal Smith on 06/06/2020</div>
						</div>
						<div class="col-xl-3 col-md-4">
							<small>Mapped ICD Codes</small>
							<div class="fw-500">O36.90X0</div>
						</div>
					</div>
					<div class="form-group">
						<label>Staff Comment</label>
						<textarea class="form-control" rows="3"></textarea>
					</div>
					<div class="media p-3 align-items-center border">
						<div class="media-body mr-3">
							<div><span class="fw-500">Hemoglobin A1C</span></div>
							<div>Requested on 06/06/2020</div>
							<div class="mt-2">In order to get credit for Quality Measure Reporting, Please fill out the following results for this lab.</div>
						</div>
						<button type="button" class="btn btn-secondary btn-wide">Mark as Added</button>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
<script>
function deleteProblem(id){
	//Alert function
    swal({
	  title: "Are you sure you want to delete problems?",
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
	  	var patient_id = id;
        $.ajax({
          url:"{{url('/dashboard/Patient/delete/Problem/')}}/"+patient_id,
          method:"GET",
          success:function(data){
           	swal({
	            title: "Deleted!",
	            text: "Problem Deleted Successfully.",
	            type: "success"
	        }, function() {
	            location.reload();
	        });
          }
        });
	  } else {
	    swal("Cancelled", "Problem delete fail", "error");
	  }
	});
    //End Alert
}

function deleteMedications(id){
	//Alert function
    swal({
	  title: "Are you sure you want to delete medication?",
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
	  	var patient_id = id;
        $.ajax({
          url:"{{url('/dashboard/Patient/delete/medication/')}}/"+patient_id,
          method:"GET",
          success:function(data){
           	swal({
	            title: "Deleted!",
	            text: "Medication Deleted Successfully.",
	            type: "success"
	        }, function() {
	            location.reload();
	        });
          }
        });
	  } else {
	    swal("Cancelled", "Medication delete fail", "error");
	  }
	});
    //End Alert
}

function deleteAllergies(id){
	//Alert function
    swal({
	  title: "Are you sure you want to delete allergie?",
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
	  	var patient_id = id;
        $.ajax({
          url:"{{url('/dashboard/Patient/delete/allergie/')}}/"+patient_id,
          method:"GET",
          success:function(data){
           	swal({
	            title: "Deleted!",
	            text: "Allergies deleted successfully.",
	            type: "success"
	        }, function() {
	            location.reload();
	        });
          }
        });
	  } else {
	    swal("Cancelled", "Allergie delete fail", "error");
	  }
	});
    //End Alert
}

function deleteVitals(id){
	//Alert function
    swal({
	  title: "Are you sure you want to delete vital?",
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
	  	var patient_id = id;
        $.ajax({
          url:"{{url('/dashboard/Patient/delete/vital/')}}/"+patient_id,
          method:"GET",
          success:function(data){
           	swal({
	            title: "Deleted!",
	            text: "Vitals deleted successfully.",
	            type: "success"
	        }, function() {
	            location.reload();
	        });
          }
        });
	  } else {
	    swal("Cancelled", "Vital delete fail", "error");
	  }
	});
    //End Alert
}

function deleteNotes(id){
	//Alert function
    swal({
	  title: "Are you sure you want to delete note?",
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
	  	var patient_id = id;
        $.ajax({
          url:"{{url('/dashboard/Patient/delete/note/')}}/"+patient_id,
          method:"GET",
          success:function(data){
           	swal({
	            title: "Deleted!",
	            text: "Note Deleted Successfully.",
	            type: "success"
	        }, function() {
	            location.reload();
	        });
          }
        });
	  } else {
	    swal("Cancelled", "Note delete fail", "error");
	  }
	});
    //End Alert
}

function getDetailsFromBackEnd(id){
	$.ajax({
      url:"{{url('/dashboard/Patient/get/note/')}}/"+id,
      method:"GET",
      success:function(data){
       	console.log(data.id);
       	if(data.status == 1){
       		$('#notes_deactive').prop('unchecked');
       		$('#notes_active').prop('checked');
       	}else{
       		$('#notes_active').prop('unchecked');
       		$('#notes_deactive').prop('checked');
       	}
       	
       	
       	$('#notes_title').val(data.title);
       	$('#notes_notes').val(data.notes);
       	$('#notes_id').val(data.id);

       	$('#newNote').modal('show');
      }
    });
}

function getDetailsFromBackEndLab(id){
	$.ajax({
      url:"{{url('/dashboard/Patient/get/lab/')}}/"+id,
      method:"GET",
      success:function(data){
       	console.log(data.id);
       	if(data.status == 1){
       		$('#labs_deactive').prop('unchecked');
       		$('#labs_active').prop('checked');
       	}else{
       		$('#labs_active').prop('unchecked');
       		$('#labs_deactive').prop('checked');
       	}
       	
       	
       	$('#labs_title').val(data.title);
       	$('#labs_notes').val(data.notes);
       	$('#labs_id').val(data.id);

       	$('#newlabStudies').modal('show');
      }
    });
}
</script>
@endsection


