

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/jquery-datatables-bs3/assets/css/datatables.css')); ?>" />



<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
   <header class="page-header">
						<h2>Exam List</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Exam List</span></li>
							</ol>
					    </div>
					</header>

					<section class="panel">
							<header class="panel-heading">
						        <h2 class="panel-title">Search Filter</h2>
							</header>
							<div class="panel-body">
                                <form method="get" action="<?php echo e(action('AdminExamController@individual_std_exam_result_search',request()->id)); ?>">
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
									
								</div>
						
								<h2 class="panel-title">Result List</h2>
							</header>
							
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Exam Name</th>
											<th>Obtained Marks</th>
											<th>Highest Marks</th>
											<th>Total Marks</th>
											<th>Satisfactory Marks</th>
											<th>Merit Position</th>
										    
									</thead>
										</tr>
									<tbody>

										<?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="gradeX">
											<td><?php echo e($result->exam_name); ?></td>
											<td><?php echo e($result->obtained_marks); ?></td>
											<td><?php echo e($result->height_marks); ?></td>
											<td><?php echo e($result->total_marks); ?></td>
											<td><?php echo e($result->satisfactory_mark); ?></td>
											<td><?php echo e($result->merit_position); ?></td>
												
											
										
											
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

<script type="text/javascript">
	$('.status').on('change', function(e){
      $(this).closest('form').submit();
      
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/codegigz/public_html/student_management/resources/views/admin/exam/studentResultList.blade.php ENDPATH**/ ?>