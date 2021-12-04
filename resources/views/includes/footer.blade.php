
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      V1.0.0
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020-{{ date('Y') }} <a href="https://adminlte.io">{{ __('LeeuCode') }}</a>.</strong> {{ __('جميع الحقوق محفوظة') }}.
  </footer>
</div>
<!-- ./wrapper -->

@include('components.installment-collection-modal')

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('dist/js/app.js') }}" charset="utf-8"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  (function($){
    select2Ajax('#customer_id', '{{ route('ajax.getCustomers') }}');

    @if (\Session::has('success'))
    Swal.fire(
      '{{ __('عملية ناجحة') }}',
      '{!! \Session::get('success') !!}',
      'success'
    )
    @endif
  })(jQuery)
</script>
@yield('js')
</body>
</html>
