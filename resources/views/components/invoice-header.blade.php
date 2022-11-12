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

<input type="hidden" name="date" value="{{ date('Y-m-d') }}">
<div class="col-md-12 mt-3 position-sticky sticky-md-top sticky-xl-top">
    <div class="card card-primary">
        <!-- form start -->
        <div class="card-body row">
            <div class="col-xl-1 col-md-2 col-3">
                <div class="form-group">
                    <label for="id" class="control-label small">{{ __('Invoice') }}</label>
                    <input class="form-control form-control-sm text-center p-0" id="id"
                        value="{{ $id }}" readonly placeholder="00">
                </div>
            </div>

            @if (!isset($view))
                <div class="col-xl-2 col-md-3 col-4">
                    <div class="form-group">
                        <label for="id" class="control-label small">{{ __('Item barcode') }}</label>
                        <input type="number" class="p-0 form-control form-control-sm text-center barcode"
                            id="id" placeholder="00" autofocus="true" autocomplete="off">
                    </div>
                </div>
            @endif

            @if (!isset($view))
                <div class="col-xl-3 col-md-5 col-5">
                    <div class="form-group">
                        <label for="id" class="control-label small">{{ __('Item Name') }}</label>
                        <select class="form-control form-control-sm" id="item-name">
                            <option value="">
                                {{ __('Write the name of the item if you don\'t remember the barcode') }}</option>
                        </select>
                    </div>
                </div>
            @endif

            <div class="col-xl-1 col-md-2 col-3 p-0">
                <div class="form-group">
                    <label for="invoice_type" class="control-label small">{{ __('Invoice type') }}</label>
                    <select name="invoice_type" class="form-control form-control-sm" id="invoice_type">
                        @foreach (invoiceType() as $key => $value)
                            @php
                                if (is_object($inv)) {
                                    $selected = $inv->invoice_type == $key ? 'selected' : '';
                                } else {
                                    $selected = request()->routeIs('invoices.' . $key) ? 'selected' : '';
                                }
                            @endphp
                            <option value="{{ $key }}" {!! $selected !!}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xl-1 col-md-2 col-3 p-0 pl-3">
                <div class="form-group">
                    <label for="movement_type" class="control-label small">{{ __('Movement type') }}</label>
                    <select name="movement_type" class="form-control form-control-sm" id="movement_type">
                        @foreach (movementType() as $key => $value)
                            @php
                                if (is_object($inv)) {
                                    $selected = $inv->movement_type == $key ? 'selected' : '';
                                } else {
                                    $selected = '';
                                }
                            @endphp
                            <option value="{{ $key }}" {!! $selected !!}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 col-6 dues">
                <div class="form-group row m-0">
                    <div class="col-md-11 col-10 p-0">
                        <label for="agentName" class="control-label small agentName">
                            {{ request()->routeIs('invoices.purchase') ? __('Supplier name') : __('Client name') }}
                            {{-- __('اسم المورد') --}}
                        </label>

                        @php
                            $selectOption = '';
                            
                            if (is_object($inv)) {
                                $agentType = $inv->invoice_type == 'sale' ? 'customer_id' : 'supplier_id';
                            
                                if (isset($inv->customer_id)) {
                                    $selectOption = '<option value="' . $inv->customer_id . '" selected>' . $inv->customer->title . '</option>';
                                }
                            } else {
                                $agentType = request()->routeIs('invoices.purchase') ? 'supplier_id' : 'customer_id';
                            }
                        @endphp

                        <select name="customer_id" class="form-control form-control-sm wh-100 user-type"
                            id="{{ $agentType }}" placeholder="{{ __('اختار من هنا.....') }}">
                            {!! $selectOption !!}
                        </select>
                    </div>
                    <div class="col-md-1 col-2 p-0">
                        <label for="agentName" class="control-label small text-white">.</label>
                        <button type="button" class="btn bg-light input-group-prepend" data-toggle="modal"
                            data-target="#add-cutomer">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <label for="movement_type" class="control-label small">{{ __('Invoice date') }}</label>
                <input class="form-control form-control-sm text-center p-0" id="id"
                    value="{{ isset($inv->created_at) ? date('d-m-Y', strtotime($inv->created_at)) : date('d-m-Y') }}"
                    disabled>
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
        (function($) {
            select2Ajax('#item-name', '{{ route('ajax.getItems') }}');

            // select2Ajax('#customer_id', '{{ route('ajax.getCustomers') }}');

            // select2Ajax('#supplier_id', '{{ route('ajax.getSuppliers') }}');

            $(document).on('change', '#invoice_type', function() {
                $("#supplier_id, #customer_id").empty();
                invoiceType();
            });

            $('#item-name').on('select2:select', function(e) {
                var data = e.params.data;

                createTr("{{ route('ajax.getItem') }}", data.barcode);
                $(this).val('');
            });

            $(document).on('submit', '.create-user', function(e) {
                e.preventDefault();
                var url = $(this).attr('action'),
                    data = $(this).serialize();

                $.post(url, data, function(data, status) {
                    $('input[name=title] , input[name=phone]').val('');
                    $('#add-category').modal('hide');
                });
            });
        })(jQuery)
    </script>
@endsection
