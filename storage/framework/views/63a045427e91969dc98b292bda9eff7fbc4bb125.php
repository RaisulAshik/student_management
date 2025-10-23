

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
						<h2> Add Offline Student Course</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.dashboard')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Add Offline Student Course</span></li>
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
						
								<h2 class="panel-title">Add Offline Student Course</h2>
							</header>
							<div class="panel-body">
								<form class="" action="<?php echo e(action('AdminOfflineStudentController@create_offline_student_course',$student->id)); ?>" method="post">
									<?php echo csrf_field(); ?>
								
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputSuccess">Branch</label>
										<div class="col-md-6">
											<select class="form-control mb-md" name="branch_id" id="branch">
												<option value="<?php echo e($student->branch_id); ?>" selected="true"><?php echo e($student->branch->name); ?></option>
												<?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>  
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
						
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputSuccess">Class</label>
										<div class="col-md-6">
											<select class="form-control mb-md" name="class_id" id="class">
												<option value="<?php echo e($student->class_id); ?>" selected="true" ><?php echo e($student->classname->name); ?></option>
												
											</select>
						
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="inputSuccess">Batch</label>
										<div class="col-md-6">
											<select class="form-control mb-md" name="batch_id" id="batch">
												<option value="<?php echo e($student->batch_id); ?>" selected="true"><?php echo e($student->batch->name); ?></option>
												
											</select>
						
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label" for="inputSuccess">Subjects</label>
										<div class="col-md-6" id="subject">
										 
										    <?php
										    $total_amount=0;
										    ?>
											<?php $__currentLoopData = $student->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						                        <div class="checkbox">
													<label>
														<input class="subject" type="checkbox" checked name="subject_id[]" value="<?php echo e($subject->subject_id); ?>">
															<?php echo e($subject->subject->name); ?> - <?php echo e($subject->subject->amount); ?>

													</label>
												  </div>

												  <?php
												   
												   $total_amount=$total_amount+$subject->subject->amount;
												  ?>
						                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label" for="inputDefault">Total Amount</label>
										<div class="col-md-6">
											<input type="number" name="total_amount" class="form-control" id="total_amount" value="<?php echo e($total_amount); ?>">
										</div>
									</div>

                                 
                                    
                                    	<div class="form-group">
											<label class="col-md-2 control-label" for="inputDefault">Amount</label>
											<div class="col-md-6">
												<input type="number" name="paid_amount" class="form-control" id="inputDefault">
											</div>
										</div>

										<div class="form-group">
										    <label class="col-md-2 control-label">Payment Valid Date</label>
										    <div class="col-md-6">
												<div class="input-group">
													<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
													</span>
													<input type="text" name="next_payment_date" data-plugin-datepicker class="form-control" id="next_payment_date">
													</div>
											</div>
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

			var op =" "; 

				$.ajax({
					type:'post',
					url:'<?php echo e(url('student/search_class')); ?>',
					data:{'branch_id':branch_id},
					
					success:function(data){
					

				    op+='<option value="0" selected disabled>Select Class</option>';
					for(var i=0;i<data.length;i++){
						op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
						console.log(data[i].id);
					}

					$('#class').html(" ");

					$('#class').append(op);

					$('#total_amount').val('');

					$('#subject').html("");

					$('#batch').html('<option value="0" selected disabled>Select Batch</option>');
					
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

			var op =" "; 

				$.ajax({
					type:'post',
					url:'<?php echo e(url('student/search_batch')); ?>',
					data:{'branch_id':branch_id,'class_id':class_id,student_type:0},
					
					success:function(data){
						console.log(data);

				    op+='<option value="0" selected disabled>Select Batch</option>';
					for(var i=0;i<data.length;i++){
						op+='<option value="'+data[i].id+'">'+data[i].name+' ('+data[i].time+')'+'</option>';
						console.log(data[i].id);
					}

					$('#batch').html(" ");

					$('#batch').append(op);

					$('#total_amount').val('');

					$('#subject').html(" ");
					
				},
				error:function(){

				}
			});

		    var op2 =""; 

				$.ajax({
					type:'post',
					url:'<?php echo e(url('student/search_subject')); ?>',
					data:{'class_id':class_id,student_type:0},
					
					success:function(data){
						console.log(data);

				    // op2+='<option value="0" selected disabled>Select Subject</option>';
					for(var i=0;i<data.length;i++){
						// op2+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
					    op2+=`<div class="checkbox">
								<label>
									<input class="subject" type="checkbox" name="subject_id[]" value="${data[i].id}">
										${data[i].name} - ${data[i].amount}
								</label>
							  </div>`;
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


<script type="text/javascript">

	$(document).ready(function(){

		$(document).on('change','.subject',function(){

			var subject_id = $(this).val();
            
            	$.ajax({
					type:'post',
					url:'<?php echo e(url('student/search_subject_amount')); ?>',
					data:{'subject_id':subject_id},
					
					success:function(data){
				
                        var sum = 0;
						$('.subject:checked').each(function(){
						       sum += Number(data.amount);



						});

						$('#total_amount').val(sum);
						

				},


				error:function(){

				}


			});

			});

	});
	
</script>


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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/codegroover/public_html/student_management/resources/views/admin/offline/addStudentPayment.blade.php ENDPATH**/ ?>