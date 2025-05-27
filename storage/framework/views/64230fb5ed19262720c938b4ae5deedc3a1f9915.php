<?php echo $__env->make('admin.layouts.app.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('pagecontent'); ?>
<?php echo $__env->make('admin.layouts.app.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/admin/layouts/app.blade.php ENDPATH**/ ?>