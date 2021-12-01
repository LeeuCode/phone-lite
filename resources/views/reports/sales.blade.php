@extends('stander')

@section('title')
	{{ __('حركة المبيعات') }}
@endsection

@section('css')
	<!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
	<div class="col-md-12 mt-3">
		<div class="card">
			<div class="card-body ">
				<form class="row p-0 m-0" action="{{ route('reports.invoice.sale') }}" method="get">

					<div class="col-md-3">
						<div class="form-group">
							<label for="title" class="control-label">{{ __('من تاريخ') }}</label>
							<input class="form-control date" name="from" id="from">
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="title" class="control-label">{{ __('إلي تاريخ') }}</label>
							<input class="form-control date" name="to" id="to">
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
              <th>{{ __('الكمية المشتراه') }}</th>
							<th>{{ __('المتاح بالمخزن') }}</th>
							<th>{{ __('خارج للتقسيط') }}</th>
              <th>{{ __('الكمية المباعه') }}</th>
							<th>{{ __('إجمالي المبيعات') }}</th>
						</tr>
					</thead>
					<tbody>
						@isset($items)
							@foreach ($items as $item)
								<tr class="text-center">
									<td>{{ $item->item->barcode }}</td>
									<td>{{ $item->item->title }}</td>
									<td>
										@php
										$catConut = $item->item->category()->count();
										@endphp
										@if ($catConut)
											{{ $item->item->category->title }}
										@else
											{{ __('لا يتوفر') }}
										@endif
									</td>
									<td>
										@php
										$modelsConut = $item->item->models()->count();
										@endphp
										@if ($modelsConut)
											{{  $item->item->models->title }}
										@else
											{{ __('لا يتوفر') }}
										@endif
									</td>
                  <td>
										@php
											$purchase = App\Models\InvoiceItem::select(
												\DB::raw('sum(quantity) as quantities')
											)
											->where('item_id', $item->item_id)
											->where('type', 'purchase');
										@endphp

										@if($purchase->count())
											{{ $purchase->first()->quantities }}
										@else
											{{ __('لا يتوفر') }}
										@endif
									</td>
									<td>{{ $item->item->store_balance }}</td>
									<td>
										@php
											$getInstallment = App\Models\Installment::select(
												\DB::raw('sum(quantity) as quantities')
											)->where('item_id',$item->item_id);

											if ($getInstallment->count() > 0) {
												$instll = $getInstallment->first()->quantities;
											} else {
												$instll = false;
											}
										@endphp

										@if ($instll)
											{{  $instll }}
										@else
											{{ __('لا يتوفر') }}
										@endif
									</td>
                  <td>{{ $item->quantities }}</td>
                  <td>{{ $item->totals }}ج</td>
								</tr>
							@endforeach
						@endisset
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<!-- InputMask -->
	<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
	<script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
	<!-- date-range-picker -->
	<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
	<script>
		(function($){
			//Date range picker with time picker
			$('.date').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
	      timePicker: false,
	      timePickerIncrement: 30,
				format: 'LT',
	      locale: {
	        format: 'YYYY-MM-DD'
	      }
	    })
		})(jQuery)
	</script>
@endsection
