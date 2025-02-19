@extends('stander')

@section('title')
    {{ __('الموردين') }}
@endsection

@php
$totalPurchase= \DB::table('invoices')
    ->where('customer_id', $user->id)
    ->where('invoice_type', 'purchase')
    ->where('movement_type', 'cash')
    ->sum('total_bill');

$totalDues = \DB::table('invoices')
    ->where('customer_id', $user->id)
    ->where('invoice_type', 'purchase')
    ->where('movement_type', 'dues')
    ->sum('total_bill');

$totalResidual = \DB::table('invoices')
    ->where('customer_id', $user->id)
    ->where('invoice_type', 'purchase')
    ->where('movement_type', 'dues')
    ->sum('residual');
@endphp

@section('content')
    <div class="col-md-12">
        <div class="card card-widget widget-user">

            <div class="widget-user-header bg-success">
                <h3 class="widget-user-username">{{ $user->title }}</h3>
                <h5 class="widget-user-desc">{{ $user->type == 'customer' ? __('عميل') : __('مورد') }}</h5>
            </div>
            <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ asset('images/profile-picture.webp') }}" alt="User Avatar">
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header">
                                {{ $totalPurchase }}ج
                            </h5>
                            <span class="description-text">
                                <i class="fas fa-file-invoice-dollar"></i>
                                {{ __('فواتير المشتريات') }}
                            </span>
                        </div>
                    </div>

                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header">
                                {{ $totalDues }}ج
                            </h5>
                            <span class="description-text">
                                <i class="fas fa-file-invoice"></i>
                                {{ __('فواتير الاجل') }}
                            </span>
                        </div>
                    </div>

                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header">
                                {{ $totalBounce = \DB::table('invoices')->where('customer_id', $user->id)->where('invoice_type', 'bounce')->sum('total_bill') }}ج
                            </h5>
                            <span class="description-text">
                                <i class="fas fa-file-upload"></i>
                                {{ __('فواتير المرتجع') }}
                            </span>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="description-block">
                            <h5 class="description-header">{{ $totalResidual }}ج</h5>
                            <span class="description-text">
                                <i class="fas fa-money-bill-wave"></i>
                                {{ __('المبالغ المطلوبه') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('user/purchases*') ? 'active' : '' }}"
                            id="custom-tabs-four-home-tab" href="{{ route('user.purchases', ['id' => $user->id]) }}">
                            <i class="fas fa-file-invoice-dollar"></i>
                            {{ __('فواتير المشتريات') }}
                            <span class="badge badge-danger right">
                                {{ \DB::table('invoices')->where('customer_id', $user->id)->where('invoice_type', 'purchase')->count() }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('user/bounces*') ? 'active' : '' }}"
                            id="custom-tabs-four-profile-tab" href="{{ route('user.bounces', ['id' => $user->id]) }}"
                            role="tab">
                            <i class="fas fa-file-upload"></i>
                            {{ __('فواتير المرتجع') }}
                            <span class="badge badge-danger right">
                                {{ \DB::table('invoices')->where('customer_id', $user->id)->where('invoice_type', 'bounce')->count() }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('user/damages*') ? 'active' : '' }}"
                            id="custom-tabs-four-messages-tab" href="{{ route('user.damages', ['id' => $user->id]) }}">
                            <i class="fas fa-file-invoice-dollar"></i>
                            {{ __('فواتير التوالف') }}
                            <span class="badge badge-danger right">
                                {{ \DB::table('invoices')->where('customer_id', $user->id)->where('invoice_type', 'damaged')->count() }}
                            </span>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-settings-tab" href="#custom-tabs-four-settings">Settings</a>
                    </li> --}}
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                        aria-labelledby="custom-tabs-four-home-tab">
                        @yield('user-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
