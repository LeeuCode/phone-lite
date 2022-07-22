@include('components.print-header', ['_title' => $title])

<p class="p-1" style="width:55%;float:right">
    <strong>{{ __('الكاشير') }}:</strong>
    {{ auth()->user()->name }}
</p>

<p class="p-1" style="width:35%;float:right">
    <strong>{{ __('كود العميل') }}:</strong>
    #{{ $id }}
</p>

<p class="p-1" style="width:55%;float:right">
    <strong>تاريخ:</strong>
    {{ date('d/m/Y') }}
</p>

<p class="p-1" style="width:35%;float:right;text-algin:left;">
    <strong>الوقت:</strong>
    {{ date('h:i a') }}
</p>

<table class="m-2">
    <thead>
        <tr>
            <th class="description centered">{{ __('الصنف') }}</th>
            <th class="price centered">{{ __('السعر') }}</th>
            <th class="quantity centered">{{ __('الكمية') }}</th>
            <th class="inv-total-item centered">{{ __('الاجمالي') }}</th>
        </tr>
    </thead>
    <tbody class="table-print">
        <tr class="hidden-print clone-invoice">
            <td class="description centered p-1"></td>
            <td class="centered p-1"><span class="invoice-price centered"></span>ج</td>
            <td class="quantity centered p-1"></td>
            <td class="centered p-1"><span class="prnt-item-total centered"></span>ج</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th style="border: 0"></th>
            <th style="border: 0"></th>
            <th >{{ __('المبلغ الكلي') }}</th>
            <th><span class="total">0</span>ج</th>
        </tr>
        <tr>
            <th style="border: 0"></th>
            <th style="border: 0"></th>
            <th >{{ __('نسبة الخصم') }}</th>
            <th><span class="discount-amount">0</span>ج</th>
        </tr>
        <tr>
            <th style="border: 0"></th>
            <th style="border: 0"></th>
            <th >{{ __('المدفوع') }}</th>
            <th><span class="paid">0</span>ج</th>
        </tr>
        <tr>
            <th style="border: 0"></th>
            <th style="border: 0"></th>
            <th class="residual-text">{{ __('الباقي') }}</th>
            <th><span class="residual" >0</span>ج</th>
        </tr>
        <tr>
            <th style="text-align: center;border: 0;" colspan="4">
                <h2>{{ __('الإجمالي') }}</h2>
                <h3><span class="totalPrint"></span>ج</h3>
            </th>
        </tr>
    </tfoot>
</table>

@include('components.print-footer')
