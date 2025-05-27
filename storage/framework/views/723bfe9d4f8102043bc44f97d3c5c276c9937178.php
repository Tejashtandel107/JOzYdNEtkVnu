<?php
    $application_name = config('app.name');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<meta name="author" content="">
	<title><?php echo $__env->yieldContent('pagetitle'); ?> : <?php echo e($application_name); ?></title>
	<?php echo e(Html::style('/assets/app/vendors/bootstrap/dist/css/bootstrap.min.css')); ?>

	<?php echo e(Html::style('https://use.fontawesome.com/releases/v5.8.1/css/all.css',['integrity'=>'sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf','crossorigin'=>'anonymous'])); ?>

    <?php echo e(Html::style('/assets/admin/css/main.css')); ?>

    
    <?php echo $__env->yieldContent('page-css'); ?>
</head>
<body>
    <div class="error-content flexbox">
            <?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/errors/includes/header.blade.php ENDPATH**/ ?>