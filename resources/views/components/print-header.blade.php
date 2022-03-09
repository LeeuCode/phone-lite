@php
    if (!isset($title)) {
        $title = 'فاتورة';
    }
@endphp
<div id="{{ $id }}" class="ticket d-none">
    @php
      $logo = getOption('logo');
    @endphp
    @if ($logo)
      {{-- https://www.7star.co.za/wp-content/uploads/2017/09/7-STAR-CARWASH-1-300x120.png --}}
      <img src="{{ asset('images/'. $logo) }}" alt="Logo">
    @endif
   <h3 class="centered m-1" style="font-family: Arial;">{{ getOption('shop_name') }}</h3>
   <h3 class="centered m-1" style="font-family: Arial;border:1px dashed #333;margin: 0.50rem 0;">{{ $title }}</h3>
