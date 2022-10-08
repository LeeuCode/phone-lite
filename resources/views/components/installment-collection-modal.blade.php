<div class="modal fade" id="installment-collection">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fa fa-hand-holding-usd"></i>
                    <span class="title">{{ __('تحصيل قسط') }}</span>
                    {{-- <span class="text-info">({{ $category->title }})</span> --}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="installment-tack" action="{{ route('month.payment.modal') }}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="type" value="category">
                    <div class="form-group">
                        <label for="installment-customer-id-modal" class="control-label">{{ __('اسم العميل') }}</label>
                        <select name="customer_id" class="form-control" id="installment-customer-id-modal" required>
                            @php
                                $customers = App\Models\Installment::distinct()
                                    ->select('installments.customer_id')
                                    ->get();
                            @endphp
                            <option value="">{{ __('أختار من العملاء') }}</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->customer_id }}">{{ $customer->customer->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="installment-item-id-model" class="control-label">{{ __('الصنف') }}</label>
                        <select name="installment_item_id" class="form-control" id="installment-item-id-model" required>
                            <option value="">{{ __('اختر من الاجهزة') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="installment-month-id-model" class="control-label">{{ __('دفع قسط شهر') }}</label>
                        <select name="month_id" class="form-control" id="installment-month-id-model" required>
                            <option value="">{{ __('اختار الشهر') }}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('إغلاق') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
                </div>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
