@extends('stander')

@section('title')
	{{ __('الأقساط') }}
@endsection

@section('css')
	<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
	<a href="{{ route('installments.create') }}" class="btn btn-info mt-3 mr-3" >
		<i class="fa fa-plus" ></i>
		{{ __('أضافة قسيمة قسط جديد') }}
	</a>

	<a href="#" data-toggle="modal" data-target="#modal-search" class="btn btn-outline-primary mt-3" style="margin-right: auto;margin-left:1rem;" >
		<i class="fa fa-search" ></i>
		{{ __('البحث عن الاصناف') }}
	</a>
	<div class="col-md-12 mt-3">
		<div class="card">
			<div class="card-body p-0">
				<table class="table text-center" >
					<thead>
						<tr>
							<th>{{ __('اسم العميل') }}</th>
							<th>{{ __('رقم الهاتف') }}</th>
							<th>{{ __('الصنف') }}</th>
							<th>{{ __('الكمية المباعة') }}</th>
							<th>{{ __('عدد الاشهر') }}</th>
							<th>{{ __('الأقساط المدفوعه') }}</th>
							<th>{{ __('الاقساط المتبقيه') }}</th>
							<th>{{ __('القسط الشهري') }}</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($installments as $installment)
							<tr>
								<td>{{ $installment->customer->title }}</td>
								<td>{{ $installment->customer->phone }}</td>
								<td>
									@php
										$itemConut = $installment->item()->count();
									@endphp
									@if ($itemConut)
										{{ $installment->item->title }}
									@else
										{{ __('لا يتوفر') }}
									@endif
								</td>
								<td>{{ $installment->quantity }}</td>
								<td>{{ $installment->number_months }}</td>
								<td>{{ $installment->premiums_paid }}</td>
								<td>{{ $installment->remaining_installments }}</td>
								<td>{{ $installment->monthly_installment }}</td>
								<td>
									<form action="{{ route('item.status', ['id' => $installment->id]) }}" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف العنصر؟!') }}')" method="post">
										@csrf
										<a href="{{ route('item.edit', ['id' => $installment->id]) }}" class="btn btn-sm btn-outline-info" >
											<i class="fa fa-edit" ></i>
										</a>
										<a href="#" class="btn btn-sm btn-outline-success" >
											<i class="fa fa-money-check-alt" ></i>
										</a>
										<a href="{{ route('installments.view', ['id' => $installment->id]) }}" class="btn btn-sm btn-outline-warning" >
											<i class="fa fa-eye" ></i>
										</a>

										<button type="submit" class="btn btn-sm btn-outline-danger" >
											<i class="fa fa-trash-alt" ></i>
										</button>
									</form>
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
	<script>
		(function($){
			select2Ajax('#cat_id', '{{ route('ajax.getCategories') }}');

			select2Ajax('#model', '{{ route('ajax.getModels') }}');

			select2Ajax('#unit_id', '{{ route('ajax.getunities') }}');


			// $(window).keydown(function(event){
		  //   if(event.keyCode == 13) {
		  //     event.preventDefault();
		  //     return false;
		  //   }
		  // });
		})(jQuery)
	</script>

@endsection
