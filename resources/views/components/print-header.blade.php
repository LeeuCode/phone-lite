@php
if (!isset($title)) {
    $title = 'فاتورة';
}
@endphp
<div id="{{ $continarID }}" class="ticket {{ (!isset($show)) ? 'd-none' : '' }}">
    @php
        $logo = getOption('logo');
    @endphp
    <div
        style="display: flex;
    align-content: center;
    justify-content: center;
    flex-direction: column;
    flex-wrap: wrap;
    align-items: center;">
        @if ($logo)
            {{-- https://www.7star.co.za/wp-content/uploads/2017/09/7-STAR-CARWASH-1-300x120.png --}}
            <img style="width: 120px" src="{{ asset('images/' . $logo) }}" alt="Logo">
        @endif
        <h3 class="centered m-1" style="font-family: Arial;">{{ getOption('shop_name') }}</h3>
    </div>
    <h3 class="centered text-center m-1 print-head" style="font-family: Arial;border:1px dashed #333;margin: 0.50rem 0;">
        {{ $title }}</h3>
