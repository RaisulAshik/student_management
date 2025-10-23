

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/jquery-datatables-bs3/assets/css/datatables.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <header class="page-header">
						<h2>Expense Group</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Expense Group</span></li>
							</ol>
					    </div>
					</header>
                    <?php echo $__env->make('admin.layout.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
								<a class="" href="<?php echo e(action('ExpenseCategoryController@create')); ?>"><i class="fa fa-plus"></i> Add
								</a>
								</div>
						
								<h2 class="panel-title">Expense Group Lists</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Name</th>
											<th>Added By</th>
											<th>Action</th>

										    
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $expensesCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="gradeX">
											<td><?php echo e($category->name); ?></td>
											<td>
												<?php echo e(($category->expense_head_id != null) ? $category->admin->name:''); ?>

											</td>
											
											<td>
												<a href="<?php echo e(route('expenseCategory.edit',$category->id)); ?>" class="mb-xs mt-xs mr-xs btn btn-primary" >Edit</a>

												
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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/codegigz/public_html/student_management/resources/views/admin/expenseCategory/expenseCategoryList.blade.php ENDPATH**/ ?>