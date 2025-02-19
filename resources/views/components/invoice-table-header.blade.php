@php

$show = false;

if (request()->routeIs('invoices.purchase')) {
    $show = true;
}

if (isset($invoice)) {
    $inv = $invoice;

    if ($invoice->invoice_type == 'purchase') {
        $show = true;
    }
} else {
    $inv = '';
}

@endphp
<tr>
    <th class="text-center">{{ __('باركود الصنف') }}</th>
    <th class="text-center">{{ __('اسم الصنف') }}</th>
    <th class="text-center">{{ __('رصيد المخزن') }}</th>
    <th class="purchasing text-center" {!! !$show ? 'style="display: none;"' : '' !!}>{{ __('س. شراء') }}</th>
    <th class="text-center">{{ __('س. بيع') }}</th>
    <th class="text-center">{{ __('الكمية') }}</th>
    <th class="text-center">{{ __('الإجمالي') }}</th>
    <th class="text-center" style="width: 40px"><i class="fas fa-times"></i></th>
</tr>
