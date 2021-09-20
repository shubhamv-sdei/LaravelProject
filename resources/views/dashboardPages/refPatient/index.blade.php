
@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')	
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>Ref. Patient/Volunteer List</span>
				</div>
				<div class="card">
					<div class="card-body px-0">
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
				                            	
				                                <th style="width: 150px;">Name</th>
				                                <th style="width: 150px;">Trial</th>
				                                <th>Email</th>
				                                <th style="width: 150px;">Inv. Name</th>
				                                <th style="width: 150px;">Ref. By</th>
				                                <th style="width: 200px;">Ref. At</th>
				                                <th style="width: 200px;">Trial Status</th>
				                                <th style="width: 100px;">Action</th>
				                            </tr>
				                        </thead>

				                        <tbody class="align-middle">
				                        	@foreach($patient as $key=>$value)
				                            <tr>
				                                <td>{{$value['getPatientDetails']->getFullNameAttribute()}}</td>
				                                <td>{{$value['getTrialDetails']->BriefTitle}}</td>
				                                <td>{{$value['getPatientDetails']->email}}</td>
				                                <td>{{Helper::getInvNameByTrialId($value->trial_id)}}</td>
				                                <td>{{$value['getCreatedBy']->getFullNameAttribute()}}</td>
				                                <td>{{date_format(date_create($value->created_at),"d, M Y h:m A")}}</td>
				                                <td>{{(($value['getStatusFromScreenVisit']->count() == '1') ? 'Completed' : 'In Process')}}</td>
				                                <td class="action">
				                                	<a href="{{url('/dashboard/refPatient/view/')}}/{{$value->id}}" class="btn" data-toggle="tooltip" title="View"><i class="material-icons-outlined text-primary">visibility</i></a>
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
@endsection

@section('script')
<script>
$(document).ready( function () {
  $('#savePatientlist').DataTable();
});
</script>
@endsection