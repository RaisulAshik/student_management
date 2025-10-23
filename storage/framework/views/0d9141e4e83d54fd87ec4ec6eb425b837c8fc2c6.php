

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/jquery-datatables-bs3/assets/css/datatables.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <header class="page-header">
						<h2>Offline Student Payments</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Offline Student Payments</span></li>
							</ol>
					    </div>
					</header>

					<?php echo $__env->make('admin.layout.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

					<section class="panel">
							<header class="panel-heading">
								
						
								<h2 class="panel-title">Offline Student Payments List</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Class</th>
											<th>Batch</th>
											<th>Branch</th>
											<th>Total Amount</th>
											<th>Paid Amount</th>
											<th>Due Amount</th>
											<th>Last Payment Date</th>
											<th>Transaction Id</th>
											<th>Action</th>
                                        </tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="gradeX">
											<td><?php echo e($payment->classname->name); ?></td>
											<td><?php echo e($payment->batch->name); ?></td>
											<td><?php echo e($payment->branch->name); ?></td>
											<td><?php echo e($payment->total_amount); ?></td>
											<td><?php echo e($payment->paid_amount); ?></td>
											<td><?php echo e($payment->due_amount); ?></td>
											<td><?php echo e($payment->payment_date); ?></td>
											<td><?php echo e($payment->transaction_id); ?></td>
											<td>
												<a href="<?php echo e(route('admin.offline_payment_installments',$payment->id)); ?>" class="mb-xs mt-xs mr-xs btn btn-sm btn-primary" >View Installment</a>

												<a href="<?php echo e(route('admin.add_offline_payment_installment',$payment->id)); ?>" class="mb-xs mt-xs mr-xs btn btn-sm btn-primary" >Add Installment</a>

												<a href="<?php echo e(route('admin.offline_payment_invoice',$payment->id)); ?>" class="mb-xs mt-xs mr-xs btn btn-sm btn-primary" >Invoice</a>
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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\student_management\resources\views/admin/offline/offlinePayment.blade.php ENDPATH**/ ?>