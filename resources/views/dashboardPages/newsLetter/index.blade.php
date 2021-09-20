@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>All News Letters</span>
				</div>
				<div class="card">
					<div class="card-header p-2">
						<a href="{{route('superadmin.addNewsLetterPage')}}" class="btn btn-warning pull-right">Add New</a>
						&nbsp
					</div>
					<div class="card-body">
						@if(Session::has('msg'))
						    <div class="alert alert-warning alert-dismissible fade show" role="alert">
						      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						        <span aria-hidden="true">&times;</span>
						      </button>
						      {{ Session::get('msg') }}
						    </div>
						@endif
						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane active" id="all">
								<div class="table-responsive">
			                        <table class="table table-rounded newsLetter">
			                            <thead class="text-secondary">
			                                <tr>
			                                    <th>Title</th>
			                                    <th>Created At</th>
			                                    <th>Updated At</th>
			                                    <th>Status</th>
			                                    <th>Action</th>
			                                </tr>
			                            </thead>
			                            <tbody class="align-middle">
			                            	@foreach($news_letters as $key=>$value)
		                                	<tr>
		                                		<td>{{$value->title}}</td>
		                                		<td>{{date_format(date_create($value->created_at),"d, M Y h:m A")}}</td>
		                                		<td>{{date_format(date_create($value->updated_at),"d, M Y h:m A")}}</td>
		                                		<td>
		                                			@if($value->status == '1')
		                                				<span class="badge badge-success p-2 w-100">Active</span>
		                                			@elseif($value->status == '2')
		                                				<span class="badge badge-success p-2 w-100">InActive</span>
		                                			@else
		                                				<span class="badge badge-danger p-2 w-100">Draft</span>
		                                			@endif
		                                		</td>
		                                		<td class="action">
		                                			<a href="{{url('superadmin/newsletter/edit/')}}/{{$value->id}}" class="btn" data-toggle="tooltip" title="Edit"><i class="material-icons-outlined text-primary">edit</i></a>

		                                			<button class="btn" data-toggle="tooltip" title="Delete News Letter" onclick="deleteUser('{{$value->id}}')"><i class="material-icons-outlined text-danger">delete</i></button>

		                                			<a href="{{url('superadmin/newsLetterMail/')}}/{{$value->id}}" class="btn" data-toggle="tooltip" title="Send Mail"><i class="material-icons-outlined text-primary">mail</i></a>
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
		$('.newsLetter').DataTable();
	});

	function deleteUser(id){
		//Alert function
	    swal({
		  title: "Are you sure you want to Delete News Letter?",
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
              url:"{{url('superadmin/newsletter/delete')}}/"+id,
              method:"GET",
              success:function(data){
               	swal({
		            title: "Delete!",
		            text: "News Letter Deleted Successfully.",
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