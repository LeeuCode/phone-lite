<li class="nav-item d-none d-sm-inline-block">
    <a href="#" data-toggle="modal" data-target="#installment-collection" class="nav-link">
        <i class="fa fa-hand-holding-usd"></i>
        {{ __('تحصيل قسط') }}
    </a>
</li>

<li class="nav-item d-none d-sm-inline-block">
    <a href="#" data-toggle="modal" data-target="#deues-model-cache" class="nav-link">
        <i class="fa fa-money-bill-alt"></i>
        {{ __('تحصيل فاتوره اجل') }}
    </a>
</li>

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{ route('invoices.sale') }}" class="nav-link">
        <i class="nav-icon fas fa-file-invoice"></i>
        {{ __('فاتورة جديدة') }}
    </a>
</li>

<li class="nav-item d-none d-sm-inline-block">
    <a href="#" data-toggle="modal" data-target="#customer-cash-collection-modal" class="nav-link">
        <i class="fas fa-money-check-alt"></i>
        {{ __('تحصيل نقدية') }}
    </a>
</li>
