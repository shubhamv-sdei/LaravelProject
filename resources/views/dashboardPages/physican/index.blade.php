
@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')	
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<!-- <div class="wrapper-title">
					<span>Invite / Save Patient List</span>
					<button type="button" class="btn btn-secondary btn-wide" data-toggle="modal" data-target="#findPatient" id="findPatientModel">Invite A Patient</button>
					
					<a href="{{route('Dashboard.patientAdd')}}" class="btn btn-secondary btn-wide" id="findPatientModel"> <i class="material-icons-outlined mr-2">add</i> New Patient</a>
				</div> -->
				<div class="card">
					<div class="card-body px-0">
						<!-- <ul class="product-tab-list nav tab-border">
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
						</ul> -->
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
				                                <th style="width: 150px;">Verified</th>
				                                <th style="width: 200px;">Created At</th>
				                                <th style="width: 100px;">Action</th>
				                            </tr>
				                        </thead>

				                        <tbody class="align-middle">
				                        	@foreach($physican as $key=>$value)
				                            <tr>
				                                <td>{{$value->firstname}}</td>
				                                <td>{{$value->lastname}}</td>
				                                <td>{{$value->email}}</td>
				                                <td>
				                                	@if($value->verified)
				                                		<span class="badge badge-success p-2 w-100">Active</span>
				                                	@else
				                                		<span class="badge badge-danger p-2 w-100">Not Active</span>
				                                	@endif
				                                </td>
				                                <td>{{$value->created_at}}</td>
				                                <td class="action">
				                                	<!-- <a class="btn" href="{{url('/dashboard/patient/view')}}/{{$value->id}}"><i class="material-icons-outlined text-secondary">visibility</i></a> -->

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
@endsection

@section('script')
<script>
$(document).ready( function () {
  $('#savePatientlist').DataTable();
  $('#savePatientlist2').DataTable();

  @if ($errors->count())
  	$('#findPatientModel').click();
  @endif

});
</script>
@endsection