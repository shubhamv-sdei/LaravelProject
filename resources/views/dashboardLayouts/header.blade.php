<!DOCTYPE HTML>
<html>
	<head>
		<title> @yield('title')</title>
   		<meta charset="utf-8">
   		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Sharp|Material+Icons+Round|Material+Icons+Two+Tone" rel="stylesheet">
		<!-- Bootstrap  -->
		<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">

		<!-- Fancybox Popup -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

		<!-- Owl Carousel -->
		<link rel="stylesheet" href="{{url('assets/css/owl.carousel.min.css')}}">
		<link rel="stylesheet" href="{{url('assets/css/owl.theme.default.min.css')}}">

		<!-- Theme style  -->
		<link rel="stylesheet" href="{{url('assets/css/style.css')}}">

		<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
	</head>
	<style>
		.hide{
			display:none;
		}
		.invalid-feedback{
			display:block !important;
		}
/*		.app-sidebar nav ul li.open ul.sub-menu{
			display:block !important;
		}*/
	</style>
	<body>
		
	<div class="colorlib-loader"></div>

	<div id="page">
		<div class="dashboard-panel">
			<div class="app-header">
				<nav class="navbar navbar-expand-sm">
					<a class="navbar-brand" href="{{route('Dashboard')}}">
						<img src="{{url('assets/images/logo.png')}}">
					</a>
					<ul class="navbar-nav">
						<li class="nav-item">
					        <button class="nav-link btn sidebar-toggle">
					            <i class="material-icons-outlined mi-30">menu</i>
					        </button>
						</li>
					</ul>
				    
				    <ul class="navbar-nav ml-auto">
						<div class="nav-item dropdown notification-nav">
							<?php $notification = Helper::getNotification(); ?>
							<button type="button" class="nav-link btn" data-toggle="dropdown">
					            <i class="material-icons-outlined mi-30">notifications</i>
					            <span class="badge">{{$notification->count()}}</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								@foreach($notification as $key=>$value)
									<a class="dropdown-item" href="{{url('notification/redirect')}}/{{$value->id}}">{{$value->message}}</a>
								@endforeach
								@if(!$notification->count())
								<a class="dropdown-item" href="javascript::void(0);">Empty!</a>
								@endif
							</div>
						</div>
						<div class="nav-item dropdown user-nav">
							<button type="button" class="nav-link btn d-flex align-items-center" data-toggle="dropdown">
								@if(Auth::user()->image != "")
								<img src="{{Auth::user()->image}}">
								@else
								<img src="{{url('assets/avatar.jpg')}}">
								@endif
								<i class="material-icons-outlined mi-24">expand_more</i>
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="{{route('Dashboard.profile')}}"><i class="material-icons-outlined">person</i> Profile </a>
								<a class="dropdown-item" href="{{route('Dashboard.changePassword')}}"><i class="material-icons-outlined">settings</i> Change Password</a>
								<!-- <a class="dropdown-item" href="#"><i class="material-icons-outlined">help_outline</i> Help</a>
								<a class="dropdown-item" href="#"><i class="material-icons-outlined">lock</i> Lock</a> -->
								<a class="dropdown-item" href="{{ route('logout') }}"
			                           onclick="event.preventDefault();
			                                         document.getElementById('logout-form').submit();">
			                            <i class="material-icons-outlined">login</i>{{ __('Logout') }}</a>
			                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			                            @csrf
			                        </form>
								<!-- <a class="dropdown-item" href="#"><i class="material-icons-outlined">login</i> Log Out</a> -->
							</div>
						</div>
				    </ul>
				</nav>
			</div>