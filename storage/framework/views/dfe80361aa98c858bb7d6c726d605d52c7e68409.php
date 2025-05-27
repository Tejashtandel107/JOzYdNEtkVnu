    <!-- CORE PLUGINS-->
    <?php echo Html::script('/assets/app/vendors/jquery/dist/jquery.min.js'); ?>

    <?php echo Html::script('/assets/app/vendors/popper.js/dist/umd/popper.min.js'); ?>

    <?php echo Html::script('/assets/app/js/plugin/jquery.notification.min.js'); ?>

    <?php echo Html::script('/assets/app/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>

    <?php echo Html::script('/assets/app/vendors/toastr/toastr.min.js'); ?>

    <!-- PAGE LEVEL PLUGINS-->
    <?php echo $__env->yieldContent('plugin-scripts'); ?>
    <!-- CORE SCRIPTS-->
    <!-- CORE SCRIPTS-->
    <?php echo Html::script('/assets/app/js/app.js'); ?>

    <!-- PAGE LEVEL SCRIPTS-->
    <?php echo $__env->yieldContent('page-scripts'); ?>
    </body>
</html>
<?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/web/layouts/login/includes/footer.blade.php ENDPATH**/ ?>