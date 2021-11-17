@extends('stander')

@section('title')
	{{ __('اجهزة الصيانه') }}
@endsection

@section('css')
	<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
	<a href="{{ route('maintenance.receipt') }}" class="btn btn-info mt-3 mr-3" >
		<i class="fa fa-plus" ></i>
		{{ __('أضافة جهاز جديد') }}
	</a>

	<a href="#" data-toggle="modal" data-target="#modal-search" class="btn btn-outline-primary mt-3" style="margin-right: auto;margin-left:1rem;" >
		<i class="fa fa-search" ></i>
		{{ __('البحث عن الأجهزة') }}
	</a>

	<div class="col-md-12 mt-3">
		<div class="card">
			<div class="card-body p-0">
				<table class="table" >
					<thead>
						<tr>
							<th class="align-middle">{{ __('اسم العميل') }}</th>
							<th class="align-middle">{{ __('رقم الهاتف') }}</th>
							<th class="align-middle">{{ __('نوع الجهاز') }}</th>
							<th class="align-middle">{{ __('الموديل') }}</th>
							<th class="align-middle">{{ __('الاعطال') }}</th>
							<th class="align-middle">{{ __('حالة الصيانه') }}</th>
							{{-- <th class="align-middle">{{ __('تكلفة الصيانه') }}</th>
							<th class="align-middle">{{ __('مستلم الجهاز') }}</th> --}}
							<th class="align-middle"></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($devices as $device)
							<tr >
								<td class="p-1 align-middle" >{{ $device->agent_name }}</td>
								<td class="align-middle" >{{ $device->agent_phone }}</td>
								<td class="align-middle" >
									@php
										$typesConut = $device->types()->count();
									@endphp
									@if ($typesConut)
										{{ $device->types->title }}
									@else
										{{ __('لا يتوفر') }}
									@endif
								</td>
								<td class="text-center align-middle">
									@php
										$modelsConut = $device->models()->count();
									@endphp
									@if ($modelsConut)
									{{  $device->models->title }}
									@else
										{{ __('لا يتوفر') }}
									@endif
								</td>
								<td class="align-middle">
									@if (isset($device->malfunction))
										@php
										$deviceMalfunctions = json_decode($device->malfunction);
										$malfunctions = \DB::table('taxonomies')->whereIn('id', $deviceMalfunctions);
										$malfunctionConut = $malfunctions->count();
										@endphp
										@if ($malfunctionConut)
											@foreach ($malfunctions->get() as $malfunction)
												<span class="badge badge-info mt-1" >{{  $malfunction->title }}</span>
											@endforeach
										@else
											{{ __('لا يتوفر') }}
										@endif
									@endif
								</td>
								<td  class="align-middle">
									@if (!is_null($device->maintenance_status))
										{{ maintenanceStatus($device->maintenance_status) }}
									@else
										{{ __('لم يتم أخذ أجراء') }}
									@endif
								</td>
								{{-- <td  class="align-middle">
									{{ $device->maintenance_cost }}
								</td> --}}
								{{-- <td  class="align-middle">{{ $device->average_price }}</td> --}}
								<td>
									<form action="{{ route('item.status', ['id' => $device->id]) }}" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف العنصر؟!') }}')" method="post">
										@csrf
										<a href="{{ route('maintenance.edit', ['id' => $device->id]) }}" class="btn btn-sm btn-outline-info" >
											<i class="fa fa-edit" ></i>
										</a>
										<a href="{{ route('maintenance.delivery', ['id' => $device->id]) }}" class="btn btn-sm btn-outline-success" >
											<i class="fa fa-money-check-alt" ></i>
										</a>
										<button type="submit" class="btn btn-sm btn-outline-danger" >
											<i class="fa fa-eye-slash" ></i>
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
	<form class="m-0" action="{{ route('maintenance.search') }}" method="get">
		<div class="modal fade" id="modal-search">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title">{{ __('البحث عن جهاز') }}</h4>
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
								<label for="imei" class="control-label small">{{ __('IMEI') }}</label>
								<input type="number" name="imei" class="form-control" id="imei" placeholder="01123456789" autocomplete="off">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="maintenance_status" class="control-label small">{{ __('حالة الصيانة') }}</label>
								<select name="maintenance_status" class="form-control" id="maintenance_status">
									<option value="" selected>{{ __('اختار نوع الجهاز') }}...</option>
									@foreach (maintenanceStatus() as $key => $value)
										<option value="{{ $key }}" >{{ $value }}</option>
									@endforeach
								</select>
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

			select2Ajax('#model', '{{ route('ajax.getModels') }}');

			select2Ajax('#Device_type', '{{ route('ajax.getDvices') }}');

			// $(window).keydown(function(event){
		  //   if(event.keyCode == 13) {
		  //     event.preventDefault();
		  //     return false;
		  //   }
		  // });
		})(jQuery)
	</script>

@endsection
