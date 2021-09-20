<main class="main">
				<div class="app-sidebar">
					<nav class="navbar">
						<ul class="navbar-nav">
							<li class="nav-item">
						        <a href="{{route('Dashboard')}}" class="nav-link">
						            <i class="material-icons-outlined nav-icon red">dashboard</i> <span class="title">Dashboard</span>
						        </a>
						    </li>
							<li class="nav-item navbar-toggle {{Helper::ActiveParent(['Dashboard.profile','Dashboard.profile.edit','Dashboard.professionalInfo','Dashboard.paymentInfo','Dashboard.paymentHistory','Dashboard.allPaymentHistory'])}}">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon blue">person</i> <span class="title">My Account</span>
						        </a>
								<ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.profile','Dashboard.profile.edit','Dashboard.professionalInfo','Dashboard.paymentInfo','Dashboard.paymentHistory','Dashboard.allPaymentHistory']) ? 'display:block' : '')}}" >
									<li class="nav-item">
										<a href="{{route('Dashboard.profile')}}" class="nav-link {{Helper::ActiveLink('Dashboard.profile')}}">User Information
										</a>
									</li>
									@if(Auth::user()->role != '6' && Auth::user()->role != '4')
										@if(Auth::user()->role == '2')
											<li class="nav-item">
												<a href="{{route('Dashboard.professionalInfo')}}" class="nav-link {{Helper::ActiveLink('Dashboard.professionalInfo')}}">Personal Information
												</a>
											</li>
										@else
											<li class="nav-item">
												<a href="{{route('Dashboard.professionalInfo')}}" class="nav-link {{Helper::ActiveLink('Dashboard.professionalInfo')}}">Professional Information
												</a>
											</li>
										@endif
									@endif
									<li class="nav-item">
										<a href="{{route('Dashboard.paymentInfo')}}" class="nav-link {{Helper::ActiveLink('Dashboard.paymentInfo')}}">Payment Information
										</a>
									</li>
									<li class="nav-item">
										<a href="{{route('Dashboard.paymentHistory')}}" class="nav-link {{Helper::ActiveLink('Dashboard.paymentHistory')}}">Payment History
										</a>
									</li>

									@if(Auth::user()->role == '6')
									<li class="nav-item">
										<a href="{{route('Dashboard.allPaymentHistory')}}" class="nav-link {{Helper::ActiveLink('Dashboard.allPaymentHistory')}}">All Users Payment History
										</a>
									</li>
									@endif
								</ul>
							</li>

							@if(Auth::user()->role == '6')
							<li class="nav-item navbar-toggle {{Helper::ActiveParent(['Dashboard.SuperAdmin.userList'])}}">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon blue">supervisor_account</i> <span class="title">Users</span>
						        </a>
								<ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.SuperAdmin.userList']) ? 'display:block' : '')}}">
									<li class="nav-item">
										<a href="{{route('Dashboard.SuperAdmin.userList')}}" class="nav-link {{Helper::ActiveLink('Dashboard.SuperAdmin.userList')}}">User List
										</a>
									</li>
								</ul>
							</li>
							@endif

							@if(Auth::user()->role == '6')
							<li class="nav-item navbar-toggle {{Helper::ActiveParent(['Dashboard.refPatient.refPatientList'])}}">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon blue">supervisor_account</i> <span class="title">Ref. patient</span>
						        </a>
								<ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.refPatient.refPatientList']) ? 'display:block' : '')}}">
									<li class="nav-item">
										<a href="{{route('Dashboard.refPatient.refPatientList')}}" class="nav-link {{Helper::ActiveLink('Dashboard.refPatient.refPatientList')}}">Patient List
										</a>
									</li>
								</ul>
							</li>
							@endif

							@if(Auth::user()->role == '6')
							<li class="nav-item navbar-toggle {{Helper::ActiveParent(['Dashboard.CCPA.SubmitCCPAList'])}}">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon blue">supervisor_account</i> <span class="title">Submit CCPA</span>
						        </a>
								<ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.CCPA.SubmitCCPAList']) ? 'display:block' : '')}}">
									<li class="nav-item">
										<a href="{{route('Dashboard.CCPA.SubmitCCPAList')}}" class="nav-link {{Helper::ActiveLink('Dashboard.CCPA.SubmitCCPAList')}}">Submit List
										</a>
									</li>
								</ul>
							</li>
							@endif

							@if(Auth::user()->role == '6')
							<li class="nav-item navbar-toggle {{Helper::ActiveParent(['Dashboard.SuperAdmin.sociallinks','Dashboard.SuperAdmin.aboutus','Dashboard.SuperAdmin.providernetwork','Dashboard.SuperAdmin.landingpage','Dashboard.SuperAdmin.contactuspage'])}}">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon blue">grading</i> <span class="title">Content Managment</span>
						        </a>
								<ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.SuperAdmin.sociallinks','Dashboard.SuperAdmin.aboutus','Dashboard.SuperAdmin.providernetwork','Dashboard.SuperAdmin.landingpage','Dashboard.SuperAdmin.contactuspage']) ? 'display:block' : '')}}">
									<li class="nav-item">
										<a href="{{route('Dashboard.SuperAdmin.landingpage')}}" class="nav-link {{Helper::ActiveLink('Dashboard.SuperAdmin.landingpage')}}">Landing Page
										</a>
									</li>
									<li class="nav-item">
										<a href="{{route('Dashboard.SuperAdmin.providernetwork')}}" class="nav-link {{Helper::ActiveLink('Dashboard.SuperAdmin.providernetwork')}}">Provider Network
										</a>
									</li>
									<li class="nav-item">
										<a href="{{route('Dashboard.SuperAdmin.sociallinks')}}" class="nav-link {{Helper::ActiveLink('Dashboard.SuperAdmin.sociallinks')}}">Social Links
										</a>
									</li>
									<li class="nav-item">
										<a href="{{route('Dashboard.SuperAdmin.aboutus')}}" class="nav-link {{Helper::ActiveLink('Dashboard.SuperAdmin.aboutus')}}">About Us
										</a>
									</li>
									<li class="nav-item">
										<a href="{{route('Dashboard.SuperAdmin.contactuspage')}}" class="nav-link {{Helper::ActiveLink('Dashboard.SuperAdmin.contactuspage')}}">Contact Us
										</a>
									</li>
								</ul>
							</li>
							@endif

							@if(Auth::user()->role == '6')
							<li class="nav-item navbar-toggle {{Helper::ActiveParent(['Dashboard.SuperAdmin.getSavedTrial'])}}">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon green">pending_actions</i> <span class="title">Clinical trial</span>
						        </a>
								<ul class="sub-menu">
									<li class="nav-item">
										<a href="{{route('Dashboard.SuperAdmin.getSavedTrial')}}" class="nav-link {{Helper::ActiveLink('Dashboard.SuperAdmin.getSavedTrial')}}">All Clinical Trial
										</a>
									</li>
								</ul>
							</li>
							@endif

							<!-- // Physician & Principal Inv. & Patient User Role -->
							@if(Auth::user()->role == '1' || Auth::user()->role == '5' || Auth::user()->role == '2')
						    <li class="nav-item navbar-toggle {{Helper::ActiveParent(['Dashboard.findclinicaltrial','Dashboard.findStudy','Dashboard.findStudyDetails','Dashboard.getSavedTrial','Dashboard.assignInv','Dashboard.assignPatient'])}}">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon green">pending_actions</i> <span class="title">Find a Clinical trial</span>
						        </a>
								<ul class="sub-menu">
									<!-- // Physician User Role -->
									@if(Auth::user()->role == '1' || Auth::user()->role == '2')
									<li class="nav-item">
										<a href="{{route('Dashboard.findclinicaltrial')}}" class="nav-link {{Helper::ActiveLink('Dashboard.findclinicaltrial')}}">Search Clinical Trial
										</a>
									</li>
									<li class="nav-item">
										<a href="{{route('Dashboard.getSavedTrial')}}" class="nav-link {{Helper::ActiveLink('Dashboard.getSavedTrial')}}">Saved Clinical Trial
										</a>
									</li>
									@endif
									<!-- // Physician & Principal Inv. & Patient User Role -->
									@if(Auth::user()->role == '1')
										<li class="nav-item">
											<a href="{{route('Dashboard.assignInv')}}" class="nav-link {{Helper::ActiveLink('Dashboard.assignInv')}}">Assigned Investigator
											</a>
										</li>
										<li class="nav-item">
											<a href="{{route('Dashboard.assignPatient')}}" class="nav-link {{Helper::ActiveLink('Dashboard.assignPatient')}}">Assigned Patient/Volunteer
											</a>
										</li>
									@elseif(Auth::user()->role == '5')
										<li class="nav-item">
											<a href="{{route('Dashboard.assignInv')}}" class="nav-link {{Helper::ActiveLink('Dashboard.assignInv')}}">Review Interest in Trial
											</a>
										</li>
										<li class="nav-item">
											<a href="{{route('Dashboard.assignPatient')}}" class="nav-link {{Helper::ActiveLink('Dashboard.assignPatient')}}">Review Patient/Volunteer
											</a>
										</li>
									@else
									<!-- When Patient login -->
										<!-- <li class="nav-item">
											<a href="{{route('Dashboard.assignPhysican')}}" class="nav-link {{Helper::ActiveLink('Dashboard.assignPhysican')}}">Assign Physican
											</a>
										</li> -->
										<li class="nav-item">
											<a href="{{route('Dashboard.patient.assignInv')}}" class="nav-link {{Helper::ActiveLink('Dashboard.patient.assignInv')}}">Assign Investigator
											</a>
										</li>
									@endif
								</ul>
						    </li>
						    @endif

						    <!-- // Physician & Principal Inv., Sponser User Role -->
							@if(Auth::user()->role == '2' || Auth::user()->role == '5' || Auth::user()->role == '6' || Auth::user()->role == '4')
						    <li class="nav-item navbar-toggle">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon teal">supervisor_account</i> <span class="title">Clinical Visits</span>
						        </a>
						        <ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.ClinicalTrialVisit','Dashboard.ClinicalScreenVisit']) ? 'display:block' : '')}}" >

						        	@if(Auth::user()->role == '1' || Auth::user()->role == '5' || Auth::user()->role == '6' || Auth::user()->role == '4')
						        	<!-- <li class="nav-item">
										<a href="{{route('Dashboard.ClinicalTrialVisit')}}" class="nav-link {{Helper::ActiveLink('Dashboard.ClinicalTrialVisit')}}">Trial Visits
										</a>
									</li> -->
									@endif

									@if(Auth::user()->role == '2' || Auth::user()->role == '5' || Auth::user()->role == '6' || Auth::user()->role == '4')
									<li class="nav-item">
										<a href="{{route('Dashboard.ClinicalScreenVisit')}}" class="nav-link {{Helper::ActiveLink('Dashboard.ClinicalScreenVisit')}}">Screen Visits
										</a>
									</li>
									@endif
								</ul>
						    </li>
						    @endif

						    <!-- // Physician & Principal Inv. User Role -->
							@if(Auth::user()->role == '1' || Auth::user()->role == '5')
						    <li class="nav-item navbar-toggle">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon purple">supervisor_account</i> <span class="title">Clinical Trial Management</span>
						        </a>
						        <ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.submitclinicaltrialpage','Dashboard.manageTrialPage', 'Dashboard.reviewApprovedPage']) ? 'display:block' : '')}}" >
						        	<!-- // Physician User Role -->
									@if(Auth::user()->role == '1')
						        	<li class="nav-item">
										<a href="{{route('Dashboard.submitclinicaltrialpage')}}" class="nav-link {{Helper::ActiveLink('Dashboard.submitclinicaltrialpage')}}">Submit Clinical Trials
										</a>
									</li>
									@endif

									<!-- <li class="nav-item">
										<a href="{{route('Dashboard.ClinicalTrialVisit')}}" class="nav-link {{Helper::ActiveLink('Dashboard.ClinicalTrialVisit')}}">Clinical Trial Visits
										</a>
									</li> -->

									<!-- // Principal Inv. User Role -->
									@if(Auth::user()->role == '5' || Auth::user()->role == '1')
									<li class="nav-item">
										<a href="{{route('Dashboard.manageTrialPage')}}" class="nav-link {{Helper::ActiveLink('Dashboard.manageTrialPage')}}">Manage Clinical Trials
										</a>
									</li>
									<li class="nav-item">
										<a href="{{route('Dashboard.reviewApprovedPage')}}" class="nav-link {{Helper::ActiveLink('Dashboard.reviewApprovedPage')}}">Review & Approve Applicants
										</a>
									</li>
									@endif
								</ul>
						    </li>
						    @endif
						   <!--  <li class="nav-item navbar-toggle">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon sky-blue">engineering</i> <span class="title">Clinical Trial Retention Management</span>
						        </a>
						    </li> -->

						    <!-- // Physician User Role -->
							@if(Auth::user()->role == '1' || Auth::user()->role == '5')
						    <li class="nav-item navbar-toggle">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon teal">people</i> <span class="title">Patient/Volunteer</span>
						        </a>
						        <ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.patientList','Dashboard.patientView','Dashboard.patientAdd']) ? 'display:block' : '')}}" >
						        	<li class="nav-item">
										<a href="{{route('Dashboard.patientAdd')}}" class="nav-link {{Helper::ActiveLink('Dashboard.patientAdd')}}">Add Patient/Volunteer
										</a>
									</li>
									<li class="nav-item">
										<a href="{{route('Dashboard.patientList')}}" class="nav-link {{Helper::ActiveLink('Dashboard.patientList')}}">Patient/Volunteer List
										</a>
									</li>
								</ul>
						    </li>
						    @endif

						    <!-- // Physician User Role -->
							@if(Auth::user()->role == '5' || Auth::user()->role == '2')
						    <li class="nav-item navbar-toggle">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon teal">people</i> <span class="title">Physician</span>
						        </a>
						        <ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.Physican.List','Dashboard.Physican.List']) ? 'display:block' : '')}}" >
									<li class="nav-item">
										<a href="{{route('Dashboard.Physican.List')}}" class="nav-link {{Helper::ActiveLink('Dashboard.Physican.List')}}">Physican List
										</a>
									</li>
								</ul>
						    </li>
						    @endif

						    @if(Auth::user()->role == '1' || Auth::user()->role == '2')
						    <li class="nav-item navbar-toggle">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon teal">people</i> <span class="title">Principal Investigator</span>
						        </a>
						        <ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.PrincipalInv.List','Dashboard.PrincipalInv.List']) ? 'display:block' : '')}}" >
									<li class="nav-item">
										<a href="{{route('Dashboard.PrincipalInv.List')}}" class="nav-link {{Helper::ActiveLink('Dashboard.PrincipalInv.List')}}">Principal Inv. List
										</a>
									</li>
								</ul>
						    </li>
						    @endif

						    @if(Auth::user()->role != '6' && Auth::user()->role != '4')
						    <li class="nav-item navbar-toggle {{Helper::ActiveParent(['Dashboard.AppointmentList','Dashboard.AppointmentListById','Dashboard.AddAppointment','Dashboard.AddAppointmentProcess','Dashboard.DeleteAppointment'])}}">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon yellow">date_range</i> <span class="title">My Appointment <br/><small>(Schedule a Video or Chat meeting)</small></span>
						        </a>
						        <ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.AppointmentList','Dashboard.AppointmentListById','Dashboard.AddAppointment','Dashboard.AddAppointmentProcess','Dashboard.DeleteAppointment']) ? 'display:block' : '')}}" >
									<li class="nav-item">
										<a href="{{route('Dashboard.AppointmentList')}}" class="nav-link {{Helper::ActiveLink('Dashboard.AppointmentList')}}">Appointment List
										</a>
										<a href="{{route('Dashboard.AddAppointment')}}" class="nav-link {{Helper::ActiveLink('Dashboard.AddAppointment')}}">Add Appointment
										</a>
									</li>
								</ul>
						    </li>
						    @endif

						    <!-- // Principal Inv. & Physician User Role -->
							@if(Auth::user()->role == '5' || Auth::user()->role == '1')
						    <!-- <li class="nav-item navbar-toggle">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon pink">date_range</i> <span class="title">Schedule Setting</span>
						        </a>
						        <ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.schedulePage']) ? 'display:block' : '')}}" >
						        	<li class="nav-item">
										<a href="{{route('Dashboard.schedulePage')}}" class="nav-link {{Helper::ActiveLink('Dashboard.schedulePage')}}">View Schedule
										</a>
									</li>
								</ul>
						    </li> -->
						    @endif

						    <!-- // Medical Monitors -->
						    @if(Auth::user()->role == '5')
						    <li class="nav-item navbar-toggle">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon orange">supervisor_account</i> <span class="title">Medical Monitors</span>
						        </a>
						        <ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.MM.getMMList','Dashboard.MM.addMM']) ? 'display:block' : '')}}" >

									@if(Auth::user()->role == '5')
									<li class="nav-item">
										<a href="{{route('Dashboard.MM.getMMList')}}" class="nav-link {{Helper::ActiveLink('Dashboard.MM.getMMList')}}">Medical Monitors List
										</a>
									</li>
									<li class="nav-item">
										<a href="{{route('Dashboard.MM.addMM')}}" class="nav-link {{Helper::ActiveLink('Dashboard.MM.addMM')}}">Invite Medical Monitors
										</a>
									</li>
									@endif
								</ul>
						    </li>
						    @endif
						    <!-- // End Medical Monitors -->

						    <!-- // Principal Inv. & Physician User Role -->
							@if(Auth::user()->role == '5' || Auth::user()->role == '1')
						    <li class="nav-item navbar-toggle">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon green">reduce_capacity</i> <span class="title">Delegate Access</span>
						        </a>
						        <ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.DeligateUser.addDeligateUser','Dashboard.DeligateUser.getUserList']) ? 'display:block' : '')}}" >
						        	<li class="nav-item">
										<a href="{{route('Dashboard.DeligateUser.addDeligateUser')}}" class="nav-link {{Helper::ActiveLink('Dashboard.DeligateUser.addDeligateUser')}}">Invite Staff
										</a>
									</li>
									<li class="nav-item">
										<a href="{{route('Dashboard.DeligateUser.getUserList')}}" class="nav-link {{Helper::ActiveLink('Dashboard.DeligateUser.getUserList')}}">List Staff
										</a>
									</li>
								</ul>
						    </li>
						    @endif

						    <!-- // Physician User Role -->
							@if(Auth::user()->role == '1' || Auth::user()->role == '5' || Auth::user()->role == '4')
						    <li class="nav-item navbar-toggle">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon teal">help_outline</i> <span class="title">FAQ</span>
						        </a>
						        <ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.Physican.askQuestion','Dashboard.Physican.addQuestion','Dashboard.Physican.addAnswerQuestion']) ? 'display:block' : '')}}" >
									<li class="nav-item">
										<a href="{{route('Dashboard.Physican.askQuestion')}}" class="nav-link {{Helper::ActiveLink('Dashboard.Physican.askQuestion')}}">Ask Question List
										</a>
										@if(Auth::user()->role == '1')
										<a href="{{route('Dashboard.Physican.addQuestion')}}" class="nav-link {{Helper::ActiveLink('Dashboard.Physican.addQuestion')}}">Add Question
										</a>
										@endif
									</li>
								</ul>
						    </li>
						    @endif

						    @if(Auth::user()->role != '6')
						    <li class="nav-item navbar-toggle">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon orange">mail</i> <span class="title">Message Center</span>
						        </a>
						        <ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.Chat.RoomList','Dashboard.Chat.Index']) ? 'display:block' : '')}}" >
						        	<li class="nav-item">
										<a href="{{route('Dashboard.Chat.RoomList')}}" class="nav-link {{Helper::ActiveLink('Dashboard.Chat.RoomList')}}">Chat Room
										</a>
									</li>
								</ul>
						    </li>
						    @endif

						    @if(Auth::user()->role != '6' && Auth::user()->role != '4')
						    <li class="nav-item navbar-toggle">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon pink">mail</i> <span class="title">Invite User</span>
						        </a>
						        <ul class="sub-menu" style="{{(Helper::ActiveParent(['Dashboard.InviteList']) ? 'display:block' : '')}}" >
						        	<li class="nav-item">
										<a href="{{route('Dashboard.InviteList')}}" class="nav-link {{Helper::ActiveLink('Dashboard.Chat.RoomList')}}">Invite List
										</a>
									</li>
								</ul>
						    </li>
						    @endif

						    @if(Auth::user()->role == '6')
						    <li class="nav-item navbar-toggle">
						        <a href="#" class="nav-link">
						            <i class="material-icons-outlined nav-icon pink">mail</i> <span class="title">News Letter</span>
						        </a>
						        <ul class="sub-menu" style="{{(Helper::ActiveParent(['superadmin.newsletter','superadmin.addNewsletter','superadmin.addNewsLetterPage']) ? 'display:block' : '')}}" >
						        	<li class="nav-item">
										<a href="{{route('superadmin.newsletter')}}" class="nav-link {{Helper::ActiveLink('superadmin.newsletter')}}">News Letter List
										</a>
									</li>
									<li class="nav-item">
										<a href="{{route('superadmin.addNewsLetterPage')}}" class="nav-link {{Helper::ActiveLink('superadmin.addNewsLetterPage')}}">Add News Letter
										</a>
									</li>
								</ul>
						    </li>
						    @endif

						    <li class="nav-item">
						        <a href="#" class="nav-link" onclick="event.preventDefault();
			                                         document.getElementById('logout-form').submit();">
						            <i class="material-icons-outlined nav-icon red">login</i> <span class="title">Logout</span>
						        </a>
						    </li>
						</ul>
					</nav>
				</div>