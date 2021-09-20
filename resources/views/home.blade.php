@extends('homeLayouts.app')

@section('content')
<!-- <div class="container">
    @if(Auth::id())
    <p>You have successfully login.</p>
    @else
    <p>You have not login. Please try again</p>
    @endif
</div> -->
<section>
	<div class="container">
		<div class="bg-gray p-3 px-xl-0 py-md-5">
			<h5 class="text-center fw-500 text-primary">Create your profile and customize your platform.</h5>
			<h5 class="text-center fw-500 mb-3 text-secondary">Who is this profile for?</h5>
			<div class="create-profile mb-lg-5">
				<a href="{{url('/role/1')}}">Physician/ Provider</a>
				<a href="{{url('/role/2')}}">Patients & Volunteers</a>
				<a href="{{url('/role/3')}}">Family & Friends of patients</a>
				<a href="{{url('/role/4')}}">Sponsors</a>
				<a href="{{url('/role/5')}}">Principal Investigators</a>
			</div>
		</div>
	</div>
</section>
@endsection
