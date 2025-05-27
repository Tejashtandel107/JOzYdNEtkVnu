            <!-- END PAGE CONTENT-->
            <footer class="noprint page-footer">
                <div class="noprint to-top"><i class="fa fa-chevron-up"></i></div>
            </footer>
        </div>
    </div>
    <!-- END SEARCH PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop bg-white">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!--BEGIN MODEL WRAPPER-->
    <div id="modalwrp"></div>
    <!--END MODEL WRAPPER-->
    <!-- CORE PLUGINS-->
    <?php echo Html::script('/assets/app/vendors/jquery/dist/jquery.min.js'); ?>

    <?php echo Html::script('/assets/app/vendors/popper.js/dist/umd/popper.min.js'); ?>

    <?php echo Html::script('/assets/app/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>

    <?php echo Html::script('/assets/app/vendors/metisMenu/dist/metisMenu.min.js'); ?>

    <?php echo Html::script('/assets/app/vendors/jquery-slimscroll/jquery.slimscroll.min.js'); ?>

    <?php echo Html::script('/assets/app/vendors/toastr/toastr.min.js'); ?>

    <?php echo Html::script('/assets/app/js/plugin/jquery.notification.js'); ?>

    <?php echo Html::script('/assets/app/js/plugin/jquery.form.min.js'); ?>

    <!-- PAGE LEVEL PLUGINS-->
    <?php echo $__env->yieldContent('plugin-scripts'); ?>
    <!-- CORE SCRIPTS-->
    <?php echo Html::script('/assets/web/js/app.js'); ?>

    <!-- PAGE LEVEL SCRIPTS-->
    <?php echo $__env->yieldContent('page-scripts'); ?>
    </body>
</html>
<?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/web/layouts/app/footer.blade.php ENDPATH**/ ?>