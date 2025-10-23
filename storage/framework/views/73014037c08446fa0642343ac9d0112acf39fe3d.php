

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/jquery-datatables-bs3/assets/css/datatables.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <header class="page-header">
						<h2>Messages</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Messages</span></li>
							</ol>
					    </div>
					</header>

					<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
								<a class="" href="<?php echo e(action('AdminMessageController@create')); ?>"><i class="fa fa-plus"></i> Add
								</a>
								</div>
						
								<h2 class="panel-title">Messages</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Title</th>
											<th>Date</th>
											<th>Message</th>
											<th>Branch</th>
											<th>Class</th>
											<th>Batch</th>
											<th>Status</th>
                                            <th>Action</th>
										    
									</thead>
										</tr>
									<tbody>

										<?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="gradeX">
											<td><?php echo e($message->title); ?></td>
											<td><?php echo e($message->date); ?></td>
											<td><?php echo e($message->message); ?></td>
											<?php if($message->all_student==1): ?>
												<td>All</td>
												<td>All</td>
												<td>All</td>
											<?php else: ?>
												<td><?php echo e($message->branchname->name); ?></td>
												<td><?php echo e($message->classname->name); ?></td>
												<td><?php echo e($message->batchname->name); ?></td>
											<?php endif; ?>

											<td>
												<?php if($message->status==0): ?>
												Inactive
											    <?php elseif($message->status==1): ?>
											    Active
											    <?php endif; ?>
											</td>
											
											<td>

												
												
                                                   
												<a href="<?php echo e(route('messages.edit',$message->id)); ?>" class="mb-xs mt-xs mr-xs btn btn-primary" >Edit</a>

												<form method="post" action="<?php echo e(route('messages.destroy',$message->id)); ?>"  style="display: inline">
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

<script type="text/javascript">
	$('.status').on('change', function(e){
      $(this).closest('form').submit();
      
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/codegroover/public_html/student_management/resources/views/admin/message/messageList.blade.php ENDPATH**/ ?>