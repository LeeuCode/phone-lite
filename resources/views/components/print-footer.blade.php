@php
$phone = getOption('phone');
$facebook = getOption('facebook');
$twitter = getOption('twitter');
$whatsapp = getOption('whatsapp');
$thanks = getOption('thanks');
$offers = getOption('offers');
@endphp

@if ($offers)
    <h3 class="centered">{{ $offers }}</h3>
@endif

@if ($thanks)
    <h4 class="centered">{{ $thanks }}</h4>
@endif

<div style="width:90%;margin: auto;">

    @if ($facebook)
        <div class="m-1" style="width:45%;float:left;direction:ltr;">
            <i class="fab fa-facebook-square"></i>
            {{ $facebook }}
        </div>
    @endif

    @if ($twitter)
        <div class="m-1" style="width:45%;float:left;direction:ltr;">
            <i class="fab fa-twitter-square"></i>
            {{ $twitter }}
        </div>
    @endif

    @if ($whatsapp)
        <div class="m-1" style="width:45%;float:left;direction:ltr;">
            <i class="fab fa-whatsapp-square"></i>
            {{ $whatsapp }}
        </div>
    @endif

    @if ($whatsapp)
        <div class="m-1" style="width:45%;float:left;direction:ltr;">
            <i class="fas fa-phone-square-alt"></i>
            {{ getOption('phone') }}
        </div>
    @endif
</div>
</div>
