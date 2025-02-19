@extends('stander')

@section('title')
	{{ __('شراء جهاز مستعمل') }}
@endsection

@section('css')
	<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
  <div class="col-md-12 mt-3">
		<form class="" action="{{ route('devices.used.store') }}" method="post">
			@csrf
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">{{ __('شراء جهاز مستعمل') }}</h3>
				</div>
				<!-- form start -->
				<div class="card-body form-horizontal">
					<div class="form-group row">
						<label for="agent_name" class="col-md-2 control-label">{{ __('اسم بائع الجهاز') }}</label>
						<div class="col-md-4">
							<input type="text" name="agent_name" class="form-control" id="agent_name" placeholder="{{ __('أكتب هنا اسم  بائع الجهاز') }}">
						</div>
					</div>

					<div class="form-group row">
						<label for="agent_phone" class="col-md-2 control-label">{{ __('رقم الهاتف') }}</label>
						<div class="col-md-4">
							<input type="text" name="agent_phone" class="form-control" id="agent_phone" placeholder="0123456789">
						</div>
					</div>

          <div class="form-group row">
						<label for="id_card" class="col-md-2 control-label">{{ __('رقم البطاقة الشخصيه') }}</label>
						<div class="col-md-4">
							<input type="text" name="id_card" class="form-control" id="id_card" placeholder="0123456789">
						</div>
					</div>

					<div class="form-group row">
						<label for="Device_type" class="col-md-2 control-label">{{ __('نوع الجهاز') }}</label>
						<div class="col-md-4">
							<select name="Device_type" class="form-control" id="Device_type">
								<option value="" selected>{{ __('اختار نوع الجهاز') }}...</option>
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
								<option value="" selected>{{ __('اختار الموديل') }}...</option>
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
							<input type="text" name="imei" class="form-control" id="imei" placeholder="{{ __('IMEI') }}">
						</div>
					</div>

        	<div class="form-group row">
						<label for="purchase_price" class="col-md-2 control-label">{{ __('سعر الشراء') }}</label>
						<div class="col-md-4">
							<input type="number" name="purchase_price" class="form-control" id="purchase_price" placeholder="00">
						</div>
					</div>

					<div class="form-group row">
						<label for="receipt_notes" class="col-md-2 control-label">{{ __('ملاحظات الاستلام') }}</label>
						<div class="col-md-6">
							<textarea name="receipt_notes" class="form-control" id="receipt_notes" placeholder="{{ __('من فضلك أكتب ملاحظات الاستلام هنا') }}"></textarea>
						</div>
					</div>
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
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

			$(window).keydown(function(event){
		    if(event.keyCode == 13) {
		      event.preventDefault();
		      return false;
		    }
		  });
		})(jQuery)
	</script>
@endsection
