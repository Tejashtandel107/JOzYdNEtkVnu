<?php $__env->startSection('pagetitle'); ?>
Login
<?php $__env->stopSection(); ?>
<?php $__env->startSection('plugin-css'); ?>
    <?php echo e(Html::style('/assets/app/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')); ?>

    <?php echo e(Html::style('/assets/app/vendors/formvalidation/formValidation.min.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-css'); ?>
    <style type="text/css">
        small.error {
            font-size: 14px;
            color: #FFF;
            display: block;
            margin-top: 5px;
            background-color: #f87377;
            border-color: #f87377;
            position: relative;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
        }
        .alert h4{
            margin-bottom: 0px;
            font-size: 14px;
        }
        .login-content{
            max-width: 500px  !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagecontent'); ?>
    <div class="ibox login-content">
        <div class="text-center">
            <span class="auth-head-icon"><i class="la la-user"></i></span>
        </div>
        <div class="ibox-body">
            <div id="notify"></div>

            <form id="login-form" method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo e(csrf_field()); ?>

                <h4 class="font-strong text-center mb-5">LOG IN</h4>
                <div class="form-group mb-4<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <input class="form-control form-control-line" type="text" name="email" placeholder="Email or Username" value="<?php echo e(old('email')); ?>" autofocus>
                <?php if($errors->has('email')): ?>
                    <small class="error"><?php echo e($errors->first('email')); ?></small>
                <?php endif; ?>
                </div>
                <div class="form-group mb-4<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <input class="form-control form-control-line" type="password" name="password" placeholder="Password">
                    <?php if($errors->has('password')): ?>
                        <small class="error"><?php echo e($errors->first('password')); ?></small>
                    <?php endif; ?>
                </div>
                <div class="flexbox mb-5">
                    <span>
                        <label class="ui-switch switch-icon mr-2 mb-0">
                            <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <span></span>
                        </label>Remember
                    </span>
                    <a class="text-primary" href="<?php echo e(route('password.request')); ?>">Forgot password?</a>
                </div>
                <div class="text-center mb-4">
                    <button class="btn btn-primary btn-rounded btn-block" id="loginbtn">LOGIN</button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('plugin-scripts'); ?>
    <?php echo Html::script('/assets/app/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>

    <?php echo Html::script('/assets/app/js/plugin/jquery.form.min.js'); ?>

    <?php echo Html::script('/assets/app/vendors/formvalidation/formValidation.min.js'); ?>

    <?php echo Html::script('/assets/app/vendors/formvalidation/framework/bootstrap4.min.js'); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
    <script src="<?php echo e(URL::asset('/assets/web/js/login.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('web.layouts.login.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/auth/login.blade.php ENDPATH**/ ?>