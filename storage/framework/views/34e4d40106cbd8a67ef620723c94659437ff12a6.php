<?php echo $__env->make('errors.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('page-content'); ?>
<?php echo $__env->make('errors.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/errors/layout/layout.blade.php ENDPATH**/ ?>