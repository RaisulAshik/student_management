

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/vendor/jquery-datatables-bs3/assets/css/datatables.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <header class="page-header">
						<h2>Students</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo e(route('admin.students')); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Students</span></li>
							</ol>
					    </div>
					</header>

                     <?php echo $__env->make('admin.layout.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                     <section class="panel">
							<header class="panel-heading">
						        <h2 class="panel-title">Search Filter</h2>
							</header>
							<div class="panel-body">
                                <form method="get" action="<?php echo e(action('AdminStudentController@listSearch')); ?>">
			                    <?php echo csrf_field(); ?>
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
											<select class="form-control mb-md" name="branch_id" id="branch">
												<option value="0" selected="true" disabled="true">Select Branch</option>
												
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
										<label class="col-md-2 control-label" for="inputSuccess">Batch</label>
										<div class="col-md-6">
											<select class="form-control mb-md" name="batch_id" id="batch">
												<option value="0" selected="true" disabled="true">Select Batch</option>
												
											</select>
						
										</div>
									</div>

									<button type="submit" class="mb-xs mt-xs mr-xs btn btn-success">Search</button>                        
			                                                
			                    </form>
								
							</div>
						</section>
					<section class="panel">
							<header class="panel-heading">
								
						
								<h2 class="panel-title">Student List</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Image</th>
											<th>Name</th>
											<th>Registration ID</th>
											<th>Phone</th>
											<th>Class</th>
											<th>Batch</th>
											<th>Branch</th>
											<th>Student Type</th>
											<th>Subjects/Courses</th>
											<th>Date of Addmission</th>
											<th>Payment Due Date</th>
											<th>Total</th>
											<th>Paid</th>
											<th>Due</th>
											<th>Payment Status</th>
											<th>Action</th>

										    
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="gradeX">
											<td>
												<?php if($student->image == null): ?>
												    <img style="height: 80px;width: 80px" src="<?php echo e(asset('images/person4.jpg')); ?>" alt=""/>
											    <?php elseif($student->image != null): ?>
													<img src='<?php echo e(asset('img/'.$student->image)); ?>'>
														
												<?php endif; ?>
											</td>
											<td><?php echo e($student->first_name); ?> <?php echo e($student->last_name); ?></td>
											<td><?php echo e($student->registration_id); ?></td>
											<td><?php echo e($student->phone); ?></td>
											<td><?php echo e($student->classname->name); ?></td>
											<td><?php echo e($student->batch->name); ?></td>
											<td><?php echo e($student->branch->name); ?></td>
											<td>
												<?php if($student->student_type == 0): ?>
												 Offline
												<?php elseif($student->student_type == 1): ?>
												 Online
												
												<?php endif; ?>
											</td>
											<td>
												<?php $__currentLoopData = $student->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php echo e($loop->iteration); ?>. <?php echo e($subject->subject->name); ?> <br>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</td>
											<td>
                                                <?php
												 $date_of_addmission = date('d-m-Y', strtotime($student->date_of_addmission))
                                                ?>
                                                 <?php echo e($date_of_addmission); ?>

											</td>
											<td>
											    <?php
												 $next_payment_date = date('d-m-Y', strtotime($student->next_payment_date))
                                                ?>
												
												<?php if($student->student_type == 0): ?>
												 <?php echo e($next_payment_date); ?>

												<?php elseif($student->student_type == 1): ?>
												      
												      <?php if($student->next_payment_date == null): ?>
												      <span class="text-danger">Student Not Approved</span>
													  <?php else: ?>
													  <?php echo e($next_payment_date); ?> 
													  <?php endif; ?>
												
												<?php endif; ?>
											</td>
											 <?php
												$due=App\StudentPayment::where('student_id',$student->id)->orderBy('id', 'desc')->first();
                                             ?>
											<td>
												<?php echo e($due->total_amount); ?>

											</td>
											<td>
												<?php echo e($due->paid_amount); ?>

											</td>
											<td>
												<?php echo e($due->due_amount); ?>

											</td>
                                            
                                            <?php if($student->student_type == 1): ?>
                                            <td>

												<?php
												$date = new DateTime($student->next_payment_date);
                                                $now = new DateTime();
                                                ?>

                                                <?php if($date < $now): ?>
                                                  <span class="text-danger">Due</span>
                                                <?php else: ?>
                                                 <span class="text-success">Paid</span>
                                                <?php endif; ?>

											</td>
                                            <?php elseif($student->student_type == 0): ?>
                                                <td>
													<?php if($due->due_amount > 0): ?>
	                                                  <span class="text-danger">Due</span>
	                                                <?php else: ?>
	                                                 <span class="text-success">Paid</span>
	                                                <?php endif; ?>
											    </td>
                                            <?php endif; ?>

											<td>
												<a href="<?php echo e(route('admin.student_view',$student->id)); ?>" class="mb-xs mt-xs mr-xs btn btn-sm btn-primary" >View</a>
												<a href="<?php echo e(route('admin.student_view_payment',$student->id)); ?>" class="mb-xs mt-xs mr-xs btn btn-sm btn-danger" >Payments</a>
												<a href="<?php echo e(route('admin.student_change_due_date',$student->id)); ?>" class="mb-xs mt-xs mr-xs btn btn-sm btn-danger" >Change Due Date</a>

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
			var authUserId = $('#auth-user-id').val();

			console.log(branch_id)

			var op =" "; 

				$.ajax({
					type:'post',
					url:'<?php echo e(url('student/search_class')); ?>',
					data:{'branch_id':branch_id,'authUser': authUserId},
					
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
<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/codegigz/public_html/student_management/resources/views/admin/student/studentList.blade.php ENDPATH**/ ?>