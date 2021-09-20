@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
<div class="content-wrapper">
	<div class="p-3 p-md-4">
		<div class="wrapper">
			<div class="wrapper-title">
				<span>Change Password</span>
			</div>
			<div class="card">
				<!-- <div class="card-header">
					<span class="lead fw-400">Change Password</span>
				</div> -->
				@if(Session::has('msg'))
				    <div class="alert alert-warning alert-dismissible fade show" role="alert">
				      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				        <span aria-hidden="true">&times;</span>
				      </button>
				      {{ Session::get('msg') }}
				    </div>
				@endif
				<div class="card-body">
					<div class="p-xl-5 container">
						<div class="row">
							
							<div class="col-md-8 col-xl-9 mt-3 mt-md-0">
								<form action="{{route('Dashboard.updateChangePassword')}}" method="post">
								<div class="table-responsive">
									<table class="table">
											@csrf
											<tbody>
												<tr>
													<td><span class="red_required">*</span>Old Password:</td>
													<td class="text-secondary">
														<input type="password" name="old_password" value="" maxlength="12" class="form-control" required placeholder="*****">
														@error('old_password')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                @enderror
													</td>
												</tr>
												<tr>
													<td><span class="red_required">*</span>New Password:</td>
													<td class="text-secondary">
														<input type="password" name="password" value="" maxlength="12" class="form-control" required placeholder="*****">
														@error('password')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                @enderror
													</td>
												</tr>
												<tr>
													<td><span class="red_required">*</span>Confirm Password:</td>
													<td class="text-secondary">
														<input type="password" name="password_confirmation" maxlength="12" value="" required class="form-control" placeholder="*****">
														@error('password_confirmation')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                @enderror
													</td>
												</tr>
											</tbody>
										</form>
									</table>
								</div>
								<div class="mt-3 text-right">
									<button type="submit" class="btn btn-orange btn-wide">UPDATE</button>
								</div>
								</form>
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