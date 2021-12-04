@extends('stander')

@section('title')
	{{ __('أضافة صنف جديد') }}
@endsection

@section('css')
	<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
  <div class="col-md-12 mt-3 position-sticky sticky-top">
		<div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">{{ __('أضافة صنف جديد') }}</h3>
      </div>
			<!-- form start -->
      <div class="card-body">
				<form class="form-horizontal" action="{{ route('item.store') }}" method="post">
					@csrf

					<div class="form-group row">
  						<label for="barcode" class="col-md-2 control-label">{{ __('باركود الصنف') }}</label>
              <div class="col-md-4">
                <input type="number" name="barcode" class="form-control text-center" id="barcode" placeholder="00">
			        </div>
		      </div>

					<div class="form-group row">
							<label for="title" class="col-md-2 control-label">{{ __('اسم الصنف') }}</label>
              <div class="col-md-4">
                <input type="text" name="title" class="form-control" id="title" placeholder="{{ __('أكتب اسم الصنف اذا لم تتذكر الباركود') }}">
					    </div>
					</div>

					<div class="form-group row">
						<label for="cat_id" class="col-md-2 control-label">{{ __('القسم') }}</label>
            <div class="col-md-4">
              <select name="cat_id" class="form-control" id="cat_id">
              	<option value="" selected>{{ __('اختار القسم') }}...</option>
              </select>
						</div>
						<div class="col-md-2 p-0 d-flex">
							<button type="button" class="add-cat btn bg-light" data-title="{{ __('أضف قسم جديد') }}" data-type="category" data-toggle="modal" data-target="#add-category">
								<i class="fas fa-plus" ></i>
							</button>
						</div>
					</div>

          <div class="form-group row">
						<label for="model" class="col-md-2 control-label">{{ __('الموديل') }}</label>
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
						<label for="unit_id" class="col-md-2 control-label">{{ __('وحدة المنتج') }}</label>
            <div class="col-md-4">
              <select name="unit_id" class="form-control" id="unit_id">
              	<option value="" selected>{{ __('اختار الوحده') }}...</option>
              </select>
						</div>
						<div class="col-md-2 p-0 d-flex">
							<button type="button" class="add-cat btn bg-light" data-title="{{ __('أضف الوحدة') }}" data-type="unity" data-toggle="modal" data-target="#add-category">
								<i class="fas fa-plus" ></i>
							</button>
						</div>
					</div>

          <div class="form-group row d-none">
						<label for="type" class="col-md-2 control-label">{{ __('حالة المنتج') }}</label>
            <div class="col-md-4">
              <select name="type" class="form-control" id="type">
              	<option value="" selected>{{ __('اختار حالة المنتج') }}...</option>
              </select>
						</div>
					</div>

          <div class="form-group row">
							<label for="warranty_period" class="col-md-2 control-label">{{ __('مدة الضمان') }}</label>
              <div class="col-md-4">
                <input type="text" name="warranty_period" class="form-control text-center" id="warranty_period" placeholder="{{ __('اكتب مدة ضمان المنتج هنا') }}">
					    </div>
					</div>

          <div class="form-group row">
  						<label for="purchasing_price" class="col-md-2 control-label">{{ __('سعر الشراء') }}</label>
              <div class="col-md-4">
                <input type="number" name="purchasing_price" class="form-control text-center" id="purchasing_price" placeholder="00">
			        </div>
		      </div>

          <div class="form-group row">
  						<label for="selling_price" class="col-md-2 control-label">{{ __('سعر البيع') }}</label>
              <div class="col-md-4">
                <input type="number" name="selling_price" class="form-control text-center" id="selling_price" placeholder="00">
			        </div>
		      </div>

          <div class="form-group row">
  						<label for="average_price" class="col-md-2 control-label">{{ __('متوسط سعر البيع') }}</label>
              <div class="col-md-4">
                <input type="number" name="average_price" class="form-control text-center" id="average_price" placeholder="00">
			        </div>
		      </div>

          <div class="form-group row">
  						<label for="store_balance" class="col-md-2 control-label">{{ __('رصيد اول المدة') }}</label>
              <div class="col-md-4">
                <input type="number" name="store_balance" class="form-control text-center" id="store_balance" placeholder="00">
			        </div>
		      </div>

					<button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
					</form>
      </div>
		  <!-- /.card-body -->
		</div>
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
@endsection

@section('js')
	<!-- Select2 -->
	<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
	<script>
		(function($){
			select2Ajax('#cat_id', '{{ route('ajax.getCategories') }}');

			select2Ajax('#model', '{{ route('ajax.getModels') }}');

			select2Ajax('#unit_id', '{{ route('ajax.getunities') }}');

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
							$('input[name=title]').val('');
							$('#add-category').modal('hide');
					  });

				// console.log();
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
