@extends('stander')

@section('title')
    {{ __('فواتير') . ' ' . __('البيع') }}
@endsection

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <a href="{{ route('invoices.sale') }}" class="btn btn-info mt-3 mr-3">
        <i class="fa fa-plus"></i>
        {{ __('انشاء فتورة بيع جديده') }}
    </a>

    {{-- <a href="{{ route('item.create') }}" data-toggle="modal" data-target="#modal-search" class="btn btn-outline-primary mt-3"
        style="margin-right: auto;margin-left:1rem;">
        <i class="fa fa-search"></i>
        {{ __('البحث عن فاتورة') }}
    </a> --}}

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body p-0">
                @include('components.invoice-table')
            </div>
        </div>
    </div>

    <!-- form start -->
    <form class="m-0" action="{{ route('item.search') }}" method="get">
        <div class="modal fade" id="modal-search">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('البحث عن فاتورة') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">

                        <div class="col-md-3 form-group">
                            <label for="id" class="control-label small">{{ __('رقم الفاتورة') }}</label>
                            <input type="number" name="barcode" class="form-control text-center" id="barcode"
                                placeholder="00">
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="id" class="control-label small">{{ __('نوع الحركه') }}</label>
                            <select name="invoice_type" class="form-control" id="invoice_type">
                                @foreach (invoiceType() as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
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
