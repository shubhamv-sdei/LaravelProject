@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>Payment information</span>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="p-xl-5 container">
							@if(Session::has('msg'))
							    <div class="alert alert-warning alert-dismissible fade show" role="alert">
							      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							        <span aria-hidden="true">&times;</span>
							      </button>
							      {{ Session::get('msg') }}
							    </div>
							@endif
							<div class="row">
								<div class="col-md-5">
									<h4 class="text-secondary pr-xl-5">Please Enter Your Card Information Below:</h4>
									<div class="row mt-4 gutters-2">
										<div class="col-6 text-center">
											<img src="{{url('assets/images/credit-card.png')}}" class="rounded mb-2">
											<span>Credit card</span>
										</div>
										<div class="col-6 text-center">
											<img src="{{url('assets/images/debit-card.png')}}" class="rounded mb-2">
											<span>Debit card</span>
										</div>
									</div>
								</div>
								<div class="col-md-7 mt-3 mt-md-0">
									<form class="form" action="{{route('Dashboard.paymentInfoUpdate')}}" method="POST">
										@csrf
										<div class="row">
											<div class="col-12 form-group">
												<label><span class="red_required">*</span>Cardholder Name</label>
												<input type="text" name="cardholder_name" required class="form-control" value="{{(isset($data->cardholder_name) ? $data->cardholder_name : '')}}" placeholder="John Wick">
											</div>
											<div class="col-12 form-group">
												<label><span class="red_required">*</span>Credit Card Number</label>
												<input type="number" name="card_no" class="form-control" placeholder="4875 - 1794 - 3492 - 2274" value="{{(isset($data->card_no) ? $data->card_no : '')}}" max="9999999999999999">
											</div>
											<div class="col-md-6 form-group">
												<label><span class="red_required">*</span>Expiration Date</label>
												<select class="form-control custom-select" name="exp_month" value="{{(isset($data->exp_month) ? $data->exp_month : '')}}">
													<option disabled selected>Select Month</option>
												    <option value='1' {{(isset($data->exp_month) && $data->exp_month == '1' ? 'selected' : '')}}>Janaury</option>
												    <option value='2' {{(isset($data->exp_month) && $data->exp_month == '2' ? 'selected' : '')}}>February</option>
												    <option value='3' {{(isset($data->exp_month) && $data->exp_month == '3' ? 'selected' : '')}}>March</option>
												    <option value='4' {{(isset($data->exp_month) && $data->exp_month == '4' ? 'selected' : '')}}>April</option>
												    <option value='5' {{(isset($data->exp_month) && $data->exp_month == '5' ? 'selected' : '')}}>May</option>
												    <option value='6' {{(isset($data->exp_month) && $data->exp_month == '6' ? 'selected' : '')}}>June</option>
												    <option value='7' {{(isset($data->exp_month) && $data->exp_month == '7' ? 'selected' : '')}}>July</option>
												    <option value='8' {{(isset($data->exp_month) && $data->exp_month == '8' ? 'selected' : '')}}>August</option>
												    <option value='9' {{(isset($data->exp_month) && $data->exp_month == '9' ? 'selected' : '')}}>September</option>
												    <option value='10' {{(isset($data->exp_month) && $data->exp_month == '10' ? 'selected' : '')}}>October</option>
												    <option value='11' {{(isset($data->exp_month) && $data->exp_month == '11' ? 'selected' : '')}}>November</option>
												    <option value='12' {{(isset($data->exp_month) && $data->exp_month == '12' ? 'selected' : '')}}>December</option>
												</select>
											</div>
											<div class="col-md-6 form-group">
												<label><span class="red_required">*</span>Expiration Year</label>
												<select class="form-control custom-select" name="exp_year" value="{{(isset($data->exp_year) ? $data->exp_year : '')}}">
													<option disabled selected>Select Year</option>
												    <option value='2020' {{(isset($data->exp_year) && $data->exp_year == '2020' ? 'selected' : '')}}>2020</option>
												    <option value='2021' {{(isset($data->exp_year) && $data->exp_year == '2021' ? 'selected' : '')}}>2021</option>
												    <option value='2022' {{(isset($data->exp_year) && $data->exp_year == '2022' ? 'selected' : '')}}>2022</option>
												    <option value='2023' {{(isset($data->exp_year) && $data->exp_year == '2023' ? 'selected' : '')}}>2023</option>
												    <option value='2024' {{(isset($data->exp_year) && $data->exp_year == '2024' ? 'selected' : '')}}>2024</option>
												    <option value='2025' {{(isset($data->exp_year) && $data->exp_year == '2025' ? 'selected' : '')}}>2025</option>
												    <option value='2026' {{(isset($data->exp_year) && $data->exp_year == '2026' ? 'selected' : '')}}>2026</option>
												    <option value='2027 {{(isset($data->exp_year) && $data->exp_year == '2027' ? 'selected' : '')}}'>2027</option>
												    <option value='2028' {{(isset($data->exp_year) && $data->exp_year == '2028' ? 'selected' : '')}}>2028</option>
												    <option value='2029' {{(isset($data->exp_year) && $data->exp_year == '2029' ? 'selected' : '')}}>2029</option>
												    <option value='2030' {{(isset($data->exp_year) && $data->exp_year == '2030' ? 'selected' : '')}}>2030</option>
												</select>
											</div>
											<div class="col-md-6 form-group">
												<label><span class="red_required">*</span>CVV</label>
												<input type="number" name="cvv" value="{{(isset($data->cvv) ? $data->cvv : '')}}" class="form-control" placeholder="123" max="999">
											</div>
											<!-- <div class="col-md-12 text-right mt-4">
												<button type="button" class="btn btn-orange btn-wide">Proceed to secure payment</button>
											</div> -->
											<div class="col-md-12 text-right mt-4">
												<button type="submit" class="btn btn-orange btn-wide">Update</button>
											</div>
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