@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>Review & Approve Applicants</span>
				</div>
				<div class="card">
					<div class="card-header p-0">
						<ul class="product-tab-list nav tab-border justify-content-lg-center mt-5">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#all">
									<span>All Applicants</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#approved">
									<span>Approved Applicants</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#pending">
									<span>Pending Applicants</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#declined">
									<span>Declined Applicants</span>
								</a>
							</li>
						</ul>
						<!-- <div class="row p-3 no-gutters">
							<div class="col-md-6 col-lg-4">
								<div class="input-group input-group-inner">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="material-icons-outlined">search</i></span>
									</div>
									<input type="text" name="" class="form-control" placeholder="Search">
								</div>
							</div>
						</div> -->
					</div>
					<div class="card-body">
						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane active" id="all">
								<div class="table-responsive">
			                        <table class="table table-rounded all_trails">
			                            <thead class="text-secondary">
			                                <tr>
			                                    <th>Applicant Name</th>
			                                    <th>Name of Clinical Trial</th>
			                                    <th>Date Submitted</th>
			                                    <th style="width: 100px;">Status</th>
			                                    <th>Payment</th>
			                                </tr>
			                            </thead>
			                            <tbody class="align-middle">
			                                @foreach($submitTrials as $key=>$value)
		                                	<tr>
		                                		<td>{{$value->getUser['firstname']}} {{$value->getUser['lastname']}}</td>
		                                		<td>
		                                		{{$value->getTrial['Condition']}}
		                                		{{substr_replace($value->getTrial['BriefTitle'], "...", 50)}}</td>
		                                		<td>{{date("d M, Y", strtotime($value->created_at))}}</td>
		                                		<td>
		                                			@if($value->status == '1')
		                                			<span class="badge badge-success p-2 w-100">Approved</span>
		                                			@elseif($value->status == '2')
		                                			<span class="badge badge-primary p-2 w-100">Pending</span>
		                                			@elseif($value->status == '3')
		                                			<span class="badge badge-danger p-2 w-100">Declined</span>
		                                			@endif

		                                		</td>
		                                		<td>N/A</td>
		                                	</tr>
		                                	@endforeach
			                            </tbody>
			                        </table>
			                    </div>
							</div>
							<div class="tab-pane fade" id="approved">
								<div class="table-responsive">
			                        <table class="table table-rounded approved_trails">
			                            <thead class="text-secondary">
			                                <tr>
			                                    <th>Applicant Name</th>
			                                    <th>Name of Clinical Trial</th>
			                                    <th>Date Submitted</th>
			                                    <th style="width: 100px;">Status</th>
			                                    <th>Payment</th>
			                                </tr>
			                            </thead>
			                            <tbody class="align-middle">
			                                @foreach($submitTrials as $key=>$value)
				                                @if($value->status == '1')
			                                	<tr>
			                                		<td>{{$value->getUser['firstname']}} {{$value->getUser['lastname']}}</td>
			                                		<td>
			                                		{{$value->getTrial['Condition']}}
			                                		{{substr_replace($value->getTrial['BriefTitle'], "...", 50)}}</td>
			                                		<td>{{date("d M, Y", strtotime($value->created_at))}}</td>
			                                		<td>
			                                			@if($value->status == '1')
			                                			<span class="badge badge-success p-2 w-100">Approved</span>
			                                			@elseif($value->status == '2')
			                                			<span class="badge badge-primary p-2 w-100">Pending</span>
			                                			@elseif($value->status == '3')
			                                			<span class="badge badge-danger p-2 w-100">Declined</span>
			                                			@endif
			                                		</td>
			                                		<td>N/A</td>
			                                	</tr>
			                                	@endif
		                                	@endforeach
			                            </tbody>
			                        </table>
			                    </div>
		                    </div>
							<div class="tab-pane fade" id="pending">
								<div class="table-responsive">
			                        <table class="table table-rounded pending_trails">
			                            <thead class="text-secondary">
			                                <tr>
			                                    <th>Applicant Name</th>
			                                    <th>Name of Clinical Trial</th>
			                                    <th>Date Submitted</th>
			                                    <th style="width: 100px;">Status</th>
			                                    <th>Payment</th>
			                                </tr>
			                            </thead>
			                            <tbody class="align-middle">
			                                @foreach($submitTrials as $key=>$value)
				                                @if($value->status == '2')
			                                	<tr>
			                                		<td>{{$value->getUser['firstname']}} {{$value->getUser['lastname']}}</td>
			                                		<td>
			                                		{{$value->getTrial['Condition']}}
			                                		{{substr_replace($value->getTrial['BriefTitle'], "...", 50)}}</td>
			                                		<td>{{date("d M, Y", strtotime($value->created_at))}}</td>
			                                		<td>
			                                			@if($value->status == '1')
			                                			<span class="badge badge-success p-2 w-100">Approved</span>
			                                			@elseif($value->status == '2')
			                                			<span class="badge badge-primary p-2 w-100">Pending</span>
			                                			@elseif($value->status == '3')
			                                			<span class="badge badge-danger p-2 w-100">Declined</span>
			                                			@endif

			                                		</td>
			                                		<td>N/A</td>
			                                	</tr>
			                                	@endif
		                                	@endforeach
			                            </tbody>
			                        </table>
			                    </div>
							</div>
							<div class="tab-pane fade" id="declined">
								<div class="table-responsive">
			                        <table class="table table-rounded declined_trails">
			                            <thead class="text-secondary">
			                                <tr>
			                                    <th>Applicant Name</th>
			                                    <th>Name of Clinical Trial</th>
			                                    <th>Date Submitted</th>
			                                    <th style="width: 100px;">Status</th>
			                                    <th>Payment</th>
			                                </tr>
			                            </thead>
			                            <tbody class="align-middle">
			                                @foreach($submitTrials as $key=>$value)
				                                @if($value->status == '3')
			                                	<tr>
			                                		<td>{{$value->getUser['firstname']}} {{$value->getUser['lastname']}}</td>
			                                		<td>
			                                		{{$value->getTrial['Condition']}}
			                                		{{substr_replace($value->getTrial['BriefTitle'], "...", 50)}}</td>
			                                		<td>{{date("d M, Y", strtotime($value->created_at))}}</td>
			                                		<td>
			                                			@if($value->status == '1')
			                                			<span class="badge badge-success p-2 w-100">Approved</span>
			                                			@elseif($value->status == '2')
			                                			<span class="badge badge-primary p-2 w-100">Pending</span>
			                                			@elseif($value->status == '3')
			                                			<span class="badge badge-danger p-2 w-100">Declined</span>
			                                			@endif

			                                		</td>
			                                		<td>N/A</td>
			                                	</tr>
			                                	@endif
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
		$('.all_trails').DataTable();
		$('.approved_trails').DataTable();
		$('.pending_trails').DataTable();
		$('.declined_trails').DataTable();
	})
</script>
@endsection