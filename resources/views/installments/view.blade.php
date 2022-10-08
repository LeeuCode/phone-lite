@extends('stander')

@section('title')
    {{ __('قسيمة قسط') }}-{{ $installment->customer->title }}
@endsection

@section('content')
    <div class="col-md-6 position-sticky sticky-top mt-3">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">{{ __('قسيمة قسط') }}-{{ $installment->customer->title }}</h3>
            </div>
            <!-- form start -->
            <div class="card-body">
                {{-- <form class="form-horizontal" action="{{ route('installments.store') }}" method="post">
					@csrf --}}

                <div class="form-group row">
                    <label for="barcode" class="col-md-3 control-label">{{ __('اسم العميل') }}</label>
                    <div class="col-md-8">
                        <select name="customer_id" class="form-control" id="customer_id" readonly required>
                            <option value="{{ $installment->customer->id }}">{{ $installment->customer->title }}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-3 control-label">{{ __('اسم الصنف') }}</label>
                    <div class="col-md-8">
                        <select name="item_id" class="form-control" id="item_id" required readonly>
                            <option value="{{ $installment->item_id }}">{{ $installment->item->title }}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="balance" class="col-md-3 control-label">{{ __('الكمية') }}</label>
                    <div class="col-md-4">
                        <input type="text" name="balance" class="form-control text-center"
                            value="{{ $installment->balance }}" id="balance" placeholder="00" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="quantity" class="col-md-3 control-label">{{ __('الكمية المباعة') }}</label>
                    <div class="col-md-4">
                        <input type="text" name="quantity" value="{{ $installment->quantity }}"
                            class="form-control text-center" id="quantity" placeholder="00" required readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="purchasing_price" class="col-md-3 control-label">{{ __('سعر بيع الكاش') }}</label>
                    <div class="col-md-4">
                        <input type="number" name="purchasing_price" value="{{ $installment->purchasing_price }}"
                            class="form-control text-center" id="purchasing_price" placeholder="00" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="installment_selling_price"
                        class="col-md-3 control-label">{{ __('سعر لبيع القسط') }}</label>
                    <div class="col-md-4">
                        <input type="number" name="installment_selling_price"
                            value="{{ $installment->installment_selling_price }}" class="form-control text-center"
                            id="installment_selling_price" placeholder="00" required readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="number_months" class="col-md-3 control-label">{{ __('عدد الاشهر') }}</label>
                    <div class="col-md-4">
                        <input type="number" name="number_months" min="1" max="12"
                            value="{{ $installment->number_months }}" class="form-control text-center" id="number_months"
                            placeholder="00" required readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="advance_purchase" class="col-md-3 control-label">{{ __('مقدم عند الشراء') }}</label>
                    <div class="col-md-4">
                        <input type="number" name="advance_purchase" value="{{ $installment->advance_purchase }}"
                            class="form-control text-center" id="advance_purchase" placeholder="00" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="premiums_paid" class="col-md-3 control-label">{{ __('الأقساط المدفوعه') }}</label>
                    <div class="col-md-4">
                        <input type="number" name="premiums_paid" value="{{ $installment->premiums_paid }}"
                            class="form-control text-center" id="premiums_paid" placeholder="00" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="interest_value" class="col-md-3 control-label">{{ __('قيمة الفائدة') }}</label>
                    <div class="col-md-4">
                        <input type="number" name="interest_value" value="{{ $installment->interest_value }}"
                            class="form-control text-center" id="interest_value" placeholder="00" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="remaining_installments"
                        class="col-md-3 control-label">{{ __('الاقساط المتبقيه') }}</label>
                    <div class="col-md-4">
                        <input type="number" name="remaining_installments"
                            value="{{ $installment->remaining_installments }}" class="form-control text-center"
                            id="remaining_installments" placeholder="00" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="monthly_installment" class="col-md-3 control-label">{{ __('القسط الشهري') }}</label>
                    <div class="col-md-4">
                        <input type="number" name="monthly_installment" value="{{ $installment->monthly_installment }}"
                            class="form-control text-center" id="monthly_installment" placeholder="00" readonly>
                    </div>
                </div>

                {{-- <button type="submit" class="btn btn-block btn-primary">{{ __('إنشاء قسيمة قسط جديد') }}</button>
				</form> --}}
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <div class="col-md-6 position-sticky sticky-top mt-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">{{ __('سداد الاقساط') }}</h3>
            </div>
            <!-- form start -->
            <div class="card-body p-0">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('الشهر') }}</th>
                            <th>{{ __('المبلغ') }}</th>
                            <th>{{ __('الحالة') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $monthsConut = $installment->months()->count();
                        @endphp
                        @if ($monthsConut)
                            @foreach ($installment->months()->get() as $ky => $month)
                                <tr>
                                    <td>{{ $ky + 1 }}</td>
                                    <td>{{ $month->renewal_date }}</td>
                                    <td>{{ $month->monthly_installment }}</td>
                                    <td>
                                        @if ($month->state == 0)
                                            <span
                                                class="float-right badge state bg-danger">{{ __('لم يتم السداد') }}</span>
                                        @else
                                            <span class="float-right badge bg-success">{{ __('تم التسديد') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form class=""
                                            action="{{ route('installments.debt.payment', ['id' => $month->id]) }}"
                                            method="post">
                                            @if ($month->state == 0)
                                                @csrf
                                                <button type="button" class="btn btn-sm btn-outline-success btn-save">
                                                    <i class="fa fa-money-check-alt"></i>
                                                </button>
                                            @endif
                                            <a href="{{ route('installments.print', ['id' => $month->id]) }}"
                                                class="btn btn-sm btn-outline-info print-installment">
                                                <i class="fa fa-print"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-category">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="fas fa-edit"></i>
                        <span class="title">{{ __('تعديل') }}</span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="create-category" action="{{ route('ajax.createUser') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="type" value="customer">
                        <div class="form-group">
                            <label for="barcode" class="control-label">{{ __('اسم عميل') }}</label>
                            <input type="text" name="title" class="form-control" id="barcode"
                                placeholder="{{ __('اكتب العنوان هنا') }}">
                        </div>

                        <div class="form-group">
                            <label for="barcode" class="control-label">{{ __('رقم المحمول') }}</label>
                            <input type="text" name="phone" class="form-control" id="barcode"
                                placeholder="{{ __('أكتب رقم تليفون العميل') }}">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('إغلاق') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    @include('installments.print', ['continar_ID' => 'installment-print-page'])

@endsection

@section('js')
    <script>
        (function($) {

            $(document).on('click', '.btn-save', function(e) {
                e.preventDefault();
                var form = $(this).parent(),
                    url = form.attr('action'),
                    tr = $(this).parent().parent().parent(),
                    btn = $(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.post(url, function(data, status) {
                    var state = tr.find('.state');
                    state.removeClass('bg-danger').addClass('bg-success').text('تم التسديد');

                    setInstallmentPrintData(data);

                    btn.remove();

                    $("#installment-print-page").printThis({
                        debug: false,
                        importCSS: false,
                        loadCSS: "{{ asset('dist/css/print-installments.css') }}",
                        // header: "<h1>Look at all of my kitties!</h1>"
                    });
                });
            });

            $(document).on('click', '.print-installment', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.get(url, function(data, status) {
                    console.log(data);
                    setInstallmentPrintData(data);

                    $("#installment-print-page").printThis({
                        debug: false,
                        importCSS: false,
                        loadCSS: "{{ asset('dist/css/print-installments.css') }}",
                        // header: "<h1>Look at all of my kitties!</h1>"
                    });
                });
            });

            $(document).on('click', '.test', function() {
                $("#ticket").printThis({
                    debug: false,
                    importCSS: false,
                    loadCSS: "{{ asset('dist/css/print-installments.css') }}",
                    // header: "<h1>Look at all of my kitties!</h1>"
                });
            });
        })(jQuery)
    </script>
@endsection
