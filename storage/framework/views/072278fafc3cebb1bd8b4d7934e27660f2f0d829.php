

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/bootstrap-multiselect/bootstrap-multiselect.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/dropzone/css/basic.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/dropzone/css/dropzone.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/summernote/summernote.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/summernote/summernote-bs3.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/codemirror/lib/codemirror.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/codemirror/theme/monokai.css')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <header class="page-header">
						<h2>Classes</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Classes</span></li>
							</ol>
					    </div>
					</header>
					 
                    <?php echo $__env->make('admin.layout.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
					<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
						
								<h2 class="panel-title">Edit Class</h2>
							</header>
							<div class="panel-body">
								<form class="" action="<?php echo e(action('ClassController@update',$class->id)); ?>" method="post">
                                    <?php echo csrf_field(); ?>
									<input type="hidden" name="_method" value="PUT">
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputDefault">Name</label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="name" id="inputDefault" value="<?php echo e($class->name); ?>">
											</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputSuccess">Branch</label>
										<div class="col-md-6">
											<select class="form-control mb-md" name="branch_id" id="branch_id">
												<option value="<?php echo e($class->branch_id); ?>" selected="true"><?php echo e($class->branch->name); ?></option>
												<?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												  <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											
											</select>
						
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputDefault">HSC Year</label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="year" id="inputDefault" value="<?php echo e($class->year); ?>">
											</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label" for="inputSuccess">Status</label>
										<div class="col-md-6">
											<select class="form-control mb-md" name="status" id="type">
												<option value="0" <?php echo e($class->status == 0 ? 'selected' : ''); ?>>Inactive</option>
												<option value="1" <?php echo e($class->status == 1 ? 'selected' : ''); ?>>Active</option>

												
												
											</select>
						
										</div>
									</div>

									<button type="submit" class="mb-xs mt-xs mr-xs btn btn-success">Update</button>

									
						

								</form>	
							</div>
						</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-js'); ?>
<script src="<?php echo e(asset('assets/backend/vendor/select2/select2.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/jquery-autosize/jquery.autosize.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/backend/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/select2/select2.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/bootstrap-multiselect/bootstrap-multiselect.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/jquery-maskedinput/jquery.maskedinput.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/fuelux/js/spinner.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/dropzone/dropzone.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/bootstrap-markdown/js/markdown.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/bootstrap-markdown/js/to-markdown.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/bootstrap-markdown/js/bootstrap-markdown.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/codemirror/lib/codemirror.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/codemirror/addon/selection/active-line.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/codemirror/addon/edit/matchbrackets.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/codemirror/mode/javascript/javascript.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/codemirror/mode/xml/xml.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/codemirror/mode/htmlmixed/htmlmixed.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/codemirror/mode/css/css.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/summernote/summernote.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/bootstrap-maxlength/bootstrap-maxlength.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/vendor/ios7-switch/ios7-switch.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/javascripts/forms/examples.advanced.form.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/codegigz/public_html/student_management/resources/views/admin/class/editClass.blade.php ENDPATH**/ ?>