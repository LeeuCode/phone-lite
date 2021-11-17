@extends('stander')

@section('title')
	{{ __('الاجهزة المستعملة') }}
@endsection

@section('css')
	<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
	<a href="{{ route('devices.used.purchase') }}" class="btn btn-info mt-3 mr-3" >
		<i class="fa fa-plus" ></i>
		{{ __('شراء جهاز مستعمل جديد') }}
	</a>

	<a href="{{ route('item.create') }}" data-toggle="modal" data-target="#modal-search" class="btn btn-outline-primary mt-3" style="margin-right: auto;margin-left:1rem;" >
		<i class="fa fa-search" ></i>
		{{ __('البحث عن جهاز مستعمل') }}
	</a>

  <div class="col-md-12 mt-3">
    <ul class="nav">
      <li class="nav-item">
        <a class="p-1 f-12" href="{{ route('devices.used') }}">
          <small>كل الاجهزة ({{ $devicesCount }})</small>
        </a>
      </li>
      |
      <li class="nav-item ">
        <a class="p-1" href="{{ route('devices.used.sale') }}">
          <small>الاجهزة المباعه ({{ $devicesSale }})</small>
        </a>
      </li>
    </ul>
  </div>
	<div class="col-md-12 mt-1">
		<div class="card">
			<div class="card-body p-0">
				<table class="table" >
					<thead>
						<tr>
							<th>{{ __('اسم بائع الجهاز') }}</th>
							<th>{{ __('رقم الهاتف') }}</th>
							<th>{{ __('نوع الجهاز') }}</th>
							<th>{{ __('الموديل') }}</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@if (count($devices) > 0)
							@foreach ($devices as $device)
								<tr>
									<td>{{ $device->agent_name }}</td>
									<td>{{ $device->agent_phone }}</td>
									<td>
										@php
										$catConut = $device->type()->count();
										@endphp
										@if ($catConut)
											{{ $device->type->title }}
										@else
											{{ __('لا يتوفر') }}
										@endif
									</td>
									<td>
										@php
										$modelsConut = $device->models()->count();
										@endphp
										@if ($modelsConut)
											{{  $device->models->title }}
										@else
											{{ __('لا يتوفر') }}
										@endif
									</td>
									<td>
										<form action="{{ route('item.status', ['id' => $device->id]) }}" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف العنصر؟!') }}')" method="post">
											@csrf
											<a href="{{ route('item.edit', ['id' => $device->id]) }}" class="btn btn-outline-info" >
												<i class="fa fa-edit" ></i>
											</a>
											@if (is_null($device->state))
												<button type="button" data-toggle="modal" data-target="#sale-{{ $device->id }}" class="btn btn-outline-success">
													<i class="fa fa-money-check-alt"></i>
												</button>
											@endif
											<button type="submit" class="btn btn-outline-danger" >
												<i class="fa fa-eye-slash" ></i>
											</button>
										</form>
									</td>
								</tr>

								<div class="modal fade" data-backdrop="static" id="sale-{{ $device->id }}">
									<div class="modal-dialog modal-sm">
										<form class="" action="{{ route('devices.used.update', ['id' => $device->id]) }}" method="post">
											@csrf
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">
														<i class="fas fa-edit"></i>
														{{ __('بيع الجهاز') }}
													</h4>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<input type="hidden" name="state" value="1">
													<div class="form-group text-center">
														<label for="barcode" class="control-label">{{ __('البيع بسعر') }}</label>
														<input type="text" name="sale_price" class="form-control text-center" id="barcode" placeholder="00">
													</div>
												</div>
												<div class="modal-footer justify-content-between">
													<button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('إغلاق') }}</button>
													<button type="submit" class="btn btn-success">{{ __('بيع') }}</button>
												</div>
											</div>
										</form>
										<!-- /.modal-content -->
									</div>
									<!-- /.modal-dialog -->
								</div>
							@endforeach
						@else
							@if (request()->routeIs('devices.search'))
								{{ __('لا توجد نتائج مطابقة لعملية بحثك') }}
							@else
								{{ __('لا يوجد اي اجهزة حتي الان') }}
							@endif
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>


	<!-- form start -->
	<form class="m-0" action="{{ route('devices.search') }}" method="get">
		<div class="modal fade" id="modal-search">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title">{{ __('البحث عن الأصناف') }}</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body row">

						<div class="col-md-6">
							<div class="form-group">
								<label for="id" class="control-label small">{{ __('اسم البائع') }}</label>
								<input type="text" name="agent_name" class="form-control"  placeholder="{{ __('أكتب اسم بائع الجهاز هنا') }}" id="barcode">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="id" class="control-label small">{{ __('رقم الهاتف') }}</label>
								<input type="number" name="agent_phone" class="form-control" id="title" placeholder="{{ __('أكتب رقم الهاتف هنا') }}" autocomplete="off">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="Device_type" class="control-label small">{{ __('نوع الجهاز') }}</label>
								<select name="Device_type" class="form-control" id="Device_type">
	              	<option value="" selected>{{ __('اختار نوع الجهاز') }}...</option>
	              </select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="type" class="control-label small">{{ __('الموديل') }}</label>
								<select name="model" class="form-control" id="model">
									<option value="" selected>{{ __('اختار الموديل') }}...</option>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="form" class="control-label small">{{ __('من سعر') }}</label>
								<input type="text" name="from" class="form-control" id="form" placeholder="00" autocomplete="off">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="to" class="control-label small">{{ __('الي سعر') }}</label>
								<input type="text" name="to" class="form-control" id="to" placeholder="00" autocomplete="off">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label for="imei" class="control-label small">{{ __('IMEI') }}</label>
								<input type="text" name="imei" class="form-control" id="imei" placeholder="{{ __('أكتب رقم IMEI هنا ....') }}" autocomplete="off">
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
			select2Ajax('#Device_type', '{{ route('ajax.getDvices') }}');

			select2Ajax('#model', '{{ route('ajax.getModels') }}');


			// $(window).keydown(function(event){
		  //   if(event.keyCode == 13) {
		  //     event.preventDefault();
		  //     return false;
		  //   }
		  // });
		})(jQuery)
	</script>

@endsection
