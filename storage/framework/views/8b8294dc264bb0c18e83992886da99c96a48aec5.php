

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/jquery-datatables-bs3/assets/css/datatables.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <header class="page-header">
						<h2>Batches</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Batches</span></li>
							</ol>
					    </div>
					</header>

					<?php echo $__env->make('admin.layout.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

					<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
								<a class="" href="<?php echo e(action('BatchController@create')); ?>"><i class="fa fa-plus"></i> Add
								</a>
								</div>
						
								<h2 class="panel-title">Batches List</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Name</th>
											<th>Class</th>
											<th>Branch</th>
											<th>Time</th>
											<th>Max. Student</th>
											<th>No. of student</th>
											<th>Batch Type</th>
											<th>Status</th>
											<th>Action</th>
                                        </tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="gradeX">
											<td><?php echo e($batch->name); ?></td>
											<td><?php echo e($batch->classname->name); ?></td>
											<td><?php echo e($batch->branch->name); ?></td>
											<td><?php echo e($batch->time); ?></td>
											<td><?php echo e($batch->max_student_number); ?></td>
											<td>
												<?php
												   $number_of_students=App\User::where('batch_id',$batch->id)->count();
												?>
												<?php echo e($number_of_students); ?>

											</td>
											<td>
												<?php if($batch->student_type == 0): ?>
												  Offline
												<?php elseif($batch->student_type == 1): ?>
												  Online
												<?php endif; ?>
											</td>
											<td>
												<?php if($batch->status == 0): ?>
												  Inactive
												<?php elseif($batch->status == 1): ?>
												  Active
												<?php endif; ?>
											</td>

											<td>
												<a href="<?php echo e(route('batches.edit',$batch->id)); ?>" class="mb-xs mt-xs mr-xs btn btn-primary" >Edit</a>

												
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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\student_management\resources\views/admin/batch/batchList.blade.php ENDPATH**/ ?>