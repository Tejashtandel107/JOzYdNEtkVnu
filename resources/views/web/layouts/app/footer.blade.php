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
    {!! Html::script('/assets/app/vendors/jquery/dist/jquery.min.js') !!}
    {!! Html::script('/assets/app/vendors/popper.js/dist/umd/popper.min.js') !!}
    {!! Html::script('/assets/app/vendors/bootstrap/dist/js/bootstrap.min.js') !!}
    {!! Html::script('/assets/app/vendors/metisMenu/dist/metisMenu.min.js') !!}
    {!! Html::script('/assets/app/vendors/jquery-slimscroll/jquery.slimscroll.min.js') !!}
    {!! Html::script('/assets/app/vendors/toastr/toastr.min.js') !!}
    {!! Html::script('/assets/app/js/plugin/jquery.notification.js') !!}
    {!! Html::script('/assets/app/js/plugin/jquery.form.min.js') !!}
    <!-- PAGE LEVEL PLUGINS-->
    @yield('plugin-scripts')
    <!-- CORE SCRIPTS-->
    {!! Html::script('/assets/web/js/app.js') !!}
    <!-- PAGE LEVEL SCRIPTS-->
    @yield('page-scripts')
    </body>
</html>
