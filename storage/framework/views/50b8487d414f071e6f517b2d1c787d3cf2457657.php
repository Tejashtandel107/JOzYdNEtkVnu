            <!-- END PAGE CONTENT-->
            <footer class="noprint page-footer">
                <div class="noprint to-top"><i class="fa fa-chevron-up"></i></div>
            </footer>
        </div>
    </div>
    <!-- END SEARCH PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
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

    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <?php echo $__env->yieldContent('plugin-scripts'); ?>
    <!-- CORE SCRIPTS-->
    <?php echo Html::script('/assets/admin/js/app.js'); ?>

    <!-- PAGE LEVEL SCRIPTS-->
    <?php echo $__env->yieldContent('page-scripts'); ?>
    </body>
</html>
<?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/admin/layouts/app/footer.blade.php ENDPATH**/ ?>