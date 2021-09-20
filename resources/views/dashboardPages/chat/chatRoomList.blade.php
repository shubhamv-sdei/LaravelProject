@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>Chat Rooms</span>
				</div>
				<div class="card">
					<div class="card-body">
						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane active" id="all">
								<div class="table-responsive">
			                        <table class="table table-rounded all_trails">
			                            <thead class="text-secondary">
			                                <tr>
			                                    <th>#ID</th>
			                                    <th>To User</th>
			                                    <th>Role</th>
			                                    <th>Total Unread</th>
			                                    <th>Action</th>
			                                </tr>
			                            </thead>
			                            <tbody class="align-middle">
			                                @foreach($room as $key=>$value)
		                                	<tr>
		                                		<td class="user-nav">
		                                			{{$key+1}}
		                                		</td>
		                                		<td>
		                                			@if($value->to_user == Auth::id())
		                                				{{App\User::find($value->from_user)->getFullNameAttribute()}}
		                                			@else
		                                				{{App\User::find($value->to_user)->getFullNameAttribute()}}
		                                			@endif
		                                		</td>
		                                		<td>
		                                			@if($value->to_user == Auth::id())
		                                				@php 
		                                				$role = App\User::find($value->from_user)->role; 
		                                				@endphp
		                                			@else
		                                				@php 
		                                				$role = App\User::find($value->to_user)->role;
		                                				@endphp
		                                			@endif

		                                			@if($role == '1')
		                                				Physician
		                                			@elseif($role == '2')
		                                				Patient
		                                			@elseif($role == '5')
		                                				Principal Inv.
		                                			@elseif($role == '7')
		                                				Un-Verified User
		                                			@endif
		                                		</td>
		                                		<td>
		                                			{{$value->getChatCount()}}
		                                		</td>
		                                		<td class="action">
		                                			@if($value->to_user == Auth::id())
		                                				@php 
		                                				$role = App\User::find($value->from_user)->role; 
		                                				@endphp
		                                				<button type="button" class="btn">
			                                    		<a href="{{url('/dashboard/startchat/')}}/{{$value->from_user}}"
			                                    		<i class="material-icons-outlined text-success">chat_bubble_outline</i>
			                                    		</a>
			                                    	</button>
		                                			@else
		                                				@php 
		                                				$role = App\User::find($value->to_user)->role;
		                                				@endphp
		                                				<button type="button" class="btn">
				                                    		<a href="{{url('/dashboard/startchat/')}}/{{$value->to_user}}"
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
</script>
@endsection