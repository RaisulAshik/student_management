

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/jquery-datatables-bs3/assets/css/datatables.css')); ?>" />



<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <header class="page-header">
						<h2>CQ Exam List</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>CQ Exam Result</span></li>
							</ol>
					    </div>
					</header>

					<?php echo $__env->make('admin.layout.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

					<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
								
								</div>
						
								<h2 class="panel-title">CQ Exam Result</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Exam Title</th>
											<th>Branch</th>
											<th>Class</th>
											<th>Batch</th>
											<th>Subject</th>
											<th>Exam Date</th>
											<th>Exam Duration</th>
											<th>Exam Mark</th>
											<th>Solve Sheet</th>
                                            <th>Action</th>
										    
									</thead>
										</tr>
									<tbody>

										<?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="gradeX">
											<td><?php echo e($exam->name); ?></td>
											<td><?php echo e($exam->branch->name); ?></td>
											<td><?php echo e($exam->class->name); ?></td>
											<td><?php echo e($exam->batch->name); ?></td>
											<td><?php echo e($exam->subject->name); ?></td>
											<td><?php echo e($exam->exam_date); ?></td>
											<td><?php echo e($exam->total_exam_duration); ?></td>
											<td><?php echo e($exam->total_exam_marks); ?></td>
											<td>
												<a href="<?php echo e(url('/admin/solve_download')); ?>/<?php echo e($exam->solve_sheet); ?>" class="text-success" ><?php echo e($exam->solve_sheet); ?></a>
											</td>
											
												
                                           
												
											<td>
												<a class="mb-xs mt-xs mr-xs btn btn-primary btn-xs" href="<?php echo e(action('AdminCQExamController@cq_exam_result_view',$exam->id)); ?>">View Enrolled Students</a>

												<a class="mb-xs mt-xs mr-xs btn btn-primary btn-xs" href="<?php echo e(action('AdminCQExamController@add_solve_sheet',$exam->id)); ?>">Add Solve Sheet</a>
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

<script type="text/javascript">
	$('.status').on('change', function(e){
      $(this).closest('form').submit();
      
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/codegigz/public_html/student_management/resources/views/admin/cqExamResult/cqExamList.blade.php ENDPATH**/ ?>