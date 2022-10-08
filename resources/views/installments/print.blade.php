@include('components.print-header', ['continarID' => $continar_ID])
<p class="p-1" style="width:55%;float:right">
    <strong>{{ __('العميل') }}:</strong>
    <span id="installment_customer_name"></span>
</p>

<p class="p-1" style="width:35%;float:right">
    <strong>{{ __('كود العميل') }}:</strong>
    #<span id="installment_customer_id"></span>
</p>

<p class="p-1" style="width:55%;float:right">
    <strong>تاريخ:</strong>
    <span class="date">{{ date('d/m/Y') }}</span>
</p>

<p class="p-1" style="width:35%;float:right;text-algin:left;">
    <strong>الوقت:</strong>
    <span class="time">{{ date('h:i a') }}</span>
</p>

<div style="clear:both;"></div>
<div style="border-top: 0.5px dashed #333"></div>

<p class="p-1" style="width:55%;float:right;text-algin:left;">
    <strong>{{ __('الصنف: ') }}</strong>
    <span id="installment_item_name"></span>
</p>

<p class="p-1" style="width:35%;float:right;text-algin:left;">
    <strong>{{ __('الكمية المباعه: ') }}</strong>
    <span id="installment_quantity"></span>
</p>

<p class="p-1" style="width:55%;float:right;text-algin:left;">
    <strong>{{ __('سعر البيع قسط: ') }}</strong>
    <span id="selling_price"></span>ج
</p>

<p class="p-1" style="width:35%;float:right;text-algin:left;">
    <strong>{{ __('الاجماليه: ') }}</strong>
    <span id="installment_total"></span>ج
</p>

<div style="clear:both;"></div>
<div style="border-top: 0.5px dashed #333"></div>

<p class="p-1" style="width:55%;float:right;text-algin:left;">
    <strong>{{ __('الاقساط المتبقيه: ') }}</strong>
    <span class="remaining-installments"></span>
</p>

<p class="p-1" style="width:35%;float:right;text-algin:left;">
    <strong>{{ __('قسط علي: ') }}</strong>
    <span id="installment_number_months"></span> {{ __('شهراً') }}
</p>

<p class="p-1" style="width:55%;float:right;text-algin:left;">
    <strong>{{ __('الاقساط المدفوعه: ') }}</strong>
    <span class="premiums-paid"></span>
</p>

<p class="p-1" style="width:35%;float:right;text-algin:left;">
    <strong>{{ __('قسط شهري: ') }}</strong>
    <span class="monthly_installment"></span>ج
</p>

<div style="clear:both;"></div>
<div style="border-top: 0.5px dashed #333"></div>
<p class="p-2" style="width: 100%">
    تم تسديد القسط الشهري بتاريخ
    <strong class="renewal_date">{{ date('d/m/Y') }}</strong>
    و الذي هو بقيمة
    <strong class="">
        <span class="monthly_installment"></span>ج
    </strong>
</p>
@include('components.print-footer')
