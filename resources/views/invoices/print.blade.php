{{-- @section('css')
  @parent
  <style media="screen">

  </style>
@endsection --}}
<div id="ticket" class="ticket d-none">
   <img src="https://upload.wikimedia.org/wikipedia/commons/0/02/The_Metfone_Logo.png" alt="Logo">
   <h4 class="centered" style="font-family: tahoma"> محل النور و الهدي للهواتف و الصيانه</h4>
   <table>
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
               <td class="description centered"></td>
               <td ><span class="invoice-price centered" ></span>ج</td>
               <td class="quantity centered"></td>
               <td ><span class="prnt-item-total centered"></span>ج</td>
           </tr>
       </tbody>
       <tfoot>
         <tr>
            <th class=""></th>
             <th class=""></th>
             <th class="">الإجمالي</th>
             <th ><span class="totalPrint" ></span>ج</th>
         </tr>
       </tfoot>
   </table>
   <p class="centered">Thanks for your purchase!
       <br>parzibyte.me/blog</p>
</div>
