

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/jquery-datatables-bs3/assets/css/datatables.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <header class="page-header">
						<h2>Expense</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Expense</span></li>
							</ol>
					    </div>
					</header>


					<section class="panel">
							<header class="panel-heading">
						        <h2 class="panel-title">Search Filter</h2>
							</header>
							<div class="panel-body">
                                <form method="get" action="<?php echo e(action('ExpenseController@expenseSearch')); ?>">
			                    <?php echo csrf_field(); ?>
			                        <div class="form-group">
									    <label class="col-md-2 control-label">Start Date</label>
										    <div class="col-md-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</span>
													<input type="text" name="start_date" id=""  data-plugin-datepicker class="form-control">
												</div>
											</div>
									</div>
									 <div class="form-group">
									    <label class="col-md-2 control-label">End Date</label>
										    <div class="col-md-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</span>
													<input type="text" name="end_date" id=""  data-plugin-datepicker class="form-control">
												</div>
											</div>
									</div> 

									<button type="submit" class="mb-xs mt-xs mr-xs btn btn-success">Search</button>                        
			                                                
			                    </form>
								
							</div>
						</section>



					

					<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
								
								<a class="text-success" href="<?php echo e(action('ExpenseController@create')); ?>"><i class="fa fa-plus"></i> Add
								</a>
								
								<a class="text-danger" href="<?php echo e(action('ExpenseController@expensePdf')); ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF
								</a>
								
								</div>
						
								<h2 class="panel-title">Expense List</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Name</th>
											<th>Expense Group</th>
											<th>Branch</th>
											<th>Added By</th>
											<th>Date</th>
											
											<th>Amount</th>
											<th>Action</th>

										    
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="gradeX">
											<td><?php echo e($expense->name); ?></td>
											
										    <td>
												<?php echo e(($expense->expense_category_id != null) ? $expense->expenseCategory->name:''); ?>

											</td>
											
											<td>
												<?php echo e(($expense->branch_id != null) ? $expense->branch->name:''); ?>

											</td>
											 <td>
												<?php echo e(($expense->expense_head_id != null) ? $expense->admin->name:''); ?>

											</td>
											<td><?php echo e($expense->date); ?></td>
											
											<td><?php echo e($expense->amount); ?></td>
											<td>
												<a href="<?php echo e(route('expenses.edit',$expense->id)); ?>" class="mb-xs mt-xs mr-xs btn btn-primary" >Edit</a>

												<form method="post" action="<?php echo e(route('expenses.destroy',$expense->id)); ?>"  style="display: inline">
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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/codegigz/public_html/student_management/resources/views/admin/expense/expenseList.blade.php ENDPATH**/ ?>