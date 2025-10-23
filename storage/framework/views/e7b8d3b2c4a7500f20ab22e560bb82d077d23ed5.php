<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Result</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <style>
        body {
            padding: .1in;
        }

        .company-logo {
            display: inline-block;
            width: 25%;
            padding: 5px;
            margin-top: -3px;
        }

        .company-logo h2 {
            margin-top: 0px;
        }

        .form-heading {
            display: inline-block;
            width: 72%;
            padding: 5px;
            text-align: right;
        }

        .form-heading h2 {
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

        .head-font {
            font-style: italic;
            padding-bottom: -15px;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border-collapse: none;
            border-spacing: 0;
            font-size: 0.9166em;
        }

        table thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }

        table thead th {
            padding: 5px 10px;
            background: #353A40;
            text-align: left;
            color: white;
            font-weight: 400;
            text-transform: uppercase;
            font-size: 18px;
        }

        table tbody td {
            padding: 5px;
            color: #777777;
            text-align: left;
            font-size: 16px;
        }

        table tbody td:last-child {
            border-right: none;
        }

        table tbody h3 {
            margin-bottom: 5px;
            color: #FEEEEF;
            font-weight: 600;
        }

        th,
        td {
            text-align: left;
            font-weight: normal;
            vertical-align: middle;
        }

        th {
            border: 0.01em solid lightgray;
        }

        #invoice td {
            border: 0.01em solid lightgray;
        }

        <blade media|%20screen%20%7B%0D>div.divFooter {
            display: none;
        }
        }

        <blade media|%20print%20%7B%0D>div.divFooter {
            position: fixed;
            bottom: 0;
        }
        }

        .total-amount-field {
            padding-bottom: 10px;
            padding-top: 10px !important;
            padding-right: 10px;
            float: right;
        }

        .total-amount-field h4 {
            display: inline-block;
            margin: 0px;
        }

        .total-amount-field p {
            display: inline-block;
            margin: 0px;
        }

        .table-data {
            text-align: center;
            font-size: 14px;
            color: black;
            padding: 15px 15px;
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
        <h3 style=" padding-bottom:-10px !important;">SHADOW AIDE <span style="color: #fd7635;">&</span>
        <span style="color: green">LIFE LINE</span></h3>
        <h5 style="padding-bottom:-10px !important;"><span style="color: rgb(124, 0, 41)">(Ensure Optimal
                Education)</span><span style="color:#2c75e4;"> (Turning Student Into Assets)</span></h5>
        
    </div>

    <?php if(isset($start_date)): ?>
        <div class="input-field" style="padding-top: 20px !important;">
            <h4>Student Name : </h4>
            <p><?php echo e($results[0]->first_name); ?> <?php echo e($results[0]->last_name); ?></p>
        </div>
        <div class="input-field">
            <h4>Student Name : </h4>
            <p><?php echo e($results[0]->registration_id); ?> <?php echo e($results[0]->registration_id); ?></p>
        </div>
        <div class="input-field">
            <h4>Starting Date : </h4>
            <p><?php echo e($start_date); ?></p>
        </div>

        <div class="input-field">
            <h4>Ending Date : </h4>
            <p><?php echo e($end_date); ?></p>
        </div>
    <?php endif; ?>



    <div style="text-align: center;">
        <h2 class="head-font">Result List</h2>
    </div>

    <table id="invoice" border="2" cellspacing="0" cellpadding="0">

        <thead>
            <tr>

                <th style="text-align: center;width:14%;"
                    style="background-color:white; color:black;font-size:8px;background-color:lightgrey;padding:10px 10px;">
                    Exam Name
                </th>
                <th style="text-align: center;width:14%;"
                    style="background-color:white;color:black; font-size:8px;background-color:lightgrey;padding:10px 10px;">
                    Obtained Marks
                </th>
                <th style="text-align: center;width:14%;"
                    style="background-color:white;color:black; font-size:8px;background-color:lightgrey;padding:10px 10px;">
                    Highest Marks
                </th>
                <th style="text-align: center;width:14%;"
                    style="background-color:white;color:black; font-size:8px;background-color:lightgrey;padding:10px 10px;">
                    Total Marks
                </th>
                <th style="text-align: center;width:14%;"
                    style="background-color:white;color:black; font-size:8px;background-color:lightgrey;padding:10px 10px;">
                    Satisfactory Marks
                </th>
                <th style="text-align: center;width:14%;"
                    style="background-color:white;color:black; font-size:8px;background-color:lightgrey;padding:10px 10px;">
                    Merit Position
                </th>

            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>

                    <td class="table-data">
                        <?php echo e($result->exam_name); ?>

                    </td>
                    <td class="table-data">
                        <?php echo e($result->obtained_marks); ?>

                    </td>
                    <td class="table-data">
                        <?php echo e($result->height_marks); ?>

                    </td>
                    <td class="table-data" style="text-align: right">
                        <?php echo e($result->total_marks); ?>

                    </td>
                    <td class="table-data" style="text-align: right">
                        <?php echo e($result->satisfactory_mark); ?>

                    </td>
                    <td class="table-data" style="text-align: right">
                        <?php echo e($result->merit_position); ?>

                    </td>

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
    </table>

        
        <div class="divFooter" style="position: absolute; bottom: 5px;font-size:11px;text-align:center">
            <p style=""> Made By: codegigz
            </p>
        </div>

</body>

</html>
<?php /**PATH /home/codegigz/public_html/student_management/resources/views/admin/exam/studentResultPdf.blade.php ENDPATH**/ ?>