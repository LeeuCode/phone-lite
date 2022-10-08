@include('components.print-header', ['continarID' => $continar_ID, '_title' => $title])

<p class="p-1 agent-print-name hidden-print" style="width: 100%">
    <strong id="agent-print" class="agentName"></strong>
    <span class="agentSelected"></span>
</p>
<p class="p-1" style="width:55%;float:right">
    <strong>{{ __('الكاشير') }}:</strong>
    {{ auth()->user()->name }}
</p>

<p class="p-1" style="width:35%;float:right">
    <strong>{{ __('فاتورة رقم') }}:</strong>
    #<span id="invoice-id">{{ $id }}</span>
</p>

<p class="p-1" style="width:55%;float:right">
    <strong>تاريخ:</strong>
    <span id="print-date">{{ date('d/m/Y') }}</span>
</p>

<p class="p-1" style="width:35%;float:right;text-algin:left;">
    <strong>الوقت:</strong>
    <span id="print-date">{{ date('h:i a') }}</span>
</p>

<table class="m-2">
    {{-- <thead> --}}
    <tr>
        <th class="description centered">{{ __('الصنف') }}</th>
        <th class="price centered">{{ __('السعر') }}</th>
        <th class="quantity centered">{{ __('الكمية') }}</th>
        <th class="inv-total-item centered">{{ __('الاجمالي') }}</th>
    </tr>
    {{-- </thead> --}}
    <tbody class="table-print">
        {{-- <tr class="hidden-print clone-invoice">
            <td class="description centered p-1"></td>
            <td class="centered p-1"><span class="invoice-price centered"></span>ج</td>
            <td class="quantity centered p-1"></td>
            <td class="centered p-1"><span class="prnt-item-total centered"></span>ج</td>
        </tr> --}}

        @if (isset($invoiceItem))
            @foreach ($invoiceItem as $item)
                <tr class="apend-item-prent" id="in{{ $item->item->barcode }}">
                    <td class="description centered p-1">{{ $item->item->title }}</td>
                    <td class="centered p-1"><span class="invoice-price centered">{{ $item->selling_price }}</span>ج
                    </td>
                    <td class="quantity centered p-1">{{ $item->quantity }}</td>
                    <td class="centered p-1"><span class="prnt-item-total centered">{{ $item->total }}</span>ج</td>
                </tr>
            @endforeach
        @endif

    </tbody>
    <tfoot>
        <tr>
            <th style="border: 0"></th>
            <th style="border: 0"></th>
            <th>{{ __('المبلغ الكلي') }}</th>
            <th><span id="total-of-print">{{ isset($invoice->total_bill) ? $invoice->total_bill : 0 }}</span>ج</th>
        </tr>
        <tr>
            <th style="border: 0"></th>
            <th style="border: 0"></th>
            <th>{{ __('نسبة الخصم') }}</th>
            <th>
                <span class="discount-amount">
                    {{ isset($invoice->discount_amount) ? $invoice->discount_amount : 0 }}
                </span>ج
            </th>
        </tr>
        <tr>
            <th style="border: 0"></th>
            <th style="border: 0"></th>
            <th>{{ __('المدفوع') }}</th>
            <th>
                <span id="paid-of-print" class="paid">
                    {{ isset($invoice->paid) ? $invoice->paid : 0 }}
                </span>ج
            </th>
        </tr>
        <tr>
            <th style="border: 0"></th>
            <th style="border: 0"></th>
            <th class="residual-text">
                {{  __('الباقي') }}
            </th>
            <th>
                <span class="residual">
                    {{ isset($invoice->residual) ? $invoice->residual : 0 }}
                </span>ج
            </th>
        </tr>
        <tr>
            <th style="text-align: center;border: 0;" colspan="4">
                <h2>{{ __('الإجمالي') }}</h2>
                <h3>
                    <span class="totalPrint">
                        {{ isset($invoice->total_bill) ? $invoice->total_bill : 0 }}
                    </span>ج
                </h3>
            </th>
        </tr>
    </tfoot>
</table>

@include('components.print-footer')
