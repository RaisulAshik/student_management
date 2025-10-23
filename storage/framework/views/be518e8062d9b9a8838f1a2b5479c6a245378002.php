

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/jquery-datatables-bs3/assets/css/datatables.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <header class="page-header">
						<h2>MCQ Question List</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>MCQ Question List</span></li>
							</ol>
					    </div>
					</header>

					<?php echo $__env->make('admin.layout.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

					<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
								
								</div>
						
								<h2 class="panel-title">MCQ Question List</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Question No.</th>
											<th>Question Title</th>
											<th>A</th>
											<th>B</th>
											<th>C</th>
											<th>D</th>
											<th>Correct Answer</th>
											<th>Action</th>
										    
									</thead>
										</tr>
									<tbody>

										<?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="gradeX">
											<td><?php echo e($question->question_number); ?></td>
											<td><?php echo $question->question_title; ?></td>
											<?php $__currentLoopData = $question->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<td><?php echo $option->option_title; ?></td>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<td>
												<?php $__currentLoopData = $question->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											      <?php if($option->right_answer == 1): ?>
											        <?php if($option->option_number == 1): ?>
											        A
											        <?php elseif($option->option_number == 2): ?>
											        B
											        <?php elseif($option->option_number == 3): ?>
											        C
											        <?php elseif($option->option_number == 4): ?>
											        D
											        <?php endif; ?>

											      <?php endif; ?>
											    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</td>
												
											<td>
												
											  	<a class="mb-xs mt-xs mr-xs btn btn-danger btn-xs" href="<?php echo e(action('AdminMCQExamController@delete_mcq_question',$question->id)); ?>">Delete</a>
	                                             
											  	<a class="mb-xs mt-xs mr-xs btn btn-primary btn-xs" href="<?php echo e(action('AdminMCQExamController@edit_mcq_question',$question->id)); ?>">edit</a>

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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/codegigz/public_html/student_management/resources/views/admin/mcqExam/mcqQuestionView.blade.php ENDPATH**/ ?>