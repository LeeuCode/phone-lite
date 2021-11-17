@extends('stander')

@section('title')
	{{ __('تسليم الجهاز') }}
@endsection

@section('content')

	<div class="col-md-6 mt-3">
		<form class="" action="{{ route('maintenance.update', ['id' => $device->id]) }}" method="post">
			@csrf
    	<div class="card card-success">
	      <div class="card-header">
	        <h3 class="card-title">{{ __('تسليم الجهاز') }}</h3>
	      </div>
				<!-- form start -->
	    	<div class="card-body row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="device_recipient" class="control-label">{{ __('مستلم الجهاز') }}</label>
							<input type="text" name="device_recipient" class="form-control" id="device_recipient" required placeholder="{{ __('أكتب هنا اسم مستلم الجهاز') }}">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="maintenance_status" class="control-label">{{ __('حالة الصيانة') }}</label>
							<select  name="maintenance_status" class="form-control" id="maintenance_status" required>
								<option value="">{{ __('اختر حالة الصيانه') }}</option>
								<option value="1">{{ __('جاري العمل عليها') }}</option>
								<option value="2">{{ __('تم الحل') }}</option>
								<option value="3">{{ __('لم يتم حل المشكله') }}</option>
							</select>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="type" class="control-label">{{ __('تكلفة الصيانه') }}</label>
							<input type="number" name="maintenance_cost" class="form-control" placeholder="0" required>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="type" class="control-label">{{ __('قيمة قطع الغيار') }}</label>
							<input type="number" name="spare_parts_value" class="form-control" placeholder="0" required>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="type" class="control-label">{{ __('اجمالي المستحق') }}</label>
							<input type="number" class="form-control" value="0">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="type" class="control-label">{{ __('المدفوع') }}</label>
	            <input type="number" name="paid" class="form-control" placeholder="0" required>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="type" class="control-label">{{ __('الخصم') }}</label>
	            <input type="number" name="discount" class="form-control" value="0">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="type" class="control-label">{{ __('المتبقي') }}</label>
	            <input type="number" name="residual" class="form-control" value="0">
						</div>
					</div>
	    	</div>
			  <!-- /.card-body -->
	      <div class="card-footer">
	        <button type="submit" class="btn btn-primary">{{ __('حفظ و تسليم') }}</button>
	      </div>
			</div>
		</form>
	</div>

  <div class="col-md-6 mt-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">{{ __('بيانات الجهاز') }}</h3>
      </div>
			<!-- form start -->
      <div class="card-body row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">{{ __('اسم العميل') }}</label>
						<input class="form-control" value="{{ $device->agent_name }}" disabled>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">{{ __('رقم الهاتف') }}</label>
						<input class="form-control" placeholder="{{ __('لا يتوفر رقم هاتف لهذا العميل') }}" value="{{ $device->agent_phone }}" disabled>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">{{ __('نوع الجهاز') }}</label>
						<select class="form-control" disabled>
							@php
							$typesConut = $device->types()->count();
							@endphp
							@if ($typesConut)
								<option value="{{ $device->Device_type }}" selected>{{ $device->types->title }}</option>
							@else
								<option value="" selected>{{ __('لا يتوفر') }}</option>
							@endif
						</select>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="id" class="control-label">{{ __('IMEI') }}</label>
						<input class="form-control" placeholder="{{ __('لا يتوفر IMEI لهذا الجهاز') }}" value="{{ $device->imei }}" disabled>
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<label for="type" class="control-label">{{ __('الموديل') }}</label>
						<br>
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
							@endif
						@else
							{{  __('لا يتوفر')  }}
						@endif
					</div>
				</div>

				<div class="col-md-12">
						<div class="form-group">
								<label for="id" class="control-label">{{ __('شكوي العميل') }}</label>
	              <textarea name="id" class="form-control" id="id" placeholder="{{ __('لا يتوفر شكوي للعميل') }}" disabled>{{ $device->customer_complaint }}</textarea>
						</div>
					</div>

				<div class="col-md-12">
						<div class="form-group">
							<label for="id" class="control-label">{{ __('ملاحظات الاستلام') }}</label>
              <textarea name="id" class="form-control" id="id" placeholder="{{ __('لا يتوفر ملاحظات عند الاستلام') }}" disabled>{{ $device->receipt_notes }}</textarea>
						</div>
					</div>
      </div>
		</div>
	</div>

@endsection

@section('js')

@endsection
