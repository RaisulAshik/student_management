

<?php $__env->startSection('content'); ?>
   <header class="page-header">
						<h2>Dashboard</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Dashboard</span></li>
							</ol>
					    </div>
					</header>

						<div class="row">

					<!-- start: page -->
					<div class="row">
						
						<div class="col-md-6 col-lg-12 col-xl-6">
							<div class="row">
								<div class="col-md-12 col-lg-4 col-xl-4">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">No of students</h4>
														<div class="info">
															<strong class="amount"><?php echo e($student); ?></strong>
														</div>
													</div>
													<div class="summary-footer">
														<a class="text-muted text-uppercase" href="<?php echo e(url('admin/students')); ?>">(view all)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-12 col-lg-4 col-xl-4">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-success">
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">No of admins</h4>
														<div class="info">
															<strong class="amount"><?php echo e($admin); ?></strong>
														</div>
													</div>
													<div class="summary-footer">
														<a class="text-muted text-uppercase" href="<?php echo e(url('admin/admins')); ?>">(view all)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-12 col-lg-4 col-xl-4">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-danger">
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">No of teachers</h4>
														<div class="info">
															<strong class="amount"><?php echo e($teacher); ?></strong>
														</div>
													</div>
													<div class="summary-footer">
														<a class="text-muted text-uppercase" href="<?php echo e(url('admin/teachers')); ?>">(view all)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>

								<div class="col-md-12 col-lg-4 col-xl-4">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-danger">
														<i class="fa fa-money"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Monthly Fee Collection</h4>
														<div class="info">
															<strong class="amount">৳ <?php echo e($online_payment+$offline_payment); ?></strong>
														</div>
													</div>
													<div class="summary-footer">
														<a class="text-muted text-uppercase" href="<?php echo e(url('admin/student_payments')); ?>">(view all)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-12 col-lg-4 col-xl-4">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-danger">
														<i class="fa fa-credit-card"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Monthly Expenses</h4>
														<div class="info">
															<strong class="amount">৳ <?php echo e($expense_month); ?></strong>
														</div>
													</div>
													<div class="summary-footer">
														<a class="text-muted text-uppercase" href="<?php echo e(url('admin/expenses')); ?>">(view all)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
						</div>
					</div>

					<!-- end: page -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/codegigz/public_html/student_management/resources/views/admin/dashboard/dashboard.blade.php ENDPATH**/ ?>