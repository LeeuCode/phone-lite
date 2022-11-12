<div class="modal fade" id="deues-model-cache">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fa fa-money-bill-alt"></i>
                    <span class="title">{{ __('تحصيل فاتورة أجال') }}</span>
                    {{-- <span class="text-info">({{ $category->title }})</span> --}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="invoice-dues-pay" action="{{ route('invoice.dues.pay') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="invoice-id-model" class="control-label">{{ __('رقم الفاتورة') }}</label>
                        <select name="invoice_id" class="form-control" id="invoice-id-model" required>
                            @php
                                $invoices = App\Models\Invoice::where('movement_type', 'dues')->get();
                            @endphp
                            <option value="">{{ __('رقم الفاتورة') }}</option>
                            @foreach ($invoices as $invoice)
                                <option value="{{ $invoice->id }}">{{ $invoice->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="remaining-amount-model" class="control-label">{{ __('المطلوب') }}</label>
                        <input name="remaining_amount" class="form-control" id="remaining-amount-model" readonly>
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
