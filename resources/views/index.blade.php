@extends('stander')

@section('title')
    {{ __('الرئيسيه') }}
@endsection

@section('content')

    <div class="col-md-4 col-xl-2 mt-3 mb-3">
        <a href="#" class="icon-box">
            <span class="icon">
			    <i class="fas fa-receipt"></i> 
            </span>
            <h5>{{ __('Sale bill') }}</h5>
        </a>
    </div>

    <div class="col-md-4 col-xl-2 mt-3 mb-3">
        <a href="#" class="icon-box">
            <span class="icon">
			    <i class="fas fa-file-invoice-dollar"></i> 
            </span>
            <h5>{{ __('Purchases bill') }}</h5>
        </a>
    </div>

    <div class="col-md-4 col-xl-3 mt-3 mb-3">
        <a href="#" class="icon-box" data-toggle="modal" data-target="#deues-model-cache" >
            <span class="icon">
                <i class="fa fa-money-bill-alt"></i>
            </span>
            <h5>{{ __('Postpaid invoice collection') }}</h5>
        </a>
    </div>

    <div class="col-md-4 col-xl-3 mt-3 mb-3">
        <a href="#" class="icon-box" data-toggle="modal" data-target="#installment-collection">
            <span class="icon">
			    <i class="fa fa-hand-holding-usd"></i>
            </span>
            <h5>{{ __('collecting premium') }}</h5>
        </a>
    </div>

    <div class="col-md-4 col-xl-2 mt-3 mb-3">
        <a href="#" class="icon-box" data-toggle="modal" data-target="#customer-cash-collection-modal" >
            <span class="icon">
                <i class="fas fa-money-check-alt"></i>
            </span>
            <h5>{{ __('Cash Collection') }}</h5>
        </a>
    </div>

    
    <div class="col-md-12">
        <h5 class="mb-2 mt-3">
			<i class="fas fa-chart-bar"></i> 
			{{ __('Quick stats') }}
		</h5>
    </div>

    @include('components.box-widget-statistics', [
        'bg' => 'bg-gradient-info',
        'icon' => 'fa-database',
        'title' => 'Items',
        'count' => DB::table('items')->count(),
    ])

    @include('components.box-widget-statistics', [
        'bg' => 'bg-gradient-gray',
        'icon' => 'fa-layer-group',
        'title' => 'Sections',
        'count' => DB::table('taxonomies')->where('type', 'category')->count(),
    ])

    @include('components.box-widget-statistics', [
        'bg' => 'bg-gradient-success',
        'icon' => 'fa-balance-scale',
        'title' => 'Unities',
        'count' => DB::table('taxonomies')->where('type', 'unity')->count(),
    ])

    @include('components.box-widget-statistics', [
        'bg' => 'bg-gradient-dark',
        'icon' => 'fa-cubes',
        'title' => 'Models',
        'count' => DB::table('taxonomies')->where('type', 'model')->count(),
    ])

    @include('components.box-widget-statistics', [
        'bg' => 'bg-gradient-success',
        'icon' => 'fa-file-invoice-dollar',
        'title' => 'فواتير المشتريات',
        'count' => DB::table('invoices')->where('invoice_type', 'purchase')->count(),
    ])

    @include('components.box-widget-statistics', [
        'bg' => 'bg-gradient-warning',
        'icon' => 'fa-file-invoice',
        'title' => 'فواتير المبيعات',
        'count' => DB::table('invoices')->where('invoice_type', 'sale')->count(),
    ])

    @include('components.box-widget-statistics', [
        'bg' => 'bg-gradient-danger',
        'icon' => 'fa-file-upload',
        'title' => 'فواتير المرتجع',
        'count' => DB::table('invoices')->where('invoice_type', 'bounce')->count(),
    ])

    @include('components.box-widget-statistics', [
        'bg' => 'bg-gradient-Teal',
        'icon' => 'fa-tools',
        'title' => 'الأجزة المستلمه',
        'count' => DB::table('invoices')->where('invoice_type', 'bounce')->count(),
    ])
	
	{{-- @include('components.new-invoices-sale')
	
	@include('components.new-invoices-bounce') --}}

@endsection
