@extends('stander')

@section('title')
	{{ __('الرئيسيه') }}
@endsection

@section('content')
		@include('components.box-widget-index', [
			'bg' => 'bg-gradient-info',
			'icon' => 'fa-database',
			'title' => 'الاصناف'
		])

		@include('components.box-widget-index', [
			'bg' => 'bg-gradient-gray',
			'icon' => 'fa-layer-group',
			'title' => 'الاقسام'
		])

		@include('components.box-widget-index', [
			'bg' => 'bg-gradient-success',
			'icon' => 'fa-balance-scale',
			'title' => 'الوحدات'
		])

		@include('components.box-widget-index', [
			'bg' => 'bg-gradient-dark',
			'icon' => 'fa-cubes',
			'title' => 'الموديلات'
		])

		@include('components.box-widget-index', [
			'bg' => 'bg-gradient-success',
			'icon' => 'fa-file-invoice-dollar',
			'title' => 'فواتير المشتريات',
		])

		@include('components.box-widget-index', [
			'bg' => 'bg-gradient-warning',
			'icon' => 'fa-file-invoice',
			'title' => 'فواتير المبيعات',
		])

		@include('components.box-widget-index', [
			'bg' => 'bg-gradient-danger',
			'icon' => 'fa-file-upload',
			'title' => 'فواتير المرتجع',
		])

		@include('components.box-widget-index', [
			'bg' => 'bg-gradient-Teal',
			'icon' => 'fa-tools',
			'title' => 'الأجزة المستلمه',
		])

@endsection
