@extends('stander')

@section('title')
	{{ __('الأصناف') }}
@endsection

@section('css')
	<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
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
		<ul class="nav">
			<li class="nav-item mr-2">
				<div class="input-group input-group-sm">
					<select id="select-action" name="" class="form-control">
						<option value="">{{ __('اختار الاجراء') }}</option>
						<option value="edit">{{ __('تحرير') }}</option>
						<option value="delete">{{ __('حذف') }}</option>
					</select>
					<span class="input-group-append">
					<button type="button" class="apply-action btn btn-outline-primary btn-flat">{{ __('تطبيق') }}</button>
					</span>
				</div>
			</li>
			<li class="nav-item">
				<a class="p-1 f-12" href="{{ route('items') }}">
				<small>{{ __('كل الأصناف') }} ({{ DB::table('items')->where('publish', 1)->count() }})</small>
				</a>
			</li>
			|
			<li class="nav-item ">
				<a class="p-1 text-danger" href="{{ route('installment.paids') }}">
				<small>{{ __('الأصناف المحذوفه') }} ({{ DB::table('items')->where('publish', 0)->count() }})</small>
				</a>
			</li>
		</ul>
  </div>

	<div class="col-md-12 mt-3">
		<div class="card">
			<div class="card-body p-0">
				<table class="table" >
					<thead>
						<tr>
							<th>
								<div class="icheck-primary d-inline">
									<input type="checkbox" id="checkAll">
									<label for="checkAll">
									</label>
								</div>
							</th>
							<th>{{ __('باركود الصنف') }}</th>
							<th>{{ __('اسم الصنف') }}</th>
							<th>{{ __('القسم') }}</th>
							<th>{{ __('الموديل') }}</th>
							<th>{{ __('وحدة المنتج') }}</th>
							<th>{{ __('الكمية المتاحه') }}</th>
							<th>{{ __('سعر البيع') }}</th>
							<th>{{ __('متوسط سعر البيع') }}</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($items as $item)
							<tr>
								<td>
									<div class="icheck-primary d-inline">
										<input class="item" type="checkbox" data-text={{ $item->title }} value="{{ $item->id }}" id="id-{{ $item->id }}">
										<label for="id-{{ $item->id }}">
										</label>
									</div>
								</td>
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
								<td>{{ $item->store_balance }}</td>
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
					<tfoot>
						<tr>
							<td colspan="9">
								{{ $items->links() }}
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>


	@include('items.components.search-modal')

	@include('items.components.edit-items-modal')

	@include('items.components.delete-items-modal')

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
			select2Ajax('.cat_id', '{{ route('ajax.getCategories') }}');

			select2Ajax('.model', '{{ route('ajax.getModels') }}');

			select2Ajax('.unit_id', '{{ route('ajax.getunities') }}');

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
			});

			$("#checkAll").click(function(){
				$('input:checkbox').not(this).prop('checked', this.checked);
			});

			$(document).on('click', '.apply-action', function(){
				var select = $('#select-action').val();

				if (select != '') {
					console.log($('.item:checked').length);
					if ($('.item:checked').length > 0) {
						$('#modal-' + select).modal('show');

						$('.selected-items').html('');
						$('.item:checked').each(function(){
							$('.selected-items').append('<option value="' + $(this).val() + '" selected >'+ $(this).data('text') + '</option>');
						});
					} else {
						alert('يجب اختيار عنصر واحد علي الاقل');
					}
				} else {
					alert('يجب اختيار اجراء');
				}
			});

			// $(window).keydown(function(event){
		  //   if(event.keyCode == 13) {
		  //     event.preventDefault();
		  //     return false;
		  //   }
		  // });
		})(jQuery)
	</script>

@endsection
