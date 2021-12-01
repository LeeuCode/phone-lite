@extends('stander')

@section('title')
	{{ __('الأصناف') }}
@endsection

@section('css')
	<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
	<a href="{{ route('item.create') }}" class="btn btn-info mt-3 mr-3" >
		<i class="fa fa-plus" ></i>
		{{ __('أضافة صنف جديد') }}
	</a>

	<a href="{{ route('item.create') }}" data-toggle="modal" data-target="#modal-search" class="btn btn-outline-primary mt-3" style="margin-right: auto;margin-left:1rem;" >
		<i class="fa fa-search" ></i>
		{{ __('البحث عن الاصناف') }}
	</a>
	<div class="col-md-12 mt-3">
		<div class="card">
			<div class="card-body p-0">
				<table class="table" >
					<thead>
						<tr>
							<th>{{ __('باركود الصنف') }}</th>
							<th>{{ __('اسم الصنف') }}</th>
							<th>{{ __('القسم') }}</th>
							<th>{{ __('الموديل') }}</th>
							<th>{{ __('وحدة المنتج') }}</th>
							<th>{{ __('مدة الضمان') }}</th>
							<th>{{ __('سعر البيع') }}</th>
							<th>{{ __('متوسط سعر البيع') }}</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($items as $item)
							<tr>
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
								<td>{{ $item->warranty_period }}</td>
								<td>{{ $item->selling_price }}</td>
								<td>{{ $item->average_price }}</td>
								<td>
									<form action="{{ route('item.status', ['id' => $item->id]) }}" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف العنصر؟!') }}')" method="post">
										@csrf
										<a href="{{ route('item.edit', ['id' => $item->id]) }}" class="btn btn-outline-info" >
											<i class="fa fa-edit" ></i>
										</a>
										<a href="#" data-id="{{ $item->id }}" class="print-barcode btn btn-outline-warning" >
											<i class="fa fa-barcode" ></i>
										</a>
										<button type="submit" class="btn btn-outline-danger" >
											<i class="fa fa-eye-slash" ></i>
										</button>
									</form>

									<div id="div-barcode-{{ $item->id }}" class="d-none"  style="width:100%">
										<p style="width:100%;text-align:center;margin:0;font-size:10px">{{ $item->title }}</p>
										{{-- <svg class="barcode" style="width:100%;text-align:center;"
											jsbarcode-format="CODE128"
											jsbarcode-value="123456789012"
											jsbarcode-textmargin="0"
											jsbarcode-fontoptions="bold"
											>
										</svg> --}}
										<img class="barcode" style="width:100%"
										jsbarcode-format="CODE128"
										jsbarcode-value="123456789012"
										jsbarcode-textmargin="0"
										jsbarcode-fontoptions="bold" />
									</div>
								</td>
							</tr>
						@endforeach
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
	<!-- JsBarcode -->
	<script src="{{ asset('dist/js/JsBarcode.all.min.js') }}"></script>
	<!-- printThis -->
	<script src="{{ asset('dist/js/printThis.js') }}" charset="utf-8"></script>

	<script>
		(function($){
			select2Ajax('#cat_id', '{{ route('ajax.getCategories') }}');

			select2Ajax('#model', '{{ route('ajax.getModels') }}');

			select2Ajax('#unit_id', '{{ route('ajax.getunities') }}');

			JsBarcode(".barcode").init();

			$(document).on('click', '.print-barcode', function (e) {
				e.preventDefault();
				var id = $(this).data('id');

				$("#div-barcode-"+id).printThis({
					debug: true,
					importCSS: false,
					// loadCSS: "{{ asset('dist/css/print-installments.css') }}",
					// header: "<h1>Look at all of my kitties!</h1>"
				});
			})




			// $(window).keydown(function(event){
		  //   if(event.keyCode == 13) {
		  //     event.preventDefault();
		  //     return false;
		  //   }
		  // });
		})(jQuery)
	</script>

@endsection
