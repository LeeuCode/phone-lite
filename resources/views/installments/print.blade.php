@include('components.print-header')
   <p class="p-1" style="width:55%;float:right" >
     <strong>{{ __('العميل') }}:</strong>
     {{ $installment->customer->title }}
   </p>

   <p class="p-1" style="width:35%;float:right" >
     <strong>{{ __('كود العميل') }}:</strong>
     #{{ $installment->customer->id }}
   </p>

   <p class="p-1" style="width:55%;float:right" >
     <strong>تاريخ:</strong>
     {{ date('d/m/Y') }}
   </p>

   <p class="p-1" style="width:35%;float:right;text-algin:left;" >
     <strong>الوقت:</strong>
     {{ date('h:i a') }}
   </p>

   <div style="clear:both;"></div>
   <div style="border-top: 0.5px dashed #333"></div>

   <p class="p-1" style="width:55%;float:right;text-algin:left;" >
    <strong>{{ __('الصنف: ') }}</strong>
    {{ $installment->item->title }}
   </p>

   <p class="p-1" style="width:35%;float:right;text-algin:left;" >
    <strong>{{ __('الكمية المباعه: ') }}</strong>
    {{  $installment->quantity }}
   </p>

   <p class="p-1" style="width:55%;float:right;text-algin:left;" >
    <strong>{{ __('سعر البيع قسط: ') }}</strong>
    {{ $installment->installment_selling_price }}ج
   </p>

   <p class="p-1" style="width:35%;float:right;text-algin:left;" >
    <strong>{{ __('الاجماليه: ') }}</strong>
    {{ ($installment->installment_selling_price*$installment->quantity) }}ج
   </p>

   <div style="clear:both;"></div>
   <div style="border-top: 0.5px dashed #333"></div>

   <p class="p-1" style="width:55%;float:right;text-algin:left;" >
    <strong>{{ __('الاقساط المتبقيه: ') }}</strong>
    <span class="remaining-installments">{{ $installment->remaining_installments }}</span>ج
   </p>

   <p class="p-1" style="width:35%;float:right;text-algin:left;" >
    <strong>{{ __('قسط علي: ') }}</strong>
    {{ $installment->number_months }} {{ __('شهراً') }}
   </p>

   <p class="p-1" style="width:55%;float:right;text-algin:left;" >
    <strong>{{ __('الاقساط المدفوعه: ') }}</strong>
    <span class="premiums-paid">{{ $installment->premiums_paid }}</span>
   </p>

   <p class="p-1" style="width:35%;float:right;text-algin:left;" >
    <strong>{{ __('قسط شهري: ') }}</strong>
    {{ $installment->monthly_installment }}ج
   </p>

   <div style="clear:both;"></div>
   <div style="border-top: 0.5px dashed #333"></div>
   <p class="p-2" style="width: 100%">
     تم تسديد القسط الشهري بتاريخ
     <strong class="renewal_date">1/11/2021</strong>
     و الذي هو بقيمة
     <strong class="">{{ $installment->monthly_installment }}ج</strong>
   </p>
@include('components.print-footer')
