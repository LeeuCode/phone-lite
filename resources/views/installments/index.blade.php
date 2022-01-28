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
		{{ __('البحث عن قسيمة قسط') }}
	</a>

	<div class="col-md-12 mt-3">
    <ul class="nav">
      <li class="nav-item">
        <a class="p-1 f-12 text-danger" href="{{ route('installments') }}">
          <small>{{ __('أقساط جاريه') }} ({{ DB::table('installments')->where('remaining_installments','!=', 0)->count() }})</small>
        </a>
      </li>
      |
      <li class="nav-item ">
        <a class="p-1" href="{{ route('installment.paids') }}">
          <small>{{ __('أقساط مسدده') }} ({{ DB::table('installments')->where('remaining_installments', 0)->count() }})</small>
        </a>
      </li>
    </ul>
  </div>

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
						@if (count($installments) > 0)
							@foreach ($installments as $installment)
								<tr>
									<td>
										<a href="{{ route('installment.user', ['id'=> $installment->customer_id]) }}">{{ $installment->customer->title }}</a>
									</td>
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
											{{-- <a href="{{ route('item.edit', ['id' => $installment->id]) }}" class="btn btn-sm btn-outline-info" >
												<i class="fa fa-edit" ></i>
											</a> --}}
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
						@else
							<tr>
								<td colspan="9" class="text-center" >
									<i>
										@if (request()->routeIs('devices.search'))
											{{ __('لا توجد نتائج مطابقة لعملية بحثك') }}
										@else
											{{ __('لا توجد اي اقساط حتي الان') }}
										@endif
									</i>
								</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- form start -->
	<form class="m-0" action="{{ route('installments.search') }}" method="get">
		<div class="modal fade" id="modal-search">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">{{ __('البحث عن قسيمة قسط') }}</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body row">

						<div class="col-md-6">
							<div class="form-group">
								<label for="agent_name" class="control-label small">{{ __('اسم العميل') }}</label>
								<input type="text" name="agent_name" class="form-control text-center" id="barcode" placeholder="{{ __('ابحث باسم العميل من هنا') }}">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="agent_phone" class="control-label small">{{ __('رقم الهاتف') }}</label>
								<input type="number" name="agent_phone" class="form-control" id="agent_phone" placeholder="01123456789" autocomplete="off">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="item_id" class="control-label small">{{ __('الصنف') }}</label>
								<select name="item_id" class="form-control" id="item_id">
									<option value="">{{ __('اختار من الاصناف') }}</option>
  							</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="number_months" class="control-label small">{{ __('عدد الاشهر') }}</label>
								<input type="number" name="number_months" class="form-control" id="number_months">
							</div>
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
			select2Ajax('#item_id', '{{ route('ajax.getItems') }}');

			select2Ajax('#customer_id', '{{ route('ajax.getCustomers') }}');


			// $(window).keydown(function(event){
		  //   if(event.keyCode == 13) {
		  //     event.preventDefault();
		  //     return false;
		  //   }
		  // });
		})(jQuery)
	</script>
@endsection
