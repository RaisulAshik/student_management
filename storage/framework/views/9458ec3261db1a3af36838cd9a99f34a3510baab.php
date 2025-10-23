<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <style>
        body {
            padding: .1in;
        }

        .company-logo {
            display: inline-block;
            width: 25%;
            padding: 5px;
            margin-top: -60px;
        }

        .company-logo h2 {
            margin-top: 0px;
        }

        .form-heading {
            display: inline-block;
            width: 44%;
            padding: 5px;
            text-align: center;
        }

        .form-heading h2 {
            margin-top: 0px;
        }

        .student-photo {
            display: inline-block;
            height: 150px;
            width: 25%;
            padding: 5px;
            text-align: center;
        }

        .student-photo h2 {
            margin-top: 0px;
        }

        .input-field {
            padding-bottom: 10px;
        }

        .input-field h3 {
            display: inline-block;
            margin: 0px;
        }

        .input-field h4 {
            display: inline-block;
            margin: 0px;
        }

        .input-field p {
            display: inline-block;
            margin: 0px;
        }

        .payment-heading {
            display: inline-block;
            width: 100%;
            padding: 5px;
            text-align: center;
        }

        .signature {
            display: inline-block;
            width: 31%;
            width: 230px;
            padding-top: 50px;
            padding-bottom: 0px !important;
            text-decoration: overline;
        }

        .head-font {
            font-style: italic;
            padding-bottom: -15px;
        }

        .page_break {
            page-break-before: always;
        }

        .empty-image {
            height: 150px;
            width: 150px;
            padding: 10px;
            border: 1px dashed black !important;
            margin: 0;
            text-align: center;
            vertical-align: middle;
            line-height: 170px;
            font-size: 20px;
        }

        .footer-1 {
            display: inline-block;
            width: 40%;
            padding: 0px;
            text-align: left;
        }

        .footer-2 {
            display: inline-block;
            width: 30%;
            padding: 0px;
            text-align: center;
        }

        .footer-3 {
            display: inline-block;
            width: 20%;
            padding: 0px;
            text-align: right;
        }

    </style>
</head>

<body>

    <div class="company-logo">
        <img height="80px" width="160px" src="<?php echo e(public_path('company/shadowaide.jpg')); ?>">
    </div>

    <div class="form-heading" style="vertical-align: top; padding-top: -40px !important;"">
<?php
            $company_details = App\CompanyDetail::first();
?>
        <h3 style=" padding-bottom:-10px !important;">SHADOW AIDE </h3>
        
        <h5 style="padding-bottom:-10px !important;"><span style="color: rgb(124, 0, 41)">(Ensure Optimal
                Education)</span></h5>
        <h5 style="padding-bottom:-10px !important;"><span style="color:#2c75e4;"> (Turning Student Into Assets)</span>
        </h5>
    </div>


    <?php
	   $student_profile=App\StudentProfile::where('student_id',$student->id)->first()
	?>

	<?php if($student_profile): ?>
	    <?php if($student_profile->image == null): ?>
			<div class="student-photo">
	            <div class="empty-image">Student's Photo</div>
	        </div>
		<?php elseif($student_profile->image != null): ?>
			<div class="student-photo">
	            <div class="empty-image"><img style="height: 150px; width: 150px;" src='<?php echo e(asset('studentImage/'.$student_profile->image)); ?>'></div>
	        </div>
        <?php endif; ?>
	<?php else: ?>
	<div class="student-photo">
        <div class="empty-image">Student's Photo</div>
    </div>
	<?php endif; ?>

  

    <div style="text-align: center;">
        <h2 class="head-font">Admit Card</h2>
        
    </div>

    <div class="input-field" style="padding-top: 10px;">
        <h3>Student Name : </h3>
        <p><?php echo e($student->first_name); ?> <?php echo e($student->last_name); ?></p>
    </div>

    <div class="input-field">
        <h3>Registration ID : </h3>
        <p><?php echo e($student->registration_id); ?></p>
    </div>

    <div class="input-field">
        <h3>Course : </h3>
        <p><?php echo e($student->classname->name); ?></p>
    </div>

    <div class="input-field">
        <h3>Batch : </h3>
        <p><?php echo e($student->batch->name); ?></p>
    </div>
    
    <div class="input-field" style="padding-top: 20px; width: 90%;">
        <h3>Subjects/Courses : </h3>
        <br>
        <span>
            <?php $__currentLoopData = $student_subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p style="margin-right: 20px;"><?php echo e($loop->index+1); ?>. <?php echo e($subject->subject->name); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </span>
    </div>



   

    

    <div class="signature">
        <h3>Student's Signature</h3>
    </div>

    <div class="signature">
        <h3>Guardian's Signature</h3>
    </div>

    <div class="signature">
        <h3>Authorized Signature</h3>
    </div>

    <footer>

        <div class="footer-1">
            <h5><?php echo e($company_details->facebook); ?></h5>
        </div>

        <div class="footer-2">
            <h5>www.shadowaidelifeline.com</h5>
        </div>

        <div class="footer-3">
            <h5>Mob : <?php echo e($company_details->phone); ?></h5>
        </div>

    </footer>




  




    

</body>

</html>
<?php /**PATH /home/codegroover/public_html/student_management/resources/views/admin/offline/pdfAdmit.blade.php ENDPATH**/ ?>