<!DOCTYPE html>
<html class="fixed">
	<head>
        
        @php
           $company=App\CompanyDetail::first();
        @endphp
		
		<meta charset="UTF-8">
        <meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
		<meta name="author" content="JSOFT.net">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
         @if($company)
        <title>{{$company->name}}</title>
		@else
		<title>Student Management System</title>
		@endif
		@if($company)
         <link rel="icon" href="{{asset('company/'.$company->favicon)}}" >
		 @else
		 <link rel="icon" href="{{asset('assets/backend/images/favicon.png')}}" >
		 @endif
		
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{asset('assets/backend/vendor/bootstrap/css/bootstrap.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/backend/vendor/font-awesome/css/font-awesome.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/backend/vendor/magnific-popup/magnific-popup.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/backend/vendor/bootstrap-datepicker/css/datepicker3.css')}}" />


         @yield('custom-css')

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="{{asset('assets/backend/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/backend/vendor/bootstrap-multiselect/bootstrap-multiselect.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/backend/vendor/morris/morris.css')}}" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{asset('assets/backend/stylesheets/theme.css')}}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{asset('assets/backend/stylesheets/skins/default.css')}}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{asset('assets/backend/stylesheets/theme-custom.css')}}">

		<!-- Head Libs -->
		<script src="{{asset('assets/backend/vendor/modernizr/modernizr.js')}}"></script>
		

		

	</head>

	<body>

		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					@if(Request::is('admin*'))
						<a href="{{route('admin.dashboard')}}" class="logo">
							@if($company)
								<img src="{{asset('company/'.$company->logo)}}" height="40" alt="JSOFT Admin" />
							@else
								<img src="{{asset('assets/backend/images/logo.png')}}" height="40" alt="JSOFT Admin" />
							@endif
						</a>
					@elseif(Request::is('teacher*'))
					    <a href="{{route('teacher.dashboard')}}" class="logo">
							@if($company)
								<img src="{{asset('company/'.$company->logo)}}" height="40" alt="JSOFT Admin" />
							@else
								<img src="{{asset('assets/backend/images/logo.png')}}" height="40" alt="JSOFT Admin" />
							@endif
						</a>
					@endif
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			        
			        <span class="separator"></span>

			        @php
			        $admin=Auth::guard('admin')->user(); 
			        @endphp
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="{{asset('assets/backend/images/!logged-user.jpg')}}" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
								<span class="name">{{$admin->name}}</span>
								<span class="role">{{$admin->role->name}}</span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								@if(Request::is('admin*'))
									<li>
									<a role="menuitem" tabindex="-1" href="{{ route('admin.profile') }}"><i class="fa fa-user"></i> My Profile</a>
									</li>
									
									<li>
										<a role="menuitem" tabindex="-1" href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i> Logout</a>
									</li>
								@elseif(Request::is('teacher*'))
								    <li>
									<a role="menuitem" tabindex="-1" href="{{ route('teacher.profile') }}"><i class="fa fa-user"></i> My Profile</a>
									</li>
									
									<li>
										<a role="menuitem" tabindex="-1" href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i> Logout</a>
									</li>
								@endif
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>

					@if(Request::is('admin*'))
					@php
						$admin = auth()->guard('admin')->user();
					@endphp
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<!-- Dashboard -->
									@if($admin->hasPermissionTo('view-dashboard', 'admin'))
									<li class="nav-active">
										<a href="{{route('admin.dashboard')}}">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									@endif
									<!-- Student Homework -->
									@if($admin->hasPermissionTo('view-homework', 'admin'))
									<li class="nav-active">
										<a href="{{route('admin.homework')}}">
											<i class="fa fa-tasks" aria-hidden="true"></i>
											<span>Student Homework</span>
										</a>
									</li>
									@endif
									@if($admin->hasPermissionTo('manage-zoom-classes', 'admin'))
									<li class="nav-parent">
										<a>
											<i class="fa fa-video-camera" aria-hidden="true"></i>
											<span>Live Classes</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="{{route('admin.zoom')}}">
													 Zoom Class
												</a>
											</li>
										</ul>
									</li>
									@endif
									@if($admin->hasPermissionTo('view-admins', 'admin') || 
										$admin->hasPermissionTo('view-students', 'admin') || 
										$admin->hasPermissionTo('view-teachers', 'admin'))
									<li class="nav-parent">
										<a>
											<i class="fa fa-users" aria-hidden="true"></i>
											<span>Users</span>
										</a>
										<ul class="nav nav-children">
											@if($admin->hasPermissionTo('view-admins', 'admin'))
											<li>
												<a href="{{route('admins.index')}}">
													 Admin
												</a>
											</li>
											@endif
											@if($admin->hasPermissionTo('view-students', 'admin'))
											<li>
												<a href="{{route('admin.students')}}">
													 Student
												</a>
											</li>
											@endif
											@if($admin->hasPermissionTo('view-teachers', 'admin'))
											<li>
												<a href="{{route('teachers.index')}}">
													 Teacher
												</a>
											</li>
											@endif
										</ul>
									</li>
									@endif
									@if($admin->hasPermissionTo('manage-branches', 'admin') || 
										$admin->hasPermissionTo('manage-classes', 'admin') || 
										$admin->hasPermissionTo('manage-subjects', 'admin') || 
										$admin->hasPermissionTo('manage-batches', 'admin'))
									<li class="nav-parent">
										<a>
											<i class="fa fa-university" aria-hidden="true"></i>
											<span>Academics</span>
										</a>
										@if($admin->hasPermissionTo('manage-branches', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('branches.index')}}">
													 Branch
												</a>
											</li>
										</ul>
										@endif
										@if($admin->hasPermissionTo('manage-classes', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('classes.index')}}">
													 Class
												</a>
											</li>
										</ul>
										@endif
										@if($admin->hasPermissionTo('manage-subjects', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('subjects.index')}}">
													 Subjects
												</a>
											</li>
										</ul>
										@endif
										@if($admin->hasPermissionTo('manage-batches', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('batches.index')}}">
													 Batches
												</a>
											</li>
										</ul>
										@endif
										@if($admin->hasPermissionTo('manage-batches', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('admin.activeBatch')}}">
													 Active Batches
												</a>
											</li>
										</ul>
										@endif
									</li>
									@endif
									@if($admin->hasPermissionTo('manage-mcq-exams', 'admin') || $admin->hasPermissionTo('view-mcq-results', 'admin'))
									<li class="nav-parent">
										<a>
											<i class="fa fa-pencil" aria-hidden="true"></i>
											<span>MCQ Exam</span>
										</a>
										@if($admin->hasPermissionTo('manage-mcq-exams', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('admin.mcqExamList')}}">
													 MCQ Exam
												</a>
											</li>
										</ul>
										@endif
										@if($admin->hasPermissionTo('view-mcq-results', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('admin.mcqExamResult')}}">
													 MCQ Exam Result
												</a>
											</li>
										</ul>
										@endif
									</li>
									@endif
									@if($admin->hasPermissionTo('manage-cq-exams', 'admin') || $admin->hasPermissionTo('view-cq-results', 'admin'))
									<li class="nav-parent">
										<a>
											<i class="fa fa-book" aria-hidden="true"></i>
											<span>CQ Exam</span>
										</a>
										@if($admin->hasPermissionTo('manage-cq-exams', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('admin.cqExamList')}}">
													 CQ Exam
												</a>
											</li>
										</ul>
										@endif
										@if($admin->hasPermissionTo('view-cq-results', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('admin.cqExamResult')}}">
													 CQ Exam Result
												</a>
											</li>
										</ul>
										@endif
									</li>
									@endif
									@if($admin->hasPermissionTo('view-mcq-results', 'admin'))
									<li class="nav-parent">
										<a>
											<i class="fa fa-pencil" aria-hidden="true"></i>
											<span>Exam Result Upload & SMS</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="{{route('admin.examList')}}">
													 Exam List
												</a>
											</li>
										</ul>
									</li>
									@endif

									<!-- Payment -->
									 @if($admin->hasPermissionTo('view-payments', 'admin'))
									<li class="nav-parent">
										<a>
											<i class="fa fa-money" aria-hidden="true"></i>
											<span>Payment</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="{{route('admin.student_payments')}}">
													 Payment List
												</a>
											</li>
										</ul>
									</li>
									@endif
									<!-- Online Students -->
									 @if($admin->hasPermissionTo('view-online-students', 'admin') || $admin->hasPermissionTo('approve-online-payments', 'admin'))
									<li class="nav-parent">
										<a>
											<i class="fa fa-user" aria-hidden="true"></i>
											<span>Online Students</span>
										</a>
										@if($admin->hasPermissionTo('view-online-students', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('admin.online_students')}}">
													 Students
												</a>
											</li>
										</ul>
										@endif
										@if($admin->hasPermissionTo('view-payments', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('admin.online_pending_payments')}}">
													 Pending Payments
												</a>
											</li>
										</ul>
										<ul class="nav nav-children">
											<li>
												<a href="{{route('admin.online_approved_payments')}}">
													 Approved Payments
												</a>
											</li>
										</ul>
										@endif
									</li>
									@endif

									<!-- Offline Students -->
									 @if($admin->hasPermissionTo('view-offline-students', 'admin') || $admin->hasPermissionTo('manage-offline-payments', 'admin'))
									<li class="nav-parent">
										<a>
											<i class="fa fa-user" aria-hidden="true"></i>
											<span>Offline Students</span>
										</a>
										@if($admin->hasPermissionTo('view-offline-students', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('admin.offline_students')}}">
													 Students
												</a>
											</li>
										</ul>
										@endif
										@if($admin->hasPermissionTo('manage-offline-payments', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('admin.offline_payment_list')}}">
													 Student Payments
												</a>
											</li>
										</ul>
										@endif
									</li>
									@endif
									@if($admin->hasPermissionTo('manage-contents', 'admin') || 
										$admin->hasPermissionTo('manage-lecture-sheets', 'admin'))
									<li class="nav-parent">
										<a>
											<i class="fa fa-upload" aria-hidden="true"></i>
											<span>Uplaod Center</span>
										</a>
										@if($admin->hasPermissionTo('manage-contents', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('contents.index')}}">
													Upload Content
												</a>
											</li>
										</ul>
										@endif
										@if($admin->hasPermissionTo('manage-lecture-sheets', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('lecture_sheets.index')}}">
													 Upload Lecture Sheet
												</a>
											</li>
										</ul>
										@endif
									</li>
									@endif

									@if($admin->hasPermissionTo('view-expenses', 'admin') || 
										$admin->hasPermissionTo('manage-expense-categories', 'admin'))
									<li class="nav-parent">
										<a>
											<i class="fa fa-credit-card"></i>
											<span>Accounting</span>
										</a>
										<ul class="nav nav-children">
											@if($admin->hasPermissionTo('view-expenses', 'admin'))
											<li>
												<a href="{{route('expenses.index')}}">
													Expense
												</a>
											</li>
											@endif
											@if($admin->hasPermissionTo('manage-expense-categories', 'admin'))
											<li>
												<a href="{{route('expenseCategory.index')}}">
													Expense Group
												</a>
											</li>
											@endif
										</ul>
									</li>
									@endif

									@if($admin->hasPermissionTo('send-messages', 'admin') || 
										$admin->hasPermissionTo('send-sms', 'admin') || 
										$admin->hasPermissionTo('send-due-sms', 'admin'))
									<li class="nav-parent">
										<a>
											<i class="fa fa-paper-plane" aria-hidden="true"></i>
											<span>Communication</span>
										</a>
										@if($admin->hasPermissionTo('send-messages', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('messages.index')}}">
													Message
												</a>
											</li>
										</ul>
										@endif	
										@if($admin->hasPermissionTo('send-sms', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('sms.index')}}">
													SMS
												</a>
											</li>
										</ul>
										@endif
										@if($admin->hasPermissionTo('send-due-sms', 'admin'))
										<ul class="nav nav-children">
											<li>
												<a href="{{route('dueSms.index')}}">
													Due SMS
												</a>
											</li>
										</ul>
										@endif
									</li>
									@endif

									<!-- Setting -->
									@if($admin->hasPermissionTo('manage-company-details', 'admin') || 
										$admin->hasPermissionTo('manage-zoom-api', 'admin') || 
										$admin->hasPermissionTo('manage-instructions', 'admin') || 
										$admin->hasPermissionTo('manage-contents', 'admin') || 
										$admin->hasPermissionTo('manage-roles', 'admin'))
									<li class="nav-parent">
										<a>
											<i class="fa fa-cog" aria-hidden="true"></i>
											<span>Setting</span>
										</a>
										<ul class="nav nav-children">
											@if($admin->hasPermissionTo('manage-company-details', 'admin'))
											<li>
												<a href="{{route('admin.companyDetail')}}">
													 Comapny Info
												</a>
											</li>
											@endif
											@if($admin->hasPermissionTo('manage-zoom-api', 'admin'))
											<li>
												<a href="{{route('zoomApis.index')}}">
													 Zoom Api
												</a>
											</li>
											@endif
											@if($admin->hasPermissionTo('manage-instructions', 'admin'))
											<li>
												<a href="{{route('admin.instruction')}}">
													 Payment Instruction
												</a>
											</li>
											@endif
											@if($admin->hasPermissionTo('manage-contents', 'admin'))
											<li>
												<a href="{{route('upload_content_types.index')}}">
													 Upload Content Type
												</a>
											</li>
											@endif
											@if($admin->hasPermissionTo('manage-roles', 'admin'))
											<li>
												<a href="{{route('roles.index')}}">
													 Roles
												</a>
											</li>
											@endif
										</ul>
									</li>
									@endif
									<!-- Report -->
									 @if($admin->hasPermissionTo('view-expense-reports', 'admin'))
									<li class="nav-parent">
										<a>
											<i class="fa fa-file" aria-hidden="true"></i>
											<span>Report</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="{{route('expense.report')}}">
													Balance Report
												</a>
											</li>
										</ul>
										
									</li>
									@endif
									
								</ul>
							</nav>
										
						 </div>
					</div>
						
					@elseif(Request::is('teacher*'))

					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li class="nav-active">
										<a href="{{route('teacher.dashboard')}}">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li class="nav-active">
										<a href="{{route('teacher.homework')}}">
											<i class="fa fa-tasks" aria-hidden="true"></i>
											<span>Student Homework</span>
										</a>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-video-camera" aria-hidden="true"></i>
											<span>Live Classes</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="{{route('teacher.zoom')}}">
													 Zoom Class
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-book" aria-hidden="true"></i>
											<span>CQ Exam</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="{{route('teacher.cqExamList')}}">
													 CQ Exam
												</a>
											</li>
										</ul>
										<ul class="nav nav-children">
											<li>
												<a href="{{route('teacher.cqExamResult')}}">
													 CQ Exam Result
												</a>
											</li>
										</ul>
									</li>
									
								</ul>
							</nav>
										
						 </div>
					</div>
					   
					@endif
				
					
					
				</aside>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					@yield('content')
				</section>
			</div>

		</section>


		<!-- Vendor -->
		<script src="{{asset('assets/backend/vendor/jquery/jquery.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/bootstrap/js/bootstrap.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/nanoscroller/nanoscroller.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/magnific-popup/magnific-popup.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/jquery-placeholder/jquery.placeholder.js')}}"></script>
		
		<!-- Specific Page Vendor -->
		<script src="{{asset('assets/backend/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/jquery-appear/jquery.appear.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/jquery-easypiechart/jquery.easypiechart.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/flot/jquery.flot.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/flot-tooltip/jquery.flot.tooltip.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/flot/jquery.flot.pie.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/flot/jquery.flot.categories.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/flot/jquery.flot.resize.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/jquery-sparkline/jquery.sparkline.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/raphael/raphael.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/morris/morris.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/gauge/gauge.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/snap-svg/snap.svg.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/liquid-meter/liquid.meter.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/jqvmap/jquery.vmap.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/jqvmap/data/jquery.vmap.sampledata.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/jqvmap/maps/jquery.vmap.world.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/jqvmap/maps/continents/jquery.vmap.africa.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/jqvmap/maps/continents/jquery.vmap.asia.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/jqvmap/maps/continents/jquery.vmap.australia.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/jqvmap/maps/continents/jquery.vmap.europe.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js')}}"></script>
		<script src="{{asset('assets/backend/vendor/jquery-autosize/jquery.autosize.js')}}"></script>

        @yield('custom-js')
		
		<!-- Theme Base, Components and Settings -->
		<script src="{{asset('assets/backend/javascripts/theme.js')}}"></script>
		
		<!-- Theme Custom -->
		<script src="{{asset('assets/backend/javascripts/theme.custom.js')}}"></script>
		
		<!-- Theme Initialization Files -->
		<script src="{{asset('assets/backend/javascripts/theme.init.js')}}"></script>


		<!-- Examples -->
		<script src="{{asset('assets/backend/javascripts/dashboard/examples.dashboard.js')}}"></script>


		
		
	</body>

</html>