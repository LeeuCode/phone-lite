<div class="p-2 mb-2 d-none d-print-flex justify-content-between align-items-center"
    style="border-bottom: 2px solid #333;">
    <div style="width:25%">
        @php
            $logo = getOption('logo');
            $location = getOption('shop_location');
        @endphp
        @if ($logo)
            {{-- https://www.7star.co.za/wp-content/uploads/2017/09/7-STAR-CARWASH-1-300x120.png --}}
            <img class="img-fluid" src="{{ asset('images/' . $logo) }}" alt="Logo">
        @endif
        <i>
            <strong>{{ getOption('shop_name') }}</strong>
        </i>
    </div>
    <div>
        <p><strong>بتاريخ :</strong> {{ (isset($date)) ? $date : date('d-m-Y') }}</p>
        <p><strong>بيان :</strong>{{ $type }}</p>
        @if ($location)
        <p><strong>فرع :</strong> {{ $location }}</p>
        @endif
        <p><strong>رقم المحمول :</strong>{{ getOption('phone') }}</p>
    </div>
</div>
