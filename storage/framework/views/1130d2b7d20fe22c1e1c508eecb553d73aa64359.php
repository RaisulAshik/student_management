

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/jquery-datatables-bs3/assets/css/datatables.css')); ?>" 
/>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/magnific-popup/magnific-popup.css')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <header class="page-header">
						<h2>Homework</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Homework</span></li>
							</ol>
					    </div>
					</header>

					<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
						
								<h2 class="panel-title">Homework</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Student Name</th>
											<th>Teacher</th>
											<th>Class</th>
											<th>Batch</th>
											<th>Branch</th>
											<th>Subject</th>
											<th>Title</th>
											<th>Submission Date</th>
											<th>Score</th>
											<th>Evaluation Date</th>
											<th>Action</th>

										    
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $homeworks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homework): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="gradeX">
											<td><?php echo e(optional($homework->student)->first_name); ?> <?php echo e(optional($homework->student)->last_name); ?></td>
											<td><?php echo e(optional($homework->teacher)->name); ?></td>
											<td><?php echo e(optional($homework->class)->name); ?></td>
											<td><?php echo e(optional($homework->batch)->name); ?></td>
											<td><?php echo e(optional($homework->branch)->name); ?></td>
											<td><?php echo e(optional($homework->subject)->name); ?></td>
											<td><?php echo e($homework->title); ?></td>
											<td><?php echo e($homework->submission_date); ?></td>
											<td><?php echo e($homework->score); ?></td>
											<td><?php echo e($homework->evaluation_date); ?></td>
											<!-- <?php $__currentLoopData = $homework->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<td><img src="<?php echo e('homework/'.$image->homework_image); ?>" width="100%" height="100%"></td>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
											<td><a href="<?php echo e(route('admin.pdfHomework',$homework->id)); ?>"  class="mb-xs mt-xs mr-xs btn btn-default" >PDF</a>
										    <a href="<?php echo e(route('admin.evaluateHomework',$homework->id)); ?>"  class="mb-xs mt-xs mr-xs btn btn-default" >Evaluate</a>											</td>

											<div id="modalForm" class="modal-block modal-block-primary mfp-hide">
													<section class="panel">
														<header class="panel-heading">
															<h2 class="panel-title">Evaluate</h2>
														</header>
														<div class="panel-body">
															<form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
																<div class="form-group mt-lg">
																	<label class="col-sm-3 control-label">Name</label>
																	<div class="col-sm-9">
																		<input type="number" name="name" class="form-control" placeholder="Type your name..." required/>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-3 control-label">Email</label>
																	<div class="col-sm-9">
																		<input type="email" name="email" class="form-control" placeholder="Type your email..." required/>
																	</div>
																</div>
															</form>
														</div>
														<footer class="panel-footer">
															<div class="row">
																<div class="col-md-12 text-right">
																	<button class="btn btn-primary modal-confirm">Submit</button>
																	<button class="btn btn-default modal-dismiss">Cancel</button>
																</div>
															</div>
														</footer>
													</section>
												</div>

											</div>
											
											
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
<script src="<?php echo e(asset('assets/backend/vendor/jquery-placeholder/jquery.placeholder.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/javascripts/ui-elements/examples.modals.js')); ?>"></script>

<script>
// $('#datatable-default').dataTable( {
//   "order": [[ 6, "desc" ]]
// });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\student_management\resources\views/admin/homework/homework.blade.php ENDPATH**/ ?>