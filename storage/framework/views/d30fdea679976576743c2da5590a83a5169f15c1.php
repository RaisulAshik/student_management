

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
						<h2>Company Info</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Company Info</span></li>
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
						
								<h2 class="panel-title">Edit Company Info</h2>
							</header>
							<div class="panel-body">
								<form class="" action="<?php echo e(route('admin.companyDetail.update',$company->id)); ?>" method="post" enctype="multipart/form-data" >
									<?php echo csrf_field(); ?>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputDefault">Name</label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="name" id="inputDefault" value="<?php echo e($company->name); ?>">
											</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputDefault">Email</label>
											<div class="col-md-6">
												<input type="email" class="form-control" name="email" id="inputDefault" value="<?php echo e($company->email); ?>">
											</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputDefault">Phone</label>
										<div class="col-md-6">
											<input type="number" name="phone" class="form-control" id="inputDefault" value="<?php echo e($company->phone); ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="textareaAutosize">Address</label>
										    <div class="col-md-6">
												<textarea class="form-control" name="address" rows="3" id="textareaAutosize" data-plugin-textarea-autosize><?php echo e($company->address); ?></textarea>
											</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputDefault">Facebook Link</label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="facebook" id="inputDefault" value="<?php echo e($company->facebook); ?>">
											</div>
									</div>

									<div class="form-group">
										    <div class="col-md-2"></div>
											<div class="col-md-6">
												<?php if($company->logo != null): ?>
                       
						                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
						                                <img src="<?php echo e(asset('/company/'.$company->logo)); ?>" alt="logo" />
						                            </div>
						                        <?php else: ?>
						                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
						                                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="No Image" />
						                            </div>
						                        <?php endif; ?>
											</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label" for="inputDefault">Logo</label>
											<div class="col-md-6">
												<input type="file" class="form-control" name="logo" id="inputDefault">
											</div>
									</div>

									<div class="form-group">
										    <div class="col-md-2"></div>
											<div class="col-md-6">
												<?php if($company->favicon != null): ?>
                       
						                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
						                                <img src="<?php echo e(asset('/company/'.$company->favicon)); ?>" alt="logo" />
						                            </div>
						                        <?php else: ?>
						                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
						                                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="No Image" />
						                            </div>
						                        <?php endif; ?>
											</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label" for="inputDefault">Favicon</label>
											<div class="col-md-6">
												<input type="file" class="form-control" name="favicon" id="inputDefault">
											</div>
									</div>
									

										<div class="form-group">
										    <label class="col-md-2 control-label">Establish Date</label>
										    <div class="col-md-6">
												<div class="input-group">
													<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
													</span>
													<input type="text" name="establishDate" data-plugin-datepicker class="form-control" id="next_payment_date" value="<?php echo e($company->establishDate); ?>">
													</div>
											</div>
										 </div>	
											
									</div>

									<button type="submit" class="mb-xs mt-xs mr-xs btn btn-success">Success</button>
									
						

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





<script>
$( document ).ready(function() {
    $("#next_payment_date").datepicker({ 
        format: 'yyyy-mm-dd'
    });
    $("#from-datepicker").on("change", function () {
        var fromdate = $(this).val();
        alert(fromdate);
    });
}); 
</script>





<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/codegigz/public_html/student_management/resources/views/admin/companyDetail/companyDetail.blade.php ENDPATH**/ ?>