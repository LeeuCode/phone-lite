@extends('stander')

@section('title')
	{{ __('جرد الأصناف') }}
@endsection

@section('css')
	<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
	{{-- <a href="{{ route('item.create') }}" class="btn btn-info mt-3 mr-3" >
		<i class="fa fa-plus" ></i>
		{{ __('أضافة صنف جديد') }}
	</a>

	<a href="{{ route('item.create') }}" data-toggle="modal" data-target="#modal-search" class="btn btn-outline-primary mt-3" style="margin-right: auto;margin-left:1rem;" >
		<i class="fa fa-search" ></i>
		{{ __('البحث عن الاصناف') }}
	</a> --}}

	<div class="col-md-12 mt-3">
		<div class="card">
			<div class="card-body ">
				<form class="row p-0 m-0" action="{{ route('reports.items.inventory') }}" method="get">
					<div class="col-md-3">
						<div class="form-group">
							<label for="title" class="control-label">{{ __('القسم') }}</label>
							<select name="cat_id" class="form-control" id="cat_id">
								<option value="" selected>{{ __('اختار القسم') }}...</option>
							</select>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="title" class="control-label">{{ __('الموديل') }}</label>
							<select name="model" class="form-control" id="model">
								<option value="" selected>{{ __('اختار الموديل') }}...</option>
							</select>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="title" class="control-label">{{ __('وحدة المنتج') }}</label>
							<select name="unit_id" class="form-control" id="unit_id">
								<option value="" selected>{{ __('اختار الوحده') }}...</option>
							</select>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="title" class="control-label">.</label>
							<br>
							<button type="submit" name="result" value="yes" class="btn btn-primary">
								{{ __('أصدار التقرير') }}
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-md-12 mt-3">
		<div class="card">
			<div class="card-body p-0">
				<table class="table" >
					<thead>
						<tr class="text-center">
							<th>{{ __('باركود الصنف') }}</th>
							<th>{{ __('اسم الصنف') }}</th>
							<th>{{ __('القسم') }}</th>
							<th>{{ __('الموديل') }}</th>
							<th>{{ __('وحدة المنتج') }}</th>
							<th>{{ __('سعر البيع') }}</th>
							<th>{{ __('متوسط سعر البيع') }}</th>
							<th>{{ __('الكمية المتاحه') }}</th>
						</tr>
					</thead>
					<tbody>
						@isset($items)
							@foreach ($items as $item)
								<tr class="text-center">
									<td>{{ $item->barcode }}</td>
									<td>{{ $item->title }}</td>
									<td>
										@php
										$catConut = $item->category()->count();
										@endphp
										@if ($catConut)
											{{ $item->category->title }}
										@else
											{{ __('لا يتوفر') }}
										@endif
									</td>
									<td>
										@php
										$modelsConut = $item->models()->count();
										@endphp
										@if ($modelsConut)
											{{  $item->models->title }}
										@else
											{{ __('لا يتوفر') }}
										@endif
									</td>
									<td>
										@php
										$unitiesConut = $item->unities()->count();
										@endphp
										@if ($unitiesConut)
											{{  $item->unities->title }}
										@else
											{{ __('لا يتوفر') }}
										@endif
									</td>
									<td>{{ $item->selling_price }}</td>
									<td>{{ $item->average_price }}</td>
									<td>{{ $item->store_balance }}</td>
								</tr>
							@endforeach
						@endisset
					</tbody>
				</table>
			</div>
		</div>
	</div>


	<!-- form start -->
	<form class="m-0" action="{{ route('item.search') }}" method="get">
		<div class="modal fade" id="modal-search">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title">{{ __('البحث عن الأصناف') }}</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">

						<div class="form-group">
							<label for="id" class="control-label small">{{ __('باركود الصنف') }}</label>
							<input type="number" name="barcode" class="form-control text-center" id="barcode" placeholder="00">
						</div>

						<div class="form-group">
							<label for="id" class="control-label small">{{ __('اسم الصنف') }}</label>
							<input type="text" name="title" class="form-control" id="title" placeholder="{{ __('أكتب اسم الصنف اذا لم تتذكر الباركود') }}" autocomplete="off">
						</div>

						<div class="form-group">
							<label for="type" class="control-label small">{{ __('القسم') }}</label>
							<select name="cat_id" class="form-control" id="cat_id">
              	<option value="" selected>{{ __('اختار القسم') }}...</option>
              </select>
						</div>

						<div class="form-group">
							<label for="type" class="control-label small">{{ __('الموديل') }}</label>
							<select name="model" class="form-control" id="model">
								<option value="" selected>{{ __('اختار الموديل') }}...</option>
							</select>
						</div>

						<div class="form-group">
							<label for="type" class="control-label small">{{ __('وحدة المنتج') }}</label>
							<select name="unit_id" class="form-control" id="unit_id">
              	<option value="" selected>{{ __('اختار الوحده') }}...</option>
              </select>
						</div>
		      </div>
		      <div class="modal-footer justify-content-between">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('إغلاق') }}</button>
		        <button type="submit" class="btn btn-info">{{ __('البحث الان') }}</button>
		      </div>
		    </div>
		    <!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
	</form>

@endsection

@section('js')
	<!-- Select2 -->
	<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
	<script>
		(function($){
			select2Ajax('#cat_id', '{{ route('ajax.getCategories') }}');

			select2Ajax('#model', '{{ route('ajax.getModels') }}');

			select2Ajax('#unit_id', '{{ route('ajax.getunities') }}');
		})(jQuery)
	</script>

@endsection
