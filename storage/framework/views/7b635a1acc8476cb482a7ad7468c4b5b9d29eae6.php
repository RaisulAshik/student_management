

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
						<h2>Batches</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Batches</span></li>
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
						
								<h2 class="panel-title">Add Batch</h2>
							</header>
							<div class="panel-body">
								<form class="" action="<?php echo e(action('BatchController@store')); ?>" method="post">
									<?php echo csrf_field(); ?>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputDefault">Name</label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="name" id="inputDefault">
											</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputSuccess">Branch</label>
										<div class="col-md-6">
											<select class="form-control mb-md" name="branch_id" id="branch">
												<option value="0" selected="true" disabled="true">Select Branch</option>
												<?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												  <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											
											</select>
											<input type="hidden" id="auth-user-id" value="<?php echo e(auth('admin')->id()); ?>">
						
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputSuccess">Class</label>
										<div class="col-md-6">
											<select class="form-control mb-md" name="class_id" id="class">
												<option value="0" selected="true" disabled="true">Select Class</option>
												
											</select>
						
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label" for="inputDefault">Time</label>
										<div class="col-md-6">
											<input type="text" name="time" class="form-control" id="inputDefault">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label" for="inputDefault">Max Student</label>
										<div class="col-md-6">
											<input type="number" name="max_student_number" class="form-control" id="inputDefault">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label" for="inputSuccess">Student Type</label>
										<div class="col-md-6">
											<select class="form-control mb-md" name="student_type" id="student_type">
												<option value="0" selected="true" disabled="true">Select Student Type</option>
												
											</select>
						
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputSuccess">Status</label>
										<div class="col-md-6">
											<select class="form-control mb-md" name="status" id="type">
												<option value="0" selected="true" disabled="true">Select Status</option>

												<option value="1">Active</option>
												<option value="2">Inactive</option>

												
												
											</select>
						
										</div>
									</div>

									<button type="submit" class="mb-xs mt-xs mr-xs btn btn-success">Add</button>

									
						

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

<script type="text/javascript">

	$(document).ready(function(){

		$(document).on('change','#branch',function(){

			var branch_id = $(this).val();
			var authUserId = $('#auth-user-id').val();

			var op1 =" "; 
			
			$.ajax({
					type:'post',
					url:'<?php echo e(url('student/search_branch_single')); ?>',
					data:{'branch_id':branch_id},
					
					success:function(data){
                    
                    if(data.student_type == 0) {


					    op1+=`<option value="0" selected="true" disabled="true">Select Student Type</option>
							  <option value="0" selected="true">Offline</option>`;

					}else if(data.student_type == 1){
                        
						
						op1+=`<option value="0" selected="true" disabled="true">Select Student Type</option>
							<option value="1">Online</option>`;
						
				    }else if(data.student_type == 2){
                        
						op1+=`<option value="0" selected="true" disabled="true">Select Student Type</option>
							  <option value="0" selected="true">Offline</option>
							  <option value="1">Online</option>`;
						
				    }		


				    $('#student_type').html(" ");

					$('#student_type').append(op1);
					
				}
			});

			var op =" "; 

				$.ajax({
					type:'post',
					url:'<?php echo e(url('student/search_class')); ?>',
					data:{'branch_id':branch_id,'authUser': authUserId},
					
					success:function(data){
					

				    op+='<option value="0" selected disabled>Select Class</option>';
					for(var i=0;i<data.length;i++){
						op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
						console.log(data[i].id);
					}

					$('#class').html(" ");

					$('#class').append(op);
					
				},
				error:function(){

				}
			});

			});

	});
	
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/codegigz/public_html/student_management/resources/views/admin/batch/addBatch.blade.php ENDPATH**/ ?>