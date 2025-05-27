        <footer class="page-footer">
            <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
        </footer>
    </div>    
    <div class="sidenav-backdrop backdrop"></div>
    <!-- <div class="preloader-backdrop bg-white">
        <div class="page-preloader">Loading</div>
    </div>     -->
    {!! Html::script('/assets/app/vendors/jquery/dist/jquery.min.js') !!}
    {!! Html::script('/assets/app/vendors/popper.js/dist/umd/popper.min.js') !!}
    {!! Html::script('/assets/app/vendors/bootstrap/dist/js/bootstrap.min.js') !!}
    {!! Html::script('/assets/app/vendors/metisMenu/dist/metisMenu.min.js') !!}
    {!! Html::script('/assets/app/vendors/jquery-slimscroll/jquery.slimscroll.min.js') !!}
    {!! Html::script('/assets/admin/js/app.js') !!}
    
    @yield('page-scripts')
    </body>
</html>
