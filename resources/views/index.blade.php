@extends('stander')

@section('title')
    {{ __('الرئيسيه') }}
@endsection

@section('content')
    <div class="col-md-12">
        <h5 class="mb-2 mt-3">
			<i class="fas fa-chart-bar"></i> 
			{{ __('احصائيات سريعه') }}
		</h5>
    </div>

    @include('components.box-widget-statistics', [
        'bg' => 'bg-gradient-info',
        'icon' => 'fa-database',
        'title' => 'الاصناف',
        'count' => DB::table('items')->count(),
    ])

    @include('components.box-widget-statistics', [
        'bg' => 'bg-gradient-gray',
        'icon' => 'fa-layer-group',
        'title' => 'الاقسام',
        'count' => DB::table('taxonomies')->where('type', 'category')->count(),
    ])

    @include('components.box-widget-statistics', [
        'bg' => 'bg-gradient-success',
        'icon' => 'fa-balance-scale',
        'title' => 'الوحدات',
        'count' => DB::table('taxonomies')->where('type', 'unity')->count(),
    ])

    @include('components.box-widget-statistics', [
        'bg' => 'bg-gradient-dark',
        'icon' => 'fa-cubes',
        'title' => 'الموديلات',
        'count' => DB::table('taxonomies')->where('type', 'model')->count(),
    ])

    @include('components.box-widget-statistics', [
        'bg' => 'bg-gradient-success',
        'icon' => 'fa-file-invoice-dollar',
        'title' => 'فواتير المشتريات',
        'count' => DB::table('invoices')->where('invoice_type', 'model')->count(),
    ])

    @include('components.box-widget-statistics', [
        'bg' => 'bg-gradient-warning',
        'icon' => 'fa-file-invoice',
        'title' => 'فواتير المبيعات',
        'count' => DB::table('invoices')->where('invoice_type', 'sale')->where('movement_type', 'cash')->count(),
    ])

    @include('components.box-widget-statistics', [
        'bg' => 'bg-gradient-danger',
        'icon' => 'fa-file-upload',
        'title' => 'فواتير المرتجع',
    ])

    @include('components.box-widget-statistics', [
        'bg' => 'bg-gradient-Teal',
        'icon' => 'fa-tools',
        'title' => 'الأجزة المستلمه',
    ])
	
	@include('components.new-invoices')
	
	@include('components.new-invoices')


@endsection
