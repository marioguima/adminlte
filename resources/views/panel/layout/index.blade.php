<!DOCTYPE html>

<html>

{{-- Head --}}
@includeIf('panel.layout.head')

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <!-- Navbar -->
        @includeIf('panel.layout.navbar')

        <!-- Main Sidebar Container -->
        @includeIf('panel.layout.sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield("content")

        <!-- /.content-wrapper -->
        @includeIf('panel.layout.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

    </div>
    <!-- ./wrapper -->

    @includeIf('panel.layout.javascript')

    @yield('page_scripts')
</body>

</html>
