
@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')	
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>FAQ</span>
					@if(Auth::user()->role == '1')
					<a href="{{route('Dashboard.Physican.addQuestion')}}" class="btn btn-secondary btn-wide"> <i class="material-icons-outlined mr-2">add</i> Ask Question</a>
					@endif
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
				                            	<th style="width: 150px;">#ID</th>
				                            	<th style="width: 150px;">Related Trial</th>
				                                <th style="width: 150px;">Question</th>
				                                <th style="width: 150px;">Created By</th>
				                                <th style="width: 150px;">Created At</th>
				                                <th style="width: 150px;">Status</th>
				                                <th style="width: 100px;">Action</th>
				                            </tr>
				                        </thead>

				                        <tbody class="align-middle">
				                        	@foreach($data as $key=>$value)
				                            <tr>
				                                <td>QA_FAQ_{{$value->id}}</td>
				                                <td><a href="{{url('dashboard/ViewSavedTrial')}}/{{$value['getTrial']->id}}" __target="blank">{{$value['getTrial']->BriefTitle}}</a></td>
				                                <td>{{$value->question}}</td>
				                                <td>{{$value['getCreatedBy']->getFullNameAttribute()}}</td>
				                                <td>{{date_format(date_create($value->created_at),"d, M Y h:m A")}}</td>
				                                <td>{{($value->status == '1' ? 'Inprocess' : ($value->status == '2' ? 
				                                'Responed' : 'Draft'))}}</td>
				                                <td class="action">
				                                	@if(Auth::user()->role == '1')
				                                	<a href="{{url('dashboard/faq/edit/')}}/{{$value->id}}" class="btn" data-toggle="tooltip" title="Edit"><i class="material-icons-outlined text-primary">edit</i></a>

		                                			<button class="btn" data-toggle="tooltip" title="Delete Question" onclick="deleteQuestion('{{$value->id}}')"><i class="material-icons-outlined text-danger">delete</i></button>
		                                			@endif
		                                			<a href="{{url('dashboard/faq/response/')}}/{{$value->id}}" class="btn" data-toggle="tooltip" title="Add Response"><i class="material-icons-outlined text-success">question_answer</i></a>
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
});

function deleteQuestion(id){
	//Alert function
    swal({
	  title: "Are you sure you want to Delete Question?",
	  text: "You will not be able to recover this action!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Yes, Delete it!",
	  cancelButtonText: "Cancel",
	  closeOnConfirm: false,
	  closeOnCancel: false
	},
	function(isConfirm) {
	  if (isConfirm) {
        $.ajax({
          url:"{{url('dashboard/faq/delete')}}/"+id,
          method:"GET",
          success:function(data){
           	swal({
	            title: "Delete!",
	            text: "Question Deleted Successfully.",
	            type: "success"
	        }, function() {
	            location.reload();
	        });
          }
        });
	  } else {
	    swal("Cancelled", "Delete Fail", "error");
	  }
	});
	//End Alert
}
</script>
@endsection