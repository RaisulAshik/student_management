

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/jquery-datatables-bs3/assets/css/datatables.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <header class="page-header">
						<h2>Pending Online Payments</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Pending Online Payments</span></li>
							</ol>
					    </div>
					</header>

					<?php echo $__env->make('admin.layout.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

					<section class="panel">
							<header class="panel-heading">
								
						
								<h2 class="panel-title">Pending  Online Payments List</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Student</th>
											<th>Class</th>
											<th>Batch</th>
											<th>Branch</th>
											<th>Total Amount</th>
											<th>Paid Amount</th>
											<th>Due Amount</th>
											<th>Payment Date</th>
											<th>Transaction Id</th>
											<th>Status</th>
											<th>Action</th>
                                        </tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="gradeX">
											<td><?php echo e($payment->student->first_name); ?> <?php echo e($payment->student->last_name); ?></td>
											<td><?php echo e($payment->classname->name); ?></td>
											<td><?php echo e($payment->batch->name); ?></td>
											<td><?php echo e($payment->branch->name); ?></td>
											<td><?php echo e($payment->total_amount); ?></td>
											<td><?php echo e($payment->paid_amount); ?></td>
											<td><?php echo e($payment->due_amount); ?></td>
											<td>
												<?php if($payment->payment_date == null): ?>
												 <span class="text-danger">Payment Not Verified</span>
												<?php else: ?>
												
												<?php echo e($payment->payment_date); ?>

												<?php endif; ?>
											</td>
											<td>
												<?php if($payment->transaction_id == null): ?>
												 <span class="text-danger">Student Transaction Id Not Given</span>
												<?php else: ?>
												 <?php echo e($payment->transaction_id); ?>

												<?php endif; ?>
											</td>
											<td>
												<?php if($payment->transaction_id !=null && $payment->transaction_id == $payment->admin_transaction_id): ?>
												 <span class="text-success">Payment Verified</span>
												<?php else: ?>
												 <span class="text-danger">Payment Not Verified</span>
												<?php endif; ?>
											</td>
											<td>
												<?php if($payment->transaction_id !=null): ?>
												<a href="<?php echo e(route('admin.student_online_payment_approval',$payment->id)); ?>" class="mb-xs mt-xs mr-xs btn btn-primary" >Transaction input</a>
												<?php endif; ?>
											</td>
										</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
							</div>
						</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-js'); ?>
<script src="<?php echo e(asset('assets/backend/vendor/select2/select2.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/jquery-datatables/media/js/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/jquery-datatables-bs3/assets/js/datatables.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/javascripts/tables/examples.datatables.default.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/javascripts/tables/examples.datatables.row.with.details.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/javascripts/tables/examples.datatables.tabletools.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/codegigz/public_html/student_management/resources/views/admin/payment/pendingPaymentList.blade.php ENDPATH**/ ?>