@extends('stander')

@section('title')
    {{ __('فواتير') . ' ' . __('المرتجع') }}
@endsection

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <a href="{{ route('item.create') }}" class="btn btn-info mt-3 mr-3">
        <i class="fa fa-plus"></i>
        {{ __('انشاء فتورة مرتجع جديده') }}
    </a>

    <a href="{{ route('item.create') }}" data-toggle="modal" data-target="#modal-search" class="btn btn-outline-primary mt-3"
        style="margin-right: auto;margin-left:1rem;">
        <i class="fa fa-search"></i>
        {{ __('البحث عن فاتورة') }}
    </a>

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body p-0">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th>{{ __('رقم الفاتوره') }}</th>
                            <th>{{ __('نوع الحركه') }}</th>
                            <th>{{ __('العميل/المورد') }}</th>
                            <th>{{ __('الاجمالي') }}</th>
                            <th>{{ __('خصم مبلغ') }}</th>
                            <th>{{ __('اجمالي بعد الخصم') }}</th>
                            <th>{{ __('نسبة الضريبه') }}</th>
                            <th>{{ __('إجمالي بعد الضريبه') }}</th>
                            {{-- <th>{{ __('متوسط سعر البيع') }}</th> --}}
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ movementType($invoice->movement_type) }}</td>
                                <td>{{ isset($invoice->customer->name) ? $invoice->customer->name : __('لا يوجد') }}</td>
                                <td>{{ $invoice->total }}</td>
                                <td>{{ $invoice->discount_amount }}</td>
                                <td>{{ $invoice->total_discount }}</td>
                                <td>{{ $invoice->tax_rate }}</td>
                                <td>{{ $invoice->total_bill }}</td>
                                {{-- <td>{{ $item->average_price }}</td> --}}
                                <td>
                                    {{-- <form action="{{ route('item.status', ['id' => $invoice->id]) }}" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف العنصر؟!') }}')" method="post"> --}}
                                    {{-- @csrf --}}
                                    <a href="{{ route('invoices.edit', ['id' => $invoice->id]) }}"
                                        class="btn btn-outline-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('invoices.view', ['id' => $invoice->id]) }}"
                                        class="btn btn-outline-success">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    {{-- </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @if ($invoices->hasPages())
                        <tfoot>
                            <tr>
                                <td colspan="9">
                                    {{ $invoices->links() }}
                                </td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <!-- form start -->
    <form class="m-0" action="{{ route('item.search') }}" method="get">
        <div class="modal fade" id="modal-search">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('البحث عن الأصناف') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="id" class="control-label small">{{ __('باركود الصنف') }}</label>
                            <input type="number" name="barcode" class="form-control text-center" id="barcode"
                                placeholder="00">
                        </div>

                        <div class="form-group">
                            <label for="id" class="control-label small">{{ __('اسم الصنف') }}</label>
                            <input type="text" name="title" class="form-control" id="title"
                                placeholder="{{ __('أكتب اسم الصنف اذا لم تتذكر الباركود') }}" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="type" class="control-label small">{{ __('القسم') }}</label>
                            <select name="cat_id" class="form-control" id="cat_id">
                                <option value="" selected>{{ __('اختار القسم') }}...</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type" class="control-label small">{{ __('الموديل') }}</label>
                            <select name="model" class="form-control" id="model">
                                <option value="" selected>{{ __('اختار الموديل') }}...</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type" class="control-label small">{{ __('وحدة المنتج') }}</label>
                            <select name="unit_id" class="form-control" id="unit_id">
                                <option value="" selected>{{ __('اختار الوحده') }}...</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('إغلاق') }}</button>
                        <button type="submit" class="btn btn-info">{{ __('البحث الان') }}</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        (function($) {
            select2Ajax('#cat_id', '{{ route('ajax.getCategories') }}');

            select2Ajax('#model', '{{ route('ajax.getModels') }}');

            select2Ajax('#unit_id', '{{ route('ajax.getunities') }}');


            // $(window).keydown(function(event){
            //   if(event.keyCode == 13) {
            //     event.preventDefault();
            //     return false;
            //   }
            // });
        })(jQuery)
    </script>
@endsection
