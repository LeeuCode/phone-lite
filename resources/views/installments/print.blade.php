<div id="ticket" class="ticket d-none">
   <img src="https://www.7star.co.za/wp-content/uploads/2017/09/7-STAR-CARWASH-1-300x120.png" alt="Logo">
   <h3 class="centered m-1" style="font-family: Arial;"> مركز صيانة و خدمات المحمول 7Star</h3>
   <h3 class="centered m-1" style="font-family: Arial;border:1px dashed #333;margin: 0.50rem 0;">{{ __('فاتورة سداد قسط') }}</h3>

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
   {{-- <table class="">
       <tr>
         <th>اسم العميل</th>
         <td>احمد عبد المجيد</td>
       </tr>
       <tr>
         <th>الصنف</th>
         <td>جراب هواوي A5</td>
       </tr>
       <tr>
         <th>الكمية المباعة</th>
         <td>10</td>
       </tr>
       <tr>
         <th>سعر لبيع القسط</th>
         <td>50ج</td>
       </tr>
       <tr>
         <th>عدد الاشهر</th>
         <td>2</td>
       </tr>
       <tr>
         <th>الاقساط المدفوعه</th>
         <td>1</td>
       </tr>
       <tr>
         <th>مقدم عند الشراء</th>
         <td>100ج</td>
       </tr>
       <tr>
         <th>الاقساط المتبقيه</th>
         <td>100ج</td>
       </tr>
       <tr>
         <th>القسط الشهري</th>
         <td>400ج</td>
       </tr>
   </table> --}}
   <h4 class="centered">شكراً لزيارتك فرعنا</h4>

   <div style="width:90%;margin: auto;">
     <div class="m-1" style="width:45%;float:left;direction:ltr;">
       <img style="width:10px" src="https://icon-library.com/images/facebook-icon-png-transparent/facebook-icon-png-transparent-2.jpg" alt="">
       /7Star.phone33
     </div>

     <div class="m-1" style="width:45%;float:left;direction:ltr;">
       <img style="width:10px" src="https://cdn-icons-png.flaticon.com/512/81/81725.png" alt="">
       /7Star.phone33
     </div>

     <div class="m-1" style="width:45%;float:left;direction:ltr;">
       <img style="width:10px" src="https://icon-library.com/images/whatsapp-icon-png/whatsapp-icon-png-1.jpg" alt="">
       01234567890
     </div>

     <div class="m-1" style="width:45%;float:left;direction:ltr;">
       <img style="width:10px" src="http://assets.stickpng.com/images/5a452601546ddca7e1fcbc87.png" alt="">
       010123456789
     </div>
   </div>
</div>
