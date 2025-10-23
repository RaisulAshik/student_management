

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/jquery-datatables-bs3/assets/css/datatables.css')); ?>" />



<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <header class="page-header">
						<h2>MCQ Exam List</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>MCQ Exam List</span></li>
							</ol>
					    </div>
					</header>

					<?php echo $__env->make('admin.layout.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

					<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
								<a class="add"  href="<?php echo e(action('AdminMCQExamController@add_mcq_exam')); ?>"><i class="fa fa-plus"></i> Add
								</a>
								</div>
						
								<h2 class="panel-title">MCQ Exam List</h2>
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
											<th>Exam Time</th>
											<th>Exam Duration (min)</th>
											<th>Exam Mark</th>
											<th>Status</th>
											<th>Answer Sheet Publish</th>
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
											<td><?php echo e(date("g:i A", strtotime($exam->start_time))); ?> to <?php echo e(date("g:i A", strtotime($exam->end_time))); ?></td>
											<td><?php echo e($exam->total_exam_duration); ?></td>
											<td><?php echo e($exam->total_exam_marks); ?></td>

                                            <td>
												<form action="<?php echo e(action('AdminMCQExamController@changeStatus')); ?>" method="post">
												<?php echo csrf_field(); ?>
													<input type="hidden" name="exam_id" value="<?php echo e($exam->id); ?>">
													<select class="form-control mb-md status" name="status">
														<option value="1" <?php echo e($exam->status == 1 ? 'selected' : ''); ?>>Active</option>
														<option value="0" <?php echo e($exam->status == 0 ? 'selected' : ''); ?>>Deactive</option>
													</select>
												</form>
											</td>

											 <td>
												<form action="<?php echo e(action('AdminMCQExamController@changeResultPublishStatus')); ?>" method="post">
												<?php echo csrf_field(); ?>
													<input type="hidden" name="exam_id" value="<?php echo e($exam->id); ?>">
													<select class="form-control mb-md status" name="publish_answer">
														<option value="1" <?php echo e($exam->publish_answer == 1 ? 'selected' : ''); ?>>Show Answer</option>
														<option value="0" <?php echo e($exam->publish_answer == 0 ? 'selected' : ''); ?>>Donot Show Answer</option>
													</select>
												</form>
											</td>
												
											<td>
												
											  	<a class="mb-xs mt-xs mr-xs btn btn-danger btn-xs" href="<?php echo e(action('AdminMCQExamController@delete_mcq_exam',$exam->id)); ?>">Delete</a>
	                                             
											  	<a class="mb-xs mt-xs mr-xs btn btn-primary btn-xs" href="<?php echo e(action('AdminMCQExamController@edit_mcq_exam',$exam->id)); ?>">Edit</a>

											  	<a class="mb-xs mt-xs mr-xs btn btn-primary btn-xs" href="<?php echo e(action('AdminMCQExamController@add_mcq_question',$exam->id)); ?>">Add Question</a>
											  	<a class="mb-xs mt-xs mr-xs btn btn-primary btn-xs" href="<?php echo e(action('AdminMCQExamController@view_mcq_question',$exam->id)); ?>">View Question</a>

											  	<a class="mb-xs mt-xs mr-xs btn btn-primary btn-xs" href="<?php echo e(action('AdminMCQExamController@duplicate_mcq_exam',$exam->id)); ?>">Duplicate</a>
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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/codegigz/public_html/student_management/resources/views/admin/mcqExam/mcqExamList.blade.php ENDPATH**/ ?>