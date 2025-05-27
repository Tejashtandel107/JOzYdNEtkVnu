    <!-- CORE PLUGINS-->
    {!! Html::script('/assets/app/vendors/jquery/dist/jquery.min.js') !!}
    {!! Html::script('/assets/app/vendors/popper.js/dist/umd/popper.min.js') !!}
    {!! Html::script('/assets/app/js/plugin/jquery.notification.min.js') !!}
    {!! Html::script('/assets/app/vendors/bootstrap/dist/js/bootstrap.min.js') !!}
    {!! Html::script('/assets/app/vendors/toastr/toastr.min.js') !!}
    <!-- PAGE LEVEL PLUGINS-->
    @yield('plugin-scripts')
    <!-- CORE SCRIPTS-->
    <!-- CORE SCRIPTS-->
    {!! Html::script('/assets/app/js/app.js') !!}
    <!-- PAGE LEVEL SCRIPTS-->
    @yield('page-scripts')
    </body>
</html>
