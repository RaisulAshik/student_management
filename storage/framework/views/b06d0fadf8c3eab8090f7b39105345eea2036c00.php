

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/jquery-datatables-bs3/assets/css/datatables.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <header class="page-header">
						<h2>Live Classes</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Live Classes</span></li>
							</ol>
					    </div>
					</header>

					<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
								<a class="" href="<?php echo e(action('ZoomClass@add')); ?>"><i class="fa fa-plus"></i> Add
								</a>
								</div>
						
								<h2 class="panel-title">Live Classes</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Class Topic</th>
											<th>Teacher</th>
											<th>Api Name</th>
											<th>Time</th>
											<th>Duration</th>
											<th>Branch Type</th>
											<th>Branch</th>
											<th>Class</th>
											<th>Batch</th>
											<th>Subject</th>
											<th>Status</th>
                                            <th>Action</th>
										    
									</thead>
										</tr>
									<tbody>

										<?php $__currentLoopData = $data['classes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="gradeX">
											<td><?php echo e($meeting->topic); ?></td>
											<td><?php echo e($meeting->teacher->name); ?></td>
											<td><?php echo e($meeting->zoom->zoom_api_name); ?></td>
											<td><?php echo e($meeting->when); ?></td>
											<td><?php echo e($meeting->duration); ?> min</td>
											<td>
												<?php if($meeting->student_type ==1 ): ?>
												  Online
												<?php elseif($meeting->student_type ==0): ?>
												  Offline
												<?php endif; ?>
												
											</td>
											<td><?php echo e($meeting->branchname->name); ?></td>
											<td><?php echo e($meeting->classname->name); ?></td>
											<td><?php echo e($meeting->batchname->name); ?></td>
											<td><?php echo e($meeting->subjectname->name); ?></td>

											<td>
												<form action="<?php echo e(action('ZoomClass@changeStatus')); ?>" method="post">
												<?php echo csrf_field(); ?>
													<input type="hidden" name="meeting_id" value="<?php echo e($meeting->id); ?>">
													<select class="form-control mb-md status" name="status">
														<option value="1" <?php echo e($meeting->live_status == 1 ? 'selected' : ''); ?>>Waiting</option>
														<option value="2" <?php echo e($meeting->live_status == 2 ? 'selected' : ''); ?>>Live</option>
														<option value="3" <?php echo e($meeting->live_status == 3 ? 'selected' : ''); ?>>Finnished</option>
												    </select>
												</form>
											
											</td>
											<td>
												<?php if($meeting->live_status != 3): ?>
                                                   
												<a href="<?php echo e($meeting->start_url); ?>" target="_blank" class="mb-xs mt-xs mr-xs btn btn-default btn-xs " ><i class="fa fa-sign-in"></i> Start Class</a>
										  	    <?php endif; ?>

												<a class="mb-xs mt-xs mr-xs btn btn-default btn-xs" href="<?php echo e(action('ZoomClass@delete',$meeting->meeting_id)); ?>">Delete</a>

												<a class="mb-xs mt-xs mr-xs btn btn-default btn-xs" href="<?php echo e(action('ZoomClass@edit',$meeting->id)); ?>">Edit</a>
                                                
                                                

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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/codegigz/public_html/student_management/resources/views/admin/liveClass/classList.blade.php ENDPATH**/ ?>