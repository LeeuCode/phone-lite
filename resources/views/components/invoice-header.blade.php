@section('css')
  @parent
	<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@php
    if (isset($invoice)) {
      $inv = $invoice;
    } else {
      $inv = '';
    }
@endphp

<div class="col-md-12 mt-3 position-sticky sticky-top">
  <div class="card card-primary">
    <!-- form start -->
      <div class="card-body row">
        <div class="col-md-1">
          <div class="form-group">
            <label for="id" class="control-label small">{{ __('فاتورة') }}</label>
            <input class="form-control form-control-sm text-center p-0" id="id" value="{{ $id }}" readonly placeholder="00">
          </div>
        </div>

        @if (!isset($view))
          <div class="col-md-2">
            <div class="form-group">
              <label for="id" class="control-label small">{{ __('باركود الصنف') }}</label>
              <input type="number" class="p-0 form-control form-control-sm text-center barcode" id="id" placeholder="00" autofocus autocomplete="off">
            </div>
          </div>
        @endif

        @if (!isset($view))
          <div class="col-md-3">
            <div class="form-group">
              <label for="id" class="control-label small">{{ __('اسم الصنف') }}</label>
              <select class="form-control form-control-sm" id="item-name">
                <option value="">{{ __('أكتب اسم الصنف اذا لم تتذكر الباركود') }}</option>
              </select>
            </div>
          </div>
        @endif

        <div class="col-md-1 p-0">
          <div class="form-group">
              <label for="invoice_type" class="control-label small">{{ __('نوع الفاتوره') }}</label>
              <select name="invoice_type" class="form-control form-control-sm" id="invoice_type">
                @foreach (invoiceType() as $key => $value)
                  @php
                  if(is_object($inv)) {
                    $selected = ($inv->invoice_type == $key) ? 'selected' : '' ;
                  } else {
                    $selected = (request()->routeIs('invoices.'.$key)) ? 'selected' : '' ;
                  }
                  @endphp
                  <option value="{{ $key }}" {!! $selected !!} >{{ $value }}</option>
                @endforeach
              </select>
          </div>
        </div>

        <div class="col-md-1 p-0 pl-3">
          <div class="form-group">
            <label for="movement_type" class="control-label small">{{ __('نوع الحركه') }}</label>
              <select name="movement_type" class="form-control form-control-sm" id="movement_type">
                @foreach (movementType() as $key => $value)
                  @php
                  if(is_object($inv)) {
                    $selected = ($inv->movement_type == $key) ? 'selected' : '' ;
                  } else {
                    $selected = '';
                  }
                  @endphp
                  <option value="{{ $key }}" {!! $selected !!}>{{ $value }}</option>
                @endforeach
              </select>
          </div>
        </div>

        <div class="col-md-3 purchasing" {!! (!request()->routeIs('invoices.purchase')) ? 'style="display: none;"' : '' !!}>
          <div class="form-group">
            <label for="agentName" class="control-label small">{{ __('اسم العميل') }}</label>
            <div class="input-group">
              <select class="form-control form-control-sm input-group-prepend" id="agentName">
                <option value="">{{ __('أكتب اسم الصنف اذا لم تتذكر الباركود') }}</option>
              </select>
              <button type="button" class="add-cat btn bg-light input-group-prepend" data-title="أضف جهاز جديد" data-type="devices" data-toggle="modal" data-target="#add-category">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
  </div>
</div>

@section('js')
  @parent
  <!-- Select2 -->
	<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
  <script type="text/javascript">
    (function($){
      select2Ajax('#item-name', '{{ route('ajax.getItems') }}');

      $(document).on('change', '#item-name', function() {
        // alert($(this).val())
      })

      $('#item-name').on('select2:select', function (e) {
          var data = e.params.data;

          console.log(data);
          createTr("{{ route('ajax.getItem') }}", data.barcode);
          $(this).val('');
      });
    })(jQuery)
  </script>
@endsection
