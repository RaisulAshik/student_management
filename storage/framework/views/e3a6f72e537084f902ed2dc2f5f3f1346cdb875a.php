<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <! — csrf token → -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title>Shadowaidelifeline</title>
        <!-- <! — styles → -->
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

    </head>
    <body>
        <div id="app"></div>
        <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    </body>
</html><?php /**PATH /home/codegroover/public_html/student_management/resources/views/app.blade.php ENDPATH**/ ?>