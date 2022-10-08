@extends('stander')

@section('title')
    {{ __('أضافة قسيمة قسط جديدة') }}
@endsection

@section('content')
    <div class="col-md-6 ml-auto mr-auto mt-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ __('أضافة قسيمة قسط جديدة') }}</h3>
            </div>
            <!-- form start -->
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('installments.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                    <div class="form-group row">
                        <label for="barcode" class="col-md-3 control-label">{{ __('اسم العميل') }}</label>
                        <div class="col-md-8">
                            <select name="customer_id" class="form-control installment-customer-id" id="customer_id" required>
                                <option value="">{{ __('أختار من العملاء') }}</option>
                            </select>
                        </div>
                        <div class="col-md-1 p-0 d-flex">
                            <button type="button" class="add-cat btn bg-light" data-title="{{ __('أضافة اسم عميل جديد') }}"
                                data-type="customer" data-toggle="modal" data-target="#add-category">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-md-3 control-label">{{ __('اسم الصنف') }}</label>
                        <div class="col-md-8">
                            <select name="item_id" class="form-control" id="item_id" required>
                                <option value="">{{ __('اختار من الاصناف') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="balance" class="col-md-3 control-label">{{ __('الكمية') }}</label>
                        <div class="col-md-4">
                            <input type="text" name="balance" class="form-control text-center" id="balance"
                                placeholder="00" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="quantity" class="col-md-3 control-label">{{ __('الكمية المباعة') }}</label>
                        <div class="col-md-4">
                            <input type="text" name="quantity" class="form-control text-center" id="quantity"
                                placeholder="00" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="purchasing_price" class="col-md-3 control-label">{{ __('سعر بيع الكاش') }}</label>
                        <div class="col-md-4">
                            <input type="number" name="purchasing_price" class="form-control text-center"
                                id="purchasing_price" placeholder="00" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="installment_selling_price"
                            class="col-md-3 control-label">{{ __('سعر لبيع القسط') }}</label>
                        <div class="col-md-4">
                            <input type="number" name="installment_selling_price" class="form-control text-center"
                                id="installment_selling_price" placeholder="00" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="number_months" class="col-md-3 control-label">{{ __('عدد الاشهر') }}</label>
                        <div class="col-md-4">
                            <input type="number" name="number_months" min="1" max="12"
                                class="form-control text-center" id="number_months" placeholder="00" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="advance_purchase" class="col-md-3 control-label">{{ __('مقدم عند الشراء') }}</label>
                        <div class="col-md-4">
                            <input type="number" name="advance_purchase" class="form-control text-center"
                                id="advance_purchase" placeholder="00">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="premiums_paid" class="col-md-3 control-label">{{ __('الأقساط المدفوعه') }}</label>
                        <div class="col-md-4">
                            <input type="number" name="premiums_paid" class="form-control text-center" id="premiums_paid"
                                value="0" placeholder="00" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="interest_value" class="col-md-3 control-label">{{ __('قيمة الفائدة') }}</label>
                        <div class="col-md-4">
                            <input type="number" name="interest_value" class="form-control text-center"
                                id="interest_value" placeholder="00" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="remaining_installments"
                            class="col-md-3 control-label">{{ __('الاقساط المتبقيه') }}</label>
                        <div class="col-md-4">
                            <input type="number" name="remaining_installments" class="form-control text-center"
                                id="remaining_installments" placeholder="00" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="monthly_installment" class="col-md-3 control-label">{{ __('القسط الشهري') }}</label>
                        <div class="col-md-4">
                            <input type="number" name="monthly_installment" class="form-control text-center"
                                id="monthly_installment" placeholder="00" readonly>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-block btn-primary">{{ __('إنشاء قسيمة قسط جديد') }}</button>
                </form>
            </div>
            <!-- /.card-body -->
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

                <form class="create-user" action="{{ route('ajax.createUser') }}" method="post">
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
@endsection

@section('js')
    <script>
        (function($) {
            select2Ajax('#item_id', '{{ route('ajax.getItems') }}');

            select2Ajax('#installment-customer-id', '{{ route('ajax.getCustomers') }}');

            $(document).on('submit', '.create-user', function(e) {
                e.preventDefault();
                var url = $(this).attr('action'),
                    data = $(this).serialize();

                $.post(url, data, function(data, status) {
                    $('input[name=title] , input[name=phone]').val('');
                    $('#add-category').modal('hide');
                });
            });

            $(document).on('click', '.add-cat', function() {
                var title = $(this).data('title'),
                    type = $(this).data('type');

                $('.title').text(title);
                $('input[name=type]').val(type);
            });

            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            $('#item_id').on('select2:select', function(e) {
                var item = e.params.data;

                $.get("{{ route('ajax.getItem') }}", {
                    id: item.barcode
                }, function(data, status) {
                    var itemData = data.item;
                    $('#balance').data('balance', itemData.store_balance),
                        $('#balance').val(itemData.store_balance);
                    $('#purchasing_price').val(itemData.selling_price);
                    $('#installment_selling_price').val(itemData.selling_price);

                    clcQtInstallments();
                });
            });

            $(document).on('keyup', '#quantity', function() {
                clcQtInstallments();
            });

            $(document).on('keyup', '#number_months', function() {
                monthlyInstallment();
            });

            $(document).on('keyup', '#installment_selling_price', function() {
                clcQtInstallments();
            });

            $(document).on('keyup', '#advance_purchase', function() {
                clcQtInstallments();
            });

        })(jQuery)
    </script>
@endsection
