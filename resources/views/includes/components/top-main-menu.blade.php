{{-- <li class="nav-item d-none d-sm-inline-block">
    <a href="#" data-toggle="modal" data-target="#installment-collection" class="nav-link">
        <i class="fa fa-hand-holding-usd"></i>
        {{ __('تحصيل قسط') }}
    </a>
</li> --}}

<a href="#" class="close-menu">
    <span aria-hidden="true">×</span>
</a>

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{ url('/') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        {{ __('Home') }}
    </a>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
        <i class="nav-icon fas fa-cubes"></i>
        {{ __('Items') }}
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#" data-toggle="modal"
                data-target="#add-new-item">{{ __('Add New Item') }}</a></li>
        <li><a class="dropdown-item" href="{{ route('items') }}">{{ __('Items') }}</a></li>
        <li><a class="dropdown-item" href="{{ route('categories') }}">{{ __('Categories') }}</a></li>
        <li><a class="dropdown-item" href="{{ route('models') }}">{{ __('Models') }}</a></li>
        <li><a class="dropdown-item" href="{{ route('unities') }}">{{ __('Unities') }}</a></li>
        <li><a class="dropdown-item" href="{{ route('models') }}">{{ __('Colors') }}</a></li>
    </ul>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
        <i class="nav-icon fas fa-file-invoice-dollar"></i>
        {{ __('Purchases') }}
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('users.suppliers') }}">{{ __('Suppliers') }}</a></li>
        <li><a class="dropdown-item" href="{{ route('invoices.sale') }}">{{ __('Purchases bill') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('Edit purchase invoice') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('Returned purchases') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('Supplier Account') }}</a></li>
        {{-- <li><a class="dropdown-item" href="#">{{ __('Colors') }}</a></li> --}}
    </ul>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
        <i class="nav-icon fas fa-receipt"></i>
        {{ __('Sales') }}
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">{{ __('Customers') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('Sale bill') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('Edit sale invoice') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('Returned sales') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('Customers Account') }}</a></li>
    </ul>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
        <i class="nav-icon fas fa-cash-register"></i>
        {{ __('Calculations') }}
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">{{ __('Customers') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('Sale bill') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('Edit sale invoice') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('Returned sales') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('Customers Account') }}</a></li>
    </ul>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
        <i class="nav-icon fas fa-user-tie"></i>
        {{ __('Users') }}
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">{{ __('Add new user') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('All users') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('Roles') }}</a></li>
        {{-- <li><a class="dropdown-item" href="#">{{ __('Returned sales') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('Customers Account') }}</a></li> --}}
    </ul>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
        <i class="nav-icon fas fa-money-bill-wave"></i>
        {{ __('Installments') }}
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">{{ __('Create new installment') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('All Installments') }}</a></li>
    </ul>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
        <i class="nav-icon fas fa-tools"></i>
        {{ __('Maintenance') }}
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">{{ __('Received devices') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('Receive a device') }}</a></li>
    </ul>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
        <i class="nav-icon fas fa-mobile-alt"></i>
        {{ __('Used devices') }}
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">{{ __('Received devices') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('Receive a device') }}</a></li>
    </ul>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
        <i class="nav-icon fas fa-chart-bar"></i>
        {{ __('Reports') }}
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">{{ __('Received devices') }}</a></li>
        <li><a class="dropdown-item" href="#">{{ __('Receive a device') }}</a></li>
    </ul>
</li>

<li class="nav-item d-none d-sm-inline-block">
    <a href="{{ url('/') }}" class="nav-link">
        <i class="nav-icon fas fa-sliders-h"></i>
        {{ __('Settings') }}
    </a>
</li>

{{-- maintenance --}}
