

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/jquery-datatables-bs3/assets/css/datatables.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <header class="page-header">
						<h2>Teachers</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Teacher</span></li>
							</ol>
					    </div>
					</header>

					<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
								<a class="" href="<?php echo e(action('TeacherController@create')); ?>"><i class="fa fa-plus"></i> Add
								</a>
								</div>
						
								<h2 class="panel-title">Teachers List</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Name</th>
											<th>Email</th>
											<th>Subjects</th>
											<th>Total Amount</th>
											<th>Actual Amount</th>
											<th>Paid Amount</th>
											<th>Due Students</th>
											<th>Action</th>

										    
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="gradeX">
											<td><?php echo e($teacher->name); ?></td>
											<td><?php echo e($teacher->email); ?></td>
											<td>
											    <?php $__currentLoopData = $teacher->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											        <?php echo e($subject->name); ?> <br>
											    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</td>
											<td><?php echo e($teacher->expectedAmount); ?></td>
											<td><?php echo e(floor($teacher->afterDiscountAmount)); ?></td>
											<td><?php echo e(floor($teacher->totalPaid)); ?></td>
											<td><?php echo e(floor($teacher->dueAmount)); ?></td>
											<td>
												<a href="<?php echo e(route('teachers.edit',$teacher->id)); ?>" class="mb-xs mt-xs mr-xs btn btn-primary" >Edit</a>
												<a href="<?php echo e(route('teachers.paymentInstallmentList',$teacher->id)); ?>" class="mb-xs mt-xs mr-xs btn btn-primary" >Payments</a>
												

												<form method="post" action="<?php echo e(route('teachers.destroy',$teacher->id)); ?>"  style="display: inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('delete'); ?>
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete')">Delete</button>
                                                </form>
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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\student_management\resources\views/admin/teacher/teacherList.blade.php ENDPATH**/ ?>