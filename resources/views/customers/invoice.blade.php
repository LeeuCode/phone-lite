@php

if ($user->type == 'customer') {
    $text = 'customers.profile';
}else {
    $text = 'suppliers.profile';
}
    
@endphp

@section('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@extends($text)

@section('user-content')
    <div class="col-md-12 mt-3">
        {{-- <div class="card">
            <div class="card-body "> --}}
                <form class="row p-0 m-0 wh-100" action="{{ route('customer.invoice', ['id' => $user->id]) }}" method="get">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title" class="control-label">{{ __('تاريخ اليوم') }}</label>
                            <input class="form-control date" name="from" id="from">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="title" class="control-label text-white">.</label>
                            <br>
                            <button type="submit" name="result" value="yes" class="btn btn-success">
                                {{ __('أصدار  تقرير مفصل') }}
                            </button>
                        </div>
                    </div>
                    {{-- <div class="col-md-2">
                        <div class="form-group">
                            <label for="title" class="control-label text-white">.</label>
                            <br>
                            <button type="submit" class="btn btn-primary">
                                {{ __('أصدار  تقرير سريع') }}
                            </button>
                        </div>
                    </div> --}}

                    <div class="col-md-5 d-flex align-items-center flex-row-reverse">
                        <button type="button" class="mb-2 mt-3 btn btn-info float-right print">
                            <i class="fa fa-print" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            {{-- </div>
        </div> --}}
    </div>

    <div style="width: 50%">
        @if (isset($_GET['from']) && count($invoiceItem) > 0)
            @include('customers.print', ['continar_ID' => 'taket', 'title' => 'فاتورة بيع العميل'])
        @endif
    </div>
@endsection

@section('js')
    <!-- InputMask -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- printThis -->
    <script src="{{ asset('dist/js/printThis.js') }}" charset="utf-8"></script>

    <script>
        (function($) {
            //Date range picker with time picker
            $('.date').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                timePickerIncrement: 30,
                format: 'LT',
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });

            $(document).on('click', '.print', function() {
                $("#taket").printThis({
                    debug: false,
                    importCSS: false,
                    loadCSS: "{{ asset('dist/css/print-installments.css') }}",
                });
            });
        })(jQuery)
    </script>
@endsection