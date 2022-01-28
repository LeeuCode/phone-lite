@extends('stander')

@section('title')
	{{ __('تعديل تفاصيل الجهاز') }}
@endsection

@section('css')
	<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
	<!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
  <div class="col-md-12 mt-3">
		<form class="" action="{{ route('maintenance.update', ['id' => $device->id]) }}" method="post">
			@csrf
			<div class="card card-success">
				<div class="card-header">
					<h3 class="card-title">{{ __('تعديل بيانات الجهاز') }}</h3>
				</div>
				<!-- form start -->
				<div class="card-body form-horizontal">
					<div class="form-group row">
						<label for="agent_name" class="col-md-2 control-label">{{ __('اسم العميل') }}</label>
						<div class="col-md-4">
							<input type="text" name="agent_name" class="form-control" value="{{ $device->agent_name }}" id="agent_name" placeholder="{{ __('أكتب هنا اسم العميل') }}">
						</div>
					</div>

					<div class="form-group row">
						<label for="agent_phone" class="col-md-2 control-label">{{ __('رقم الهاتف') }}</label>
						<div class="col-md-4">
							<input type="text" name="agent_phone" class="form-control" value="{{ $device->agent_phone }}" id="agent_phone" placeholder="0123456789">
						</div>
					</div>

					<div class="form-group row">
						<label for="Device_type" class="col-md-2 control-label">{{ __('نوع الجهاز') }}</label>
						<div class="col-md-4">
							<select name="Device_type" class="form-control" id="Device_type">
                @php
                  $typesConut = $device->types()->count();
                @endphp
                @if ($typesConut)
                  <option value="{{ $device->Device_type }}" selected>{{ $device->types->title }}</option>
                @else
                  <option value="" selected>{{ __('اختار نوع الجهاز') }}...</option>
                @endif
							</select>
						</div>
						<div class="col-md-2 p-0 d-flex">
							<button type="button" class="add-cat btn bg-light" data-title="{{ __('أضف جهاز جديد جديد') }}" data-type="devices" data-toggle="modal" data-target="#add-category">
								<i class="fas fa-plus" ></i>
							</button>
						</div>
					</div>

					<div class="form-group row">
						<label for="type" class="col-md-2 control-label">{{ __('الموديل') }}</label>
						<div class="col-md-4">
							<select name="model" class="form-control" id="model">
                @php
                  $modelsConut = $device->models()->count();
                @endphp
                @if ($modelsConut)
                <option value="{{  $device->model }}" selected>{{  $device->models->title }}</option>
                @else
                  <option value="" selected>{{ __('اختار الموديل') }}...</option>
                @endif
							</select>
						</div>
						<div class="col-md-2 p-0 d-flex">
							<button type="button" class="add-cat btn bg-light" data-title="{{ __('أضف موديل جديد') }}" data-type="model" data-toggle="modal" data-target="#add-category">
								<i class="fas fa-plus" ></i>
							</button>
						</div>
					</div>

					<div class="form-group row">
						<label for="imei" class="col-md-2 control-label">{{ __('IMEI') }}</label>
						<div class="col-md-4">
							<input type="text" name="imei" value="{{ $device->imei }}" class="form-control" id="imei" placeholder="{{ __('IMEI') }}">
						</div>
					</div>

					<div class="form-group row">
						<label for="malfunction" class="col-md-2 control-label">{{ __('العطل') }}</label>
						<div class="col-md-6">
							<select name="malfunction[]" class="form-control" multiple id="malfunction">
                @if (isset($device->malfunction))
                  @php
                  $deviceMalfunctions = json_decode($device->malfunction);
                  $malfunctions = \DB::table('taxonomies')->whereIn('id', $deviceMalfunctions);
                  $malfunctionConut = $malfunctions->count();
                  @endphp
                  @if ($malfunctionConut)
                    @foreach ($malfunctions->get() as $malfunction)
                      <option value="{{ $malfunction->id }}" selected>{{ $malfunction->title }}</option>
                    @endforeach
                  @endif
                @endif
							</select>
						</div>
						<div class="col-md-2 p-0 d-flex">
							<button type="button" class="add-cat btn bg-light" data-title="{{ __('أضف سبب عطل جديد') }}" data-type="damage" data-toggle="modal" data-target="#add-category">
								<i class="fas fa-plus" ></i>
							</button>
						</div>
					</div>

					{{-- <div class="form-group row">
					<label for="id" class="col-md-2 control-label">{{ __('مدة الضمان') }}</label>
					<div class="col-md-4">
					<input type="text" name="id" class="form-control text-center" id="id" placeholder="{{ __('اكتب مدة ضمان المنتج هنا') }}">
				</div>
			</div> --}}

					<div class="form-group row">
						<label for="customer_complaint" class="col-md-2 control-label">{{ __('شكوي العميل') }}</label>
						<div class="col-md-6">
							<textarea name="customer_complaint" class="form-control" id="customer_complaint" placeholder="{{ __('من فضلك أكتب شكوي العميل هنا') }}">{{ $device->customer_complaint }}</textarea>
						</div>
					</div>

					<div class="form-group row">
						<label for="receipt_notes" class="col-md-2 control-label">{{ __('ملاحظات الاستلام') }}</label>
						<div class="col-md-6">
							<textarea name="receipt_notes" class="form-control" id="receipt_notes" placeholder="{{ __('من فضلك أكتب ملاحظات الاستلام هنا') }}">{{ $device->receipt_notes }}</textarea>
						</div>
					</div>

					{{-- <div class="form-group row">
						<label for="day_delviery" class="col-md-2 control-label">{{ __('مدة التسليم باليوم') }}</label>
						<div class="col-md-4">
							<input type="number" name="day_delviery" class="form-control text-center" id="day_delviery" placeholder="00">
						</div>
					</div> --}}

					<div class="form-group row">
						<label for="delivery_date" class="col-md-2 control-label">{{ __('تاريخ التسليم') }}</label>
						<div class="col-md-4">
							<input type="text" name="delivery_date" class="form-control text-center date" value="{{ $device->delivery_date }}" id="delivery_date" placeholder="dd/mm/YYYY">
						</div>
					</div>

				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<button type="submit" class="btn btn-success">{{ __('تعديل') }}</button>
				</div>
			</div>
		</form>
	</div>

	<div class="modal fade" id="add-category">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">
						<i class="fas fa-edit"></i>
						<span class="title" >{{ __('تعديل') }}</span>
						{{-- <span class="text-info">({{ $category->title }})</span> --}}
					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form class="create-category" action="{{ route('ajax.createCategory') }}" method="post">
					@csrf
				<div class="modal-body">
						<input type="hidden" name="type" value="category">
						<div class="form-group">
								<label for="barcode" class="control-label">{{ __('العنوان') }}</label>
								<input type="text" name="title" class="form-control" id="barcode" placeholder="{{ __('اكتب العنوان هنا') }}">
						</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('إغلاق') }}</button>
					 <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
				</div>
			</div>
			</form>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
  </div>
@endsection


@section('js')
	<!-- Select2 -->
	<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
	<!-- InputMask -->
	<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
	<script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
	<!-- date-range-picker -->
	<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
	<script>
		(function($){
			select2Ajax('#cat_id', '{{ route('ajax.getCategories') }}');

			select2Ajax('#model', '{{ route('ajax.getModels') }}');

			select2Ajax('#unit_id', '{{ route('ajax.getunities') }}');

			select2Ajax('#malfunction', '{{ route('ajax.getDamges') }}');

			select2Ajax('#Device_type', '{{ route('ajax.getDvices') }}');

			$(document).on('click', '.add-cat',function(){
				var title = $(this).data('title'),
						type = $(this).data('type');

				$('.title').text(title);
				$('input[name=type]').val(type);
			});

			$(document).on('submit', '.create-category', function(e){
				e.preventDefault();
				var url = $(this).attr('action'),
						data = $(this).serialize();

						$.post(url,data,function(data, status){
					    // alert("Data: " + data + "\nStatus: " + status);
							$('input[name=title]').val('');
							$('#add-category').modal('hide');
					  });

				console.log();
			});

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
	    });

			$(window).keydown(function(event){
		    if(event.keyCode == 13) {
		      event.preventDefault();
		      return false;
		    }
		  });
		})(jQuery)
	</script>
@endsection
