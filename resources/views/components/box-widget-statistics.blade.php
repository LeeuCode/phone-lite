<div class="col-lg-3 col-6 mt-3">
    <div class="info-box">
        <span class="info-box-icon {{ $bg }}"><i class="fas {{ $icon }}"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">{{ $title }}</span>
            <span class="info-box-number">{{ (isset($count)) ? $count : 0 }}</span>
        </div>
    </div>
</div>