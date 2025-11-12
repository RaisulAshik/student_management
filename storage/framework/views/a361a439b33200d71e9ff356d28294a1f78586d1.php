<!DOCTYPE html>
<html class="fixed">
	<head>
        
        <?php
           $company=App\CompanyDetail::first();
        ?>
		
		<meta charset="UTF-8">
        <meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
		<meta name="author" content="JSOFT.net">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
         
        <title><?php echo e($company->name); ?></title>
         <link rel="icon" href="<?php echo e(asset('company/'.$company->favicon)); ?>" >
		
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/bootstrap/css/bootstrap.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/font-awesome/css/font-awesome.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/magnific-popup/magnific-popup.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/bootstrap-datepicker/css/datepicker3.css')); ?>" />


         <?php echo $__env->yieldContent('custom-css'); ?>

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/bootstrap-multiselect/bootstrap-multiselect.css')); ?>" />
		<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/morris/morris.css')); ?>" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('assets/backend/stylesheets/theme.css')); ?>" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('assets/backend/stylesheets/skins/default.css')); ?>" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('assets/backend/stylesheets/theme-custom.css')); ?>">

		<!-- Head Libs -->
		<script src="<?php echo e(asset('assets/backend/vendor/modernizr/modernizr.js')); ?>"></script>
		

		

	</head>

	<body>

		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<?php if(Request::is('admin*')): ?>
						<a href="<?php echo e(route('admin.dashboard')); ?>" class="logo">
							<img src="<?php echo e(asset('company/'.$company->logo)); ?>" height="40" alt="JSOFT Admin" />
						</a>
					<?php elseif(Request::is('teacher*')): ?>
					    <a href="<?php echo e(route('teacher.dashboard')); ?>" class="logo">
							<img src="<?php echo e(asset('company/'.$company->logo)); ?>" height="40" alt="JSOFT Admin" />
						</a>
					<?php endif; ?>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			        
			        <span class="separator"></span>

			        <?php
			        $admin=Auth::guard('admin')->user(); 
			        ?>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?php echo e(asset('assets/backend/images/!logged-user.jpg')); ?>" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
								<span class="name"><?php echo e($admin->name); ?></span>
								<span class="role"><?php echo e($admin->role->name); ?></span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<?php if(Request::is('admin*')): ?>
									<li>
									<a role="menuitem" tabindex="-1" href="<?php echo e(route('admin.profile')); ?>"><i class="fa fa-user"></i> My Profile</a>
									</li>
									
									<li>
										<a role="menuitem" tabindex="-1" href="<?php echo e(route('admin.logout')); ?>"><i class="fa fa-power-off"></i> Logout</a>
									</li>
								<?php elseif(Request::is('teacher*')): ?>
								    <li>
									<a role="menuitem" tabindex="-1" href="<?php echo e(route('teacher.profile')); ?>"><i class="fa fa-user"></i> My Profile</a>
									</li>
									
									<li>
										<a role="menuitem" tabindex="-1" href="<?php echo e(route('admin.logout')); ?>"><i class="fa fa-power-off"></i> Logout</a>
									</li>
								<?php endif; ?>
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

					<?php if(Request::is('admin*')): ?>
					<?php
						$admin = auth()->guard('admin')->user();
					?>
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<!-- Dashboard -->
									<?php if($admin->hasPermissionTo('view-dashboard', 'admin')): ?>
									<li class="nav-active">
										<a href="<?php echo e(route('admin.dashboard')); ?>">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<?php endif; ?>
									<!-- Student Homework -->
									<?php if($admin->hasPermissionTo('view-homework')): ?>
									<li class="nav-active">
										<a href="<?php echo e(route('admin.homework')); ?>">
											<i class="fa fa-tasks" aria-hidden="true"></i>
											<span>Student Homework</span>
										</a>
									</li>
									<?php endif; ?>
									<?php if($admin->hasPermissionTo('manage-zoom-classes')): ?>
									<li class="nav-parent">
										<a>
											<i class="fa fa-video-camera" aria-hidden="true"></i>
											<span>Live Classes</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('admin.zoom')); ?>">
													 Zoom Class
												</a>
											</li>
										</ul>
									</li>
									<?php endif; ?>
									<?php if($admin->hasPermissionTo('view-admins', 'admin') || 
										$admin->hasPermissionTo('view-students', 'admin') || 
										$admin->hasPermissionTo('view-teachers', 'admin')): ?>
									<li class="nav-parent">
										<a>
											<i class="fa fa-users" aria-hidden="true"></i>
											<span>Users</span>
										</a>
										<ul class="nav nav-children">
											<?php if($admin->hasPermissionTo('view-admins', 'admin')): ?>
											<li>
												<a href="<?php echo e(route('admins.index')); ?>">
													 Admin
												</a>
											</li>
											<?php endif; ?>
											<?php if($admin->hasPermissionTo('view-students', 'admin')): ?>
											<li>
												<a href="<?php echo e(route('admin.students')); ?>">
													 Student
												</a>
											</li>
											<?php endif; ?>
											<?php if($admin->hasPermissionTo('view-teachers', 'admin')): ?>
											<li>
												<a href="<?php echo e(route('teachers.index')); ?>">
													 Teacher
												</a>
											</li>
											<?php endif; ?>
										</ul>
									</li>
									<?php endif; ?>
									<?php if($admin->hasPermissionTo('manage-branches', 'admin') || 
										$admin->hasPermissionTo('manage-classes', 'admin') || 
										$admin->hasPermissionTo('manage-subjects', 'admin') || 
										$admin->hasPermissionTo('manage-batches', 'admin')): ?>
									<li class="nav-parent">
										<a>
											<i class="fa fa-university" aria-hidden="true"></i>
											<span>Academics</span>
										</a>
										<?php if($admin->hasPermissionTo('manage-branches', 'admin')): ?>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('branches.index')); ?>">
													 Branch
												</a>
											</li>
										</ul>
										<?php endif; ?>
										<?php if($admin->hasPermissionTo('manage-classes', 'admin')): ?>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('classes.index')); ?>">
													 Class
												</a>
											</li>
										</ul>
										<?php endif; ?>
										<?php if($admin->hasPermissionTo('manage-subjects', 'admin')): ?>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('subjects.index')); ?>">
													 Subjects
												</a>
											</li>
										</ul>
										<?php endif; ?>
										<?php if($admin->hasPermissionTo('manage-batches', 'admin')): ?>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('batches.index')); ?>">
													 Batches
												</a>
											</li>
										</ul>
										<?php endif; ?>
										<?php if($admin->hasPermissionTo('manage-batches', 'admin')): ?>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('admin.activeBatch')); ?>">
													 Active Batches
												</a>
											</li>
										</ul>
										<?php endif; ?>
									</li>
									<?php endif; ?>
									<?php if($admin->hasPermissionTo('manage-mcq-exams', 'admin')): ?>
									<li class="nav-parent">
										<a>
											<i class="fa fa-pencil" aria-hidden="true"></i>
											<span>MCQ Exam</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('admin.mcqExamList')); ?>">
													 MCQ Exam
												</a>
											</li>
										</ul>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('admin.mcqExamResult')); ?>">
													 MCQ Exam Result
												</a>
											</li>
										</ul>
									</li>
									<?php endif; ?>
									<?php if($admin->hasPermissionTo('manage-cq-exams', 'admin')): ?>
									<li class="nav-parent">
										<a>
											<i class="fa fa-book" aria-hidden="true"></i>
											<span>CQ Exam</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('admin.cqExamList')); ?>">
													 CQ Exam
												</a>
											</li>
										</ul>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('admin.cqExamResult')); ?>">
													 CQ Exam Result
												</a>
											</li>
										</ul>
									</li>
									<?php endif; ?>
									<?php if($admin->hasPermissionTo('view-mcq-results', 'admin')): ?>
									<li class="nav-parent">
										<a>
											<i class="fa fa-pencil" aria-hidden="true"></i>
											<span>Exam Result Upload & SMS</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('admin.examList')); ?>">
													 Exam List
												</a>
											</li>
										</ul>
									</li>
									<?php endif; ?>

									<!-- Payment -->
									 <?php if($admin->hasPermissionTo('view-payments', 'admin')): ?>
									<li class="nav-parent">
										<a>
											<i class="fa fa-money" aria-hidden="true"></i>
											<span>Payment</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('admin.student_payments')); ?>">
													 Payment List
												</a>
											</li>
										</ul>
									</li>
									<?php endif; ?>
									<!-- Online Students -->
									 <?php if($admin->hasPermissionTo('view-online-students', 'admin') || $admin->hasPermissionTo('approve-online-payments', 'admin')): ?>
									<li class="nav-parent">
										<a>
											<i class="fa fa-user" aria-hidden="true"></i>
											<span>Online Students</span>
										</a>
										<?php if($admin->hasPermissionTo('view-online-students', 'admin')): ?>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('admin.online_students')); ?>">
													 Students
												</a>
											</li>
										</ul>
										<?php endif; ?>
										<?php if($admin->hasPermissionTo('view-payments', 'admin')): ?>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('admin.online_pending_payments')); ?>">
													 Pending Payments
												</a>
											</li>
										</ul>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('admin.online_approved_payments')); ?>">
													 Approved Payments
												</a>
											</li>
										</ul>
										<?php endif; ?>
									</li>
									<?php endif; ?>

									<!-- Offline Students -->
									 <?php if($admin->hasPermissionTo('view-offline-students', 'admin') || $admin->hasPermissionTo('manage-offline-payments', 'admin')): ?>
									<li class="nav-parent">
										<a>
											<i class="fa fa-user" aria-hidden="true"></i>
											<span>Offline Students</span>
										</a>
										<?php if($admin->hasPermissionTo('view-offline-students', 'admin')): ?>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('admin.offline_students')); ?>">
													 Students
												</a>
											</li>
										</ul>
										<?php endif; ?>
										<?php if($admin->hasPermissionTo('manage-offline-payments', 'admin')): ?>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('admin.offline_payment_list')); ?>">
													 Student Payments
												</a>
											</li>
										</ul>
										<?php endif; ?>
									</li>
									<?php endif; ?>
									<?php if($admin->hasPermissionTo('manage-contents', 'admin') || 
										$admin->hasPermissionTo('manage-lecture-sheets', 'admin')): ?>
									<li class="nav-parent">
										<a>
											<i class="fa fa-upload" aria-hidden="true"></i>
											<span>Uplaod Center</span>
										</a>
										<?php if($admin->hasPermissionTo('manage-contents', 'admin')): ?>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('contents.index')); ?>">
													Upload Content
												</a>
											</li>
										</ul>
										<?php endif; ?>
										<?php if($admin->hasPermissionTo('manage-lecture-sheets', 'admin')): ?>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('lecture_sheets.index')); ?>">
													 Upload Lecture Sheet
												</a>
											</li>
										</ul>
										<?php endif; ?>
									</li>
									<?php endif; ?>

									<?php if($admin->hasPermissionTo('view-expenses', 'admin') || 
										$admin->hasPermissionTo('manage-expense-categories', 'admin')): ?>
									<li class="nav-parent">
										<a>
											<i class="fa fa-credit-card"></i>
											<span>Accounting</span>
										</a>
										<ul class="nav nav-children">
											<?php if($admin->hasPermissionTo('view-expenses', 'admin')): ?>
											<li>
												<a href="<?php echo e(route('expenses.index')); ?>">
													Expense
												</a>
											</li>
											<?php endif; ?>
											<?php if($admin->hasPermissionTo('manage-expense-categories', 'admin')): ?>
											<li>
												<a href="<?php echo e(route('expenseCategory.index')); ?>">
													Expense Group
												</a>
											</li>
											<?php endif; ?>
										</ul>
									</li>
									<?php endif; ?>

									<?php if($admin->hasPermissionTo('send-messages', 'admin') || 
										$admin->hasPermissionTo('send-sms', 'admin') || 
										$admin->hasPermissionTo('send-due-sms', 'admin')): ?>
									<li class="nav-parent">
										<a>
											<i class="fa fa-paper-plane" aria-hidden="true"></i>
											<span>Communication</span>
										</a>
										<?php if($admin->hasPermissionTo('send-messages', 'admin')): ?>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('messages.index')); ?>">
													Message
												</a>
											</li>
										</ul>
										<?php endif; ?>	
										<?php if($admin->hasPermissionTo('send-sms', 'admin')): ?>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('sms.index')); ?>">
													SMS
												</a>
											</li>
										</ul>
										<?php endif; ?>
										<?php if($admin->hasPermissionTo('send-due-sms', 'admin')): ?>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('dueSms.index')); ?>">
													Due SMS
												</a>
											</li>
										</ul>
										<?php endif; ?>
									</li>
									<?php endif; ?>

									<!-- Setting -->
									<?php if($admin->hasPermissionTo('manage-company-details', 'admin') || 
										$admin->hasPermissionTo('manage-zoom-api', 'admin') || 
										$admin->hasPermissionTo('manage-instructions', 'admin') || 
										$admin->hasPermissionTo('manage-contents', 'admin') || 
										$admin->hasPermissionTo('manage-roles', 'admin')): ?>
									<li class="nav-parent">
										<a>
											<i class="fa fa-cog" aria-hidden="true"></i>
											<span>Setting</span>
										</a>
										<ul class="nav nav-children">
											<?php if($admin->hasPermissionTo('manage-company-details', 'admin')): ?>
											<li>
												<a href="<?php echo e(route('admin.companyDetail')); ?>">
													 Comapny Info
												</a>
											</li>
											<?php endif; ?>
											<?php if($admin->hasPermissionTo('manage-zoom-api', 'admin')): ?>
											<li>
												<a href="<?php echo e(route('zoomApis.index')); ?>">
													 Zoom Api
												</a>
											</li>
											<?php endif; ?>
											<?php if($admin->hasPermissionTo('manage-instructions', 'admin')): ?>
											<li>
												<a href="<?php echo e(route('admin.instruction')); ?>">
													 Payment Instruction
												</a>
											</li>
											<?php endif; ?>
											<?php if($admin->hasPermissionTo('manage-contents', 'admin')): ?>
											<li>
												<a href="<?php echo e(route('upload_content_types.index')); ?>">
													 Upload Content Type
												</a>
											</li>
											<?php endif; ?>
											<?php if($admin->hasPermissionTo('manage-roles', 'admin')): ?>
											<li>
												<a href="<?php echo e(route('roles.index')); ?>">
													 Roles
												</a>
											</li>
											<?php endif; ?>
										</ul>
									</li>
									<?php endif; ?>
									<!-- Report -->
									 <?php if($admin->hasPermissionTo('view-expense-reports', 'admin')): ?>
									<li class="nav-parent">
										<a>
											<i class="fa fa-file" aria-hidden="true"></i>
											<span>Report</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('expense.report')); ?>">
													Balance Report
												</a>
											</li>
										</ul>
										
									</li>
									<?php endif; ?>
									
								</ul>
							</nav>
										
						 </div>
					</div>
						
					<?php elseif(Request::is('teacher*')): ?>

					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li class="nav-active">
										<a href="<?php echo e(route('teacher.dashboard')); ?>">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li class="nav-active">
										<a href="<?php echo e(route('teacher.homework')); ?>">
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
												<a href="<?php echo e(route('teacher.zoom')); ?>">
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
												<a href="<?php echo e(route('teacher.cqExamList')); ?>">
													 CQ Exam
												</a>
											</li>
										</ul>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo e(route('teacher.cqExamResult')); ?>">
													 CQ Exam Result
												</a>
											</li>
										</ul>
									</li>
									
								</ul>
							</nav>
										
						 </div>
					</div>
					   
					<?php endif; ?>
				
					
					
				</aside>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<?php echo $__env->yieldContent('content'); ?>
				</section>
			</div>

		</section>


		<!-- Vendor -->
		<script src="<?php echo e(asset('assets/backend/vendor/jquery/jquery.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/jquery-browser-mobile/jquery.browser.mobile.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/bootstrap/js/bootstrap.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/nanoscroller/nanoscroller.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/magnific-popup/magnific-popup.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/jquery-placeholder/jquery.placeholder.js')); ?>"></script>
		
		<!-- Specific Page Vendor -->
		<script src="<?php echo e(asset('assets/backend/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/jquery-appear/jquery.appear.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/bootstrap-multiselect/bootstrap-multiselect.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/jquery-easypiechart/jquery.easypiechart.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/flot/jquery.flot.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/flot-tooltip/jquery.flot.tooltip.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/flot/jquery.flot.pie.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/flot/jquery.flot.categories.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/flot/jquery.flot.resize.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/jquery-sparkline/jquery.sparkline.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/raphael/raphael.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/morris/morris.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/gauge/gauge.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/snap-svg/snap.svg.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/liquid-meter/liquid.meter.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/jqvmap/jquery.vmap.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/jqvmap/data/jquery.vmap.sampledata.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/jqvmap/maps/jquery.vmap.world.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/jqvmap/maps/continents/jquery.vmap.africa.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/jqvmap/maps/continents/jquery.vmap.asia.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/jqvmap/maps/continents/jquery.vmap.australia.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/jqvmap/maps/continents/jquery.vmap.europe.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/backend/vendor/jquery-autosize/jquery.autosize.js')); ?>"></script>

        <?php echo $__env->yieldContent('custom-js'); ?>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo e(asset('assets/backend/javascripts/theme.js')); ?>"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo e(asset('assets/backend/javascripts/theme.custom.js')); ?>"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo e(asset('assets/backend/javascripts/theme.init.js')); ?>"></script>


		<!-- Examples -->
		<script src="<?php echo e(asset('assets/backend/javascripts/dashboard/examples.dashboard.js')); ?>"></script>


		
		
	</body>

</html><?php /**PATH C:\xampp\htdocs\student_management\resources\views/admin/layout/master.blade.php ENDPATH**/ ?>