<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name')); ?> : <?php echo $__env->yieldContent('pagetitle'); ?></title>
    <!-- GLOBAL MAINLY STYLES-->
    <?php echo e(Html::style('/assets/app/vendors/bootstrap/dist/css/bootstrap.min.css')); ?>

    <?php echo e(Html::style('/assets/app/vendors/line-awesome/css/line-awesome.min.css')); ?>

    <?php echo e(Html::style('https://use.fontawesome.com/releases/v5.8.1/css/all.css',['integrity'=>'sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf','crossorigin'=>'anonymous'])); ?>

    <?php echo e(Html::style('/assets/app/vendors/themify-icons/css/themify-icons.css')); ?>

	<?php echo e(Html::style('/assets/app/vendors/animate.css/animate.min.css')); ?>

    <!-- PLUGINS STYLES-->
	<?php echo $__env->yieldContent('plugin-css'); ?>
    <!-- THEME STYLES-->
    <?php echo e(Html::style('/assets/admin/css/main.css')); ?>

    <?php echo e(Html::style('/assets/admin/css/themes/gradient-blue.css')); ?>

    <!-- PAGE LEVEL STYLES-->
	<?php echo $__env->yieldContent('page-css'); ?>
    <style>
        body {
            background-repeat: no-repeat;
            background-size: cover;
            /*background-color: #18c5a9;*/
            background-image: linear-gradient(45deg,#35c9ff 0,#69f0ae 100%)!important;
        }
        .cover {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            /*background-color: rgba(117, 54, 230, .1);*/
            background-image: linear-gradient(45deg,#35c9ff 0,#69f0ae 100%)!important;
        }
        .login-content {
            max-width: 400px;
            margin: 100px auto 50px;
        }
        .auth-head-icon {
            position: relative;
            height: 60px;
            width: 60px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            background-color: #fff;
            color: #5c6bc0;
            box-shadow: 0 5px 20px #d6dee4;
            border-radius: 50%;
            transform: translateY(-50%);
            z-index: 2;
        }
    </style>
</head>
<body>
    <div class="cover"></div>
<?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/web/layouts/login/includes/header.blade.php ENDPATH**/ ?>