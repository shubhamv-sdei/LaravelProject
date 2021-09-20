@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')	

	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>New Appointment</span>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="container">
							<form class="form" method="POST" action="{{route('Dashboard.AddAppointmentProcess')}}">
								@csrf
								<div class="form-group">
									@if(Auth::user()->role == '1')  <!-- Physician --> 
									<label><span class="red_required">*</span>Patient & Principal Inv.</label>
									@elseif(Auth::user()->role == '5') <!--Principal Inv-->
									<label><span class="red_required">*</span>Physician & Patient</label>
									@elseif(Auth::user()->role == '4') <!-- // Sponser -->
									<label><span class="red_required">*</span>Physician & Principal Inv.</label>
									@elseif(Auth::user()->role == '2') <!-- // Patient -->
									<label><span class="red_required">*</span>Physician & Principal Inv.</label>
									@else
									<label><span class="red_required">*</span>Physician & Principal Inv.</label>
									@endif
									
									<select class="form-control custom-select" name="to" required value="{{ old('to') }}">
										@if(Auth::user()->role == '1')
										<option selected disabled="">Select Patient & Principal Inv.</option>
										@elseif(Auth::user()->role == '5') <!--Principal Inv-->
										<label>Select Physician & Patient</label>
										@elseif(Auth::user()->role == '4')
										<option selected disabled="">Select Physician & Principal Inv.</option>
										@elseif(Auth::user()->role == '2')
										<option selected disabled="">Select Physician & Principal Inv.</option>
										@else
										<option selected disabled="">Select Physician & Principal Inv.</option>
										@endif

										@if(Auth::user()->role != '2')
											@foreach($patient as $key=>$value)
												<option value="{{$value->id}}">{{$value->firstname}} {{$value->lastname}} - Patient</option>
											@endforeach
										@endif
										
										@if(Auth::user()->role != '1')
											@foreach($physician as $key=>$value)
												<option value="{{$value->id}}">{{$value->firstname}} {{$value->lastname}} - Physician</option>
											@endforeach
										@endif
										
										@if(Auth::user()->role != '5')
											@foreach($principal_inv as $key=>$value)
												<option value="{{$value->id}}">{{$value->firstname}} {{$value->lastname}} - Inv.</option>
											@endforeach
										@endif
										
									</select>
									@error('to')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
								<div class="form-group">
									<label><span class="red_required">*</span>Title</label>
									<input type="text" required maxlength="50" name="title" class="form-control" value="{{ old('title') }}">
									@error('title')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
								<div class="form-group">
									<label><span class="red_required">*</span>Description</label>
									<textarea class="form-control" required name="description" rows="4">{{ old('description') }}</textarea>
									@error('description')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
								<div class="row gutters-2">
									<div class="col-md-6 form-group">
										<label><span class="red_required">*</span>Date</label>
										<input type="date" required value="{{ old('date') }}" name="date" class="form-control">
										@error('date')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
									<div class="col-md-6 form-group">
										<label><span class="red_required">*</span>Time</label>
										<input type="time" required value="{{ old('time') }}" name="time" class="form-control">
										@error('time')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
									</div>
								</div>
								<div class="form-group">
									<label><span class="red_required">*</span>Appointment Type</label>
									<div class="custom-radio">
			                            <div class="radio">
			                                <label>
			                                    <input type="radio" class="form-check-input" name="appointmentType" value="1" checked>
			                                    <i class="form-icon"></i>Video
			                                </label>
			                            </div>
			                            <!-- <div class="radio">
			                                <label>
			                                    <input type="radio" class="form-check-input" name="appointmentType" value="2">
			                                    <i class="form-icon"></i>Call
			                                </label>
			                            </div> -->
			                            @error('appointmentType')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
			                        </div>
								</div>
								<div class="text-center mt-4">
									<button type="submit" class="btn btn-orange btn-wide">Save</button>
									<button type="button" class="btn btn-secondary btn-wide" data-dismiss="modal">Cancel</button>
								</div>
		                    </form>
			            </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection