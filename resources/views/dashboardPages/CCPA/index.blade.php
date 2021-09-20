@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>Submited CCPA List</span>
				</div>
				<div class="card">
					<div class="card-body">
						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane active" id="all">
								<div class="table-responsive">
			                        <table class="table table-rounded all_ccpa">
			                            <thead class="text-secondary">
			                                <tr>
			                                    <th>User Name</th>
			                                    <th>Role</th>
			                                    <th>Request Type</th>
			                                    <th>Email</th>
			                                    <th>Submitted At</th>
			                                </tr>
			                            </thead>
			                            <tbody class="align-middle">
			                                @foreach($data as $key=>$value)
		                                	<tr>
		                                		<td>
		                                			@if(isset($value['getUsers']))
		                                				{{$value['getUsers']->getFullNameAttribute()}}
		                                			@endif
		                                		</td>
		                                		<td>{{Helper::getRole($value->user_role)}}</td>
		                                		<td>{{Helper::get_InfoRole($value->req_type)}}</td>
		                                		<td>{{$value->email}}</td>
		                                		<td>{{$value->created_at}}</td>
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
		$('.all_ccpa').DataTable();
	})
</script>
@endsection