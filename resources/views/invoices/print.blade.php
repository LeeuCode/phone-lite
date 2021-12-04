@include('components.print-header')

  <p class="p-1" style="width:55%;float:right" >
    <strong>{{ __('الكاشير') }}:</strong>
    {{ auth()->user()->name }}
  </p>

  <p class="p-1" style="width:35%;float:right" >
    <strong>{{ __('كود العميل') }}:</strong>
    #{{ $id }}
  </p>

  <p class="p-1" style="width:55%;float:right" >
    <strong>تاريخ:</strong>
    {{ date('d/m/Y') }}
  </p>

  <p class="p-1" style="width:35%;float:right;text-algin:left;" >
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
               <td class="centered p-1"><span class="invoice-price centered" ></span>ج</td>
               <td class="quantity centered p-1"></td>
               <td class="centered p-1"><span class="prnt-item-total centered"></span>ج</td>
           </tr>
       </tbody>
       <tfoot>
         {{-- <tr>
            <th class=""></th>
             <th class=""></th>
             <th class="">{{ __('') }}</th>
             <th ><span class="totalPrint" ></span>ج</th>
         </tr> --}}
         <tr>
            <th class=""></th>
             <th class=""></th>
             <th class="">الإجمالي</th>
             <th ><span class="totalPrint" ></span>ج</th>
         </tr>
       </tfoot>
   </table>
@include('components.print-footer')
