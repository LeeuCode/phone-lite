@php
if (isset($invoice)) {
    $inv = $invoice;
} else {
    $inv = '';
}
@endphp
<div class="col-md-2">
    <div class="card card-primary">
        <!-- form start -->
        <div class="card-body">
            <div class="form-group">
                <label for="total" class="control-label small">{{ __('الاجمالي') }}</label>
                <input type="number" name="total" value="{{ getVal($inv, 'total') }}"
                    class="form-control form-control-sm text-center totalItems" id="total" placeholder="00" readonly>
            </div>
            <div class="form-group">
                <label for="discount_amount" class="control-label small">{{ __('خصم مبلغ') }}</label>
                <input type="number" name="discount_amount"
                    class="form-control form-control-sm text-center discount_amount"
                    value="{{ getVal($inv, 'discount_amount') }}" id="discount_amount" placeholder="00"
                    {!! isset($view) ? 'readonly' : '' !!}>
            </div>
            <div class="form-group d-none">
                <label for="discount_percentage" class="control-label small">{{ __('خصم بالنسبه') }}</label>
                <input type="number" name="discount_percentage" class="form-control form-control-sm text-center"
                    id="discount_percentage" value="{{ getVal($inv, 'discount_percentage') }}" placeholder="00"
                    {!! isset($view) ? 'readonly' : '' !!}>
            </div>
            <div class="form-group">
                <label for="total_discount" class="control-label small">{{ __('اجمالي بعد الخصم') }}</label>
                <input type="number" name="total_discount"
                    class="form-control form-control-sm text-center total_discount" id="total_discount"
                    value="{{ getVal($inv, 'total_discount') }}" placeholder="00" readonly>
            </div>

            <div class="form-group">
                <label for="tax_rate" class="control-label small">{{ __('نسبة الضريبه') }}</label>
                <input type="text" name="tax_rate" class="form-control form-control-sm text-center"
                    value="{{ getVal($inv, 'tax_rate') }}" id="tax_rate" placeholder="00" {!! isset($view) ? 'readonly' : '' !!}>
            </div>
            <div class="form-group">
                <label for="tax_value" class="control-label small">{{ __('قيمة الضريبه') }}</label>
                <input type="text" name="tax_value" class="form-control form-control-sm text-center"
                    value="{{ getVal($inv, 'tax_value') }}" id="tax_value" readonly placeholder="00"
                    {!! isset($view) ? 'readonly' : '' !!}>
            </div>
            <div class="form-group">
                <label for="total_tax" class="control-label small">{{ __('إجمالي بعد الضريبه') }}</label>
                <input type="text" name="total_tax" class="form-control form-control-sm text-center" id="total_tax"
                    readonly value="{{ getVal($inv, 'total_tax') }}" placeholder="00" {!! isset($view) ? 'readonly' : '' !!}>
            </div>

            @if (isset($inv->paid))    
                <div class="form-group">
                    <label for="total_tax" class="control-label small">{{ __('المدفوع') }}</label>
                    <input type="text" class="form-control form-control-sm text-center" id="total_tax"
                        readonly value="{{ $inv->paid }}" disabled>
                </div>
            @endif

            @if (isset($inv->residual))    
                <div class="form-group">
                    <label for="total_tax" class="control-label small">
                        {{ ($inv->total_bill > $inv->paid) ? __('المتبقي') : __('الباقي') }}
                    </label>
                    <input type="text" class="form-control form-control-sm text-center" id="total_tax"
                        readonly value="{{ $inv->residual }}" disabled>
                </div>
            @endif

            <button type="submit" class="btn btn-info btn-block" name="button">
                <i class="fa fa-save"></i>
                حفظ
            </button>
        </div>
        <!-- /.card-body -->
    </div>
</div>
