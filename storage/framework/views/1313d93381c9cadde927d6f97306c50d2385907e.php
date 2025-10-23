

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
						<h2>Content</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Content</span></li>
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
						
								<h2 class="panel-title">Add Content</h2>
							</header>
							<div class="panel-body">
								<form class="" action="<?php echo e(action('AdminContentController@store')); ?>" method="post" enctype="multipart/form-data">
									<?php echo csrf_field(); ?>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputDefault">Content Title</label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="title" id="inputDefault">
											</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputSuccess">Content Type</label>
										<div class="col-md-6">
											<select class="form-control mb-md" name="type" id="type">
												<option value="0" selected="true" disabled="true">Select Content Type</option>

												<?php $__currentLoopData = $content_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($content_type->id); ?>"><?php echo e($content_type->name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												
											</select>
						
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputSuccess">Branch Type</label>
										<div class="col-md-6">
											<select class="form-control mb-md" name="student_type" id="student_type">
												<option selected="true">Select Type</option>
												<option value="0">Offline</option>
												<option value="1">Online</option>
												
											</select>
						
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputSuccess">Branch</label>
										<div class="col-md-6">
											<select class="form-control mb-md" name="branch" id="branch">
												<option value="0" selected="true" disabled="true">Select Branch</option>
												
											</select>
						
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputSuccess">Class</label>
										<div class="col-md-6">
											<select class="form-control mb-md" name="class" id="class">
												<option value="0" selected="true" disabled="true">Select Class</option>
												
											</select>
						
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputSuccess">Batch</label>
										<div class="col-md-6">
											<select class="form-control mb-md" name="batch" id="batch">
												<option value="0" selected="true" disabled="true">Select Batch</option>
												
											</select>
						
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputSuccess">Subject</label>
										<div class="col-md-6">
											<select class="form-control mb-md" name="subject" id="subject">
												<option value="0" selected="true" disabled="true">Select Subject</option>
											</select>
						
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-md-2 control-label">Date</label>
										    <div class="col-md-6">
												<div class="input-group">
													<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
													</span>
													<input type="text" name="date" data-plugin-datepicker class="form-control" id="exam_date">
													</div>
											</div>
									</div>
                                    <div class="form-group">
										<label class="col-md-2 control-label" for="textareaAutosize">Description</label>
										    <div class="col-md-6">
												<textarea class="form-control" name="description" rows="3" id="textareaAutosize" data-plugin-textarea-autosize></textarea>
											</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label" for="inputDefault">Content File</label>
											<div class="col-md-6">
												<input type="file" class="form-control" name="file" id="inputDefault">
											</div>
									</div>

									<button type="submit" class="mb-xs mt-xs mr-xs btn btn-success">Upload</button>
									
						

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

		$(document).on('change','#student_type',function(){

			var student_type = $(this).val();

			console.log(student_type)

			var op =" "; 

				$.ajax({
					type:'post',
					url:'<?php echo e(url('student/search_branch')); ?>',
					data:{'student_type':student_type},
					
					success:function(data){
					
                     console.log(data)
				    op+='<option value="0" selected="true" disabled="true">Select Branch</option>';
					for(var i=0;i<data.length;i++){
						op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
						console.log(data[i].id);
					}

					$('#branch').html(" ");

					$('#branch').append(op);
					
				},
				error:function(){

				}
			});

			});

	});
	
</script>


<script type="text/javascript">

	$(document).ready(function(){

		$(document).on('change','#branch',function(){

			var branch_id = $(this).val();

			console.log(branch_id)

			var op =" "; 

				$.ajax({
					type:'post',
					url:'<?php echo e(url('student/search_class')); ?>',
					data:{'branch_id':branch_id},
					
					success:function(data){
					
                    console.log(data);
				    op+='<option value="0" selected disabled>Select Class</option>';
					for(var i=0;i<data.length;i++){
						op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
						
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

<script type="text/javascript">

	$(document).ready(function(){

		$(document).on('change','#class',function(){

			var class_id = $(this).val();
			var branch_id = $('#branch').val();
			var student_type = $('#student_type').val();

			var op =" "; 

				$.ajax({
					type:'post',
					url:'<?php echo e(url('student/search_batch')); ?>',
					data:{'branch_id':branch_id,'class_id':class_id,'student_type':student_type},
					
					success:function(data){
						console.log(data);

				    op+='<option value="0" selected disabled>Select Batch</option>';
					for(var i=0;i<data.length;i++){
						op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
						console.log(data[i].id);
					}

					$('#batch').html(" ");

					$('#batch').append(op);
					
				},
				error:function(){

				}
			});

		    var op2 =""; 

				$.ajax({
					type:'post',
					url:'<?php echo e(url('student/search_subject')); ?>',
					data:{'class_id':class_id,'student_type':student_type},
					
					success:function(data){
						console.log(data);

				    op2+='<option value="0" selected disabled>Select Subject</option>';
					for(var i=0;i<data.length;i++){
						op2+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
						console.log(data[i].id);
					}

					$('#subject').html(" ");

					$('#subject').append(op2);
					
				},
				error:function(){

				}
			});		

			});

	});
	
</script>

<script>
$( document ).ready(function() {
    $("#exam_date").datepicker({ 
        format: 'yyyy-mm-dd'
    });
    $("#from-datepicker").on("change", function () {
        var fromdate = $(this).val();
        alert(fromdate);
    });
}); 
</script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/codegigz/public_html/student_management/resources/views/admin/content/addContent.blade.php ENDPATH**/ ?>