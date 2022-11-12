<div class="modal fade" id="customer-cash-collection-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fas fa-money-check-alt"></i>
                    <span class="title">{{ __('تحصيل نقدية') }}</span>
                    {{-- <span class="text-info">({{ $category->title }})</span> --}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="cash-collection-submit" action="{{ route('settlement.save') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="customer-type-model" class="control-label">{{ __('النوع') }}</label>
                        <select name="customer_type" class="form-control" id="customer-type-model" required>
                            <option value="">{{ __('اختار عميل \ مورد') }}</option>
                            <option value="customer">{{ __('عميل') }}</option>
                            <option value="supplier">{{ __('مورد') }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label id="customer-type"
                            class="control-label">{{ __('النوع') }}</label>
                        <select name="customer_id" class="form-control customer_model_id" id="" required>
                            <option value="">{{ __('اختار') }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amount-model" class="control-label">{{ __('المطلوب') }}</label>
                        <input name="amount" class="form-control" id="amount-model" readonly>
                    </div>

                    <div class="form-group">
                        <label for="invoice-paid-model" class="control-label">{{ __('المدفوع') }}</label>
                        <input name="paid" class="form-control" id="invoice-paid-model" required>
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

