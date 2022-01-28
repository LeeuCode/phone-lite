
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

@include('components.dues-modal')

@include('installments.print', ['id' => 'installment-print-page-modal'])

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

<!-- printThis -->
<script src="{{ asset('dist/js/printThis.js') }}" charset="utf-8"></script>
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

    // Get installment months
    $(document).on('change', '#installment-customer-id-modal', function(){
      var customerID = $(this).val();

      $('#installment-month-id-model').html('<option value="">{{ __('اختار الشهر') }}</option>');

      $.get('{{ route('ajax.installment.user') }}',{id: customerID}, function(data, status){
        $('#installment-item-id-model').html(data);
      });
    });

    $(document).on('change', '#installment-item-id-model', function(){
      var installmentID = $(this).val();

      $.get('{{ route('ajax.months.installment') }}',{id: installmentID}, function(data, status){
        $('#installment-month-id-model').html(data);
      });
    });

    // Pay the installment from modal in public.
    $(document).on('submit', '.installment-tack', function(e){
      e.preventDefault();
      var url = $(this).attr('action'),
          monthID = $('#installment-month-id-model').val();

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.post(url,{id: monthID}, function(data, status) {
        $('#installment-customer-id-modal option:eq(1)').prop('selected', true);
        // $('#installment-item-id-model').html('<option value="">{{ __('اختر من الاجهزة') }}</option>');
        // $('#installment-month-id-model').html('<option value="">{{ __('اختار الشهر') }}</option>');
        $('#installment-collection').modal('hide');

        setInstallmentPrintData(data);

        $("#installment-print-page-modal").printThis({
          debug: false,
          importCSS: false,
          loadCSS: "{{ asset('dist/css/print-installments.css') }}",
          // header: "<h1>Look at all of my kitties!</h1>"
        });
      });
    });

    // Get invoice remaining amount by id.
    $(document).on('change', '#invoice-id-model', function () {
      var invoivcID = $(this).val();

      $.get('{{ route('ajax.invoice.remaining.amount') }}',{id: invoivcID}, function(data, status) {
        $('#remaining-amount-model').val(data.remaining_amount);
      });
    });

    // Pay invoice dues.
    $(document).on('submit', '.invoice-dues-pay', function (e) {
      e.preventDefault();
      var url = $(this).attr('action'),
          invoiceID = $('#invoice-id-model').val(),
          paid = $('#invoice-paid-model').val();

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.post(url,{id: invoiceID, paid: paid}, function(data, status) {

        $('#remaining-amount-model').val('');
        $('#invoice-paid-model').val('');
        $('#deues-model-cache').modal('hide');

        Swal.fire(
          '{{ __('عملية ناجحة') }}',
          '{{ __('تم تسديد الفاتورة بنجاح!') }}',
          'success'
        );
      });
    });

  })(jQuery)
</script>
@yield('js')
</body>
</html>
