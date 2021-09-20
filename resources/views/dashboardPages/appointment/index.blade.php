@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')	
	
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>My Appointments</span>
					<a href="{{route('Dashboard.AddAppointment')}}" type="button" class="btn btn-secondary d-flex align-items-center">
                        <i class="material-icons-outlined mr-2">add</i> Add New
                    </a>
				</div>
				<div class="card">
					<div class="card-body px-0">
						<ul class="product-tab-list nav tab-border">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#upcomingAppointments">
									<span>Upcoming Appointments</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#pastAppointments">
									<span>Past Appointments</span>
								</a>
							</li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane p-3 active" id="upcomingAppointments">
								<div class="row">
									<div class="col-md-6 col-lg-4 form-group">
										<select class="form-control custom-select MakeFiltter">
											<option selected disabled>Select Appointment Member</option>

												<option value="">All</option>
											@if(Auth::user()->role != '1')
											@foreach($physician as $key=>$value)
												<option value="{{$value->id}}"><a href="{{url('/dashboard/appointment/list')}}/{{$value->id}}">{{$value->firstname}} {{$value->lastname}} - Physician</a></option>
											@endforeach
											@endif
											@if(Auth::user()->role != '5')
												@foreach($principal_inv as $key=>$value)
													<option value="{{$value->id}}"><a href="{{url('/dashboard/appointment/list')}}/{{$value->id}}">{{$value->firstname}} {{$value->lastname}} - Inv.</a></option>
												@endforeach
											@endif
											@if(Auth::user()->role != '2')
												@foreach($patient as $key=>$value)
													<option value="{{$value->id}}"><a href="{{url('/dashboard/appointment/list')}}/{{$value->id}}">{{$value->firstname}} {{$value->lastname}} - Inv.</a></option>
												@endforeach
											@endif
										</select>
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
								<div class="table-responsive">
			                        <table class="table table-rounded AppointmentTable">
			                            <thead class="text-secondary">
			                                <tr>
			                                	<th class="w-25">To</th>
			                                	<th class="w-25">Title</th>
			                                    <th class="w-25">Date</th>
			                                    <th class="w-25">Time</th>
			                                    <th class="w-25">Consult</th>
			                                    <th class="w-35">Action</th>
			                                </tr>
			                            </thead>
			                            <tbody class="align-middle">
			                                @foreach($current as $key=>$value)
			                                <tr>
			                                	<td>{{App\User::find($value->to)->getFullNameAttribute()}}</td>
			                                	<td>{{$value->title}}</td>
			                                    <td>{{$value->date}}</td>
			                                    <td>{{$value->time}}</td>
			                                    <td class="action">
			                                    	@if($value->appointment_type == 1)
			                                    		<a href="{{url('/dashboard/appointment/videomeeting')}}/{{$value->id}}" class="btn" data-toggle="tooltip" title="Consult Appointment"><i class="material-icons-outlined">video_call</i></a>
			                                    	@else
			                                    		<i class="material-icons-outlined">audio_call</i>
			                                    	@endif
			                                    </td>
			                                    <td class="action">
			                                    	<button class="btn" data-toggle="tooltip" title="Delete Appointment" onclick="deleteTrial('{{$value->id}}')"><i class="material-icons-outlined text-danger">delete</i></button>
			                                    </td>
			                                </tr>
			                                @endforeach
			                            </tbody>
			                        </table>
			                    </div>
							</div>
							<div class="tab-pane p-3 fade" id="pastAppointments">
								<div class="row">
									<div class="col-md-6 col-lg-4 form-group">
										<select class="form-control custom-select MakeFiltter">
											<option selected disabled>Select Appointment Member</option>
											<option value="">All</option>
											@foreach($physician as $key=>$value)
												<option value="{{$value->id}}"><a href="{{url('/dashboard/appointment/list')}}/{{$value->id}}">{{$value->firstname}} {{$value->lastname}} - Principal</a></option>
											@endforeach
											@if(Auth::user()->role == '2')
												@foreach($principal_inv as $key=>$value)
													<option value="{{$value->id}}"><a href="{{url('/dashboard/appointment/list')}}/{{$value->id}}">{{$value->firstname}} {{$value->lastname}} - Inv.</a></option>
												@endforeach
											@endif
										</select>
									</div>
								</div>
								<div class="table-responsive">
			                        <table class="table table-rounded AppointmentTable">
			                            <thead class="text-secondary">
			                                <tr>
			                                	<th class="w-25">To</th>
			                                	<th class="w-25">Title</th>
			                                    <th class="w-25">Date</th>
			                                    <th class="w-25">Time</th>
			                                    <th class="w-25">Consult</th>
			                                    <th class="w-35">Action</th>
			                                </tr>
			                            </thead>
			                            <tbody class="align-middle">
			                                @foreach($past as $key=>$value)
			                                <tr>
			                                	<td>{{App\User::find($value->to)->getFullNameAttribute()}}</td>
			                                	<td>{{$value->title}}</td>
			                                    <td>{{$value->date}}</td>
			                                    <td>{{$value->time}}</td>
			                                    <td class="action">
			                                    	@if($value->appointment_type == 1)
			                                    		<button class="btn" data-toggle="tooltip" title="Consult Appointment"><i class="material-icons-outlined">video_call</i></button>
			                                    	@else
			                                    		<button class="btn" data-toggle="tooltip" title="Consult Appointment"><i class="material-icons-outlined">Call</i></button>
			                                    	@endif
			                                    </td>
			                                    <td class="action">
			                                    	<button class="btn" data-toggle="tooltip" title="Delete Appointment" onclick="deleteTrial('{{$value->id}}')"><i class="material-icons-outlined text-danger">delete</i></button>
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
$(document).ready(function(){
	$('.AppointmentTable').DataTable();

	$('.MakeFiltter').change(function(){
		var id = $(this).val();
		window.location = "{{url('/dashboard/appointment/list')}}/"+id;
	});

	@if(isset($select) && $select)
		$('.MakeFiltter').val({{$select}});
	@endif
});

function deleteTrial(id){
	//Alert function
    swal({
	  title: "Are you sure you want to delete appointment?",
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
	  	var appointment_id = id;
        $.ajax({
          url:"{{ route('Dashboard.DeleteAppointment') }}",
          method:"GET",
          data:{id:appointment_id},
          success:function(data){
           	// swal("Un-Assigned!", "Un-Assigned Investigator Successfully.", "success"); 
           	swal({
	            title: "Deleted!",
	            text: "Appointment Deleted Successfully.",
	            type: "success"
	        }, function() {
	            location.reload();
	        });
          }
        });
	  } else {
	    swal("Cancelled", "Appointment delete fail", "error");
	  }
	});
    //End Alert
}
</script>
@endsection