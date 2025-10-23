                    <?php if($errors->any()): ?>
					    <div class="row ml-2">
		                    <div class="alert alert-danger col-sm-6">
		                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                        <div>
			                        <?php echo e($error); ?>

			                    </div>
			                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                    </div>
	                    </div>
	                <?php endif; ?>
	                <?php if($message = Session::get('success')): ?>
	                    <div class="row">
		                    <div class="alert alert-success col-sm-6">
		                        <strong> <?php echo e($message); ?> </strong> 
		                    </div>
	                    </div>
                    <?php endif; ?> <?php /**PATH /home/codegroover/public_html/student_management/resources/views/admin/layout/message.blade.php ENDPATH**/ ?>