@include('includes.header')

<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    
    @yield('breadcrumps')

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          	@yield('content')
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('includes.footer')