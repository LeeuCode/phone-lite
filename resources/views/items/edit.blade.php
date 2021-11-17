@extends('stander')

@section('title')
	{{ __('تعديل الصنف') }}
@endsection

@section('css')
	<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
  <div class="col-md-12 mt-3 position-sticky sticky-top">
		<div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">{{ __('تعديل الصنف') }}</h3>
      </div>
			<!-- form start -->
      <div class="card-body">
				<form class="form-horizontal" action="{{ route('item.update', ['id' => $item->id]) }}" method="post">
					@csrf

					<div class="form-group row">
  						<label for="barcode" class="col-md-2 control-label">{{ __('باركود الصنف') }}</label>
              <div class="col-md-4">
                <input type="number" name="barcode" class="form-control text-center" value="{{ $item->barcode }}" id="barcode" placeholder="00">
			        </div>
		      </div>

					<div class="form-group row">
							<label for="title" class="col-md-2 control-label">{{ __('اسم الصنف') }}</label>
              <div class="col-md-4">
                <input type="text" name="title" class="form-control" id="title" value="{{ $item->title }}" placeholder="{{ __('أكتب اسم الصنف اذا لم تتذكر الباركود') }}">
					    </div>
					</div>

					<div class="form-group row">
						<label for="cat_id" class="col-md-2 control-label">{{ __('القسم') }}</label>
            <div class="col-md-4">
              <select name="cat_id" class="form-control" id="cat_id">
								@if ($item->cat_id)
									<option value="{{ $item->cat_id }}" selected>{{ $item->category->title }}</option>
								@else
									<option value="" selected>{{ __('اختار القسم') }}...</option>
								@endif
              </select>
						</div>
					</div>

          <div class="form-group row">
						<label for="model" class="col-md-2 control-label">{{ __('الموديل') }}</label>
            <div class="col-md-4">
								<select name="model" class="form-control" id="model">
									@if ($item->model)
										<option value="{{ $item->modal }}" selected>{{ $item->models->title }}</option>
									@else
										<option value="" selected>{{ __('اختار الموديل') }}...</option>
									@endif
								</select>
						</div>
					</div>

          <div class="form-group row">
						<label for="unit_id" class="col-md-2 control-label">{{ __('وحدة المنتج') }}</label>
            <div class="col-md-4">
              <select name="unit_id" class="form-control" id="unit_id">

								@if ($item->unit_id)
									<option value="{{ $item->unit_id }}" selected>{{ $item->unities->title }}</option>
								@else
									<option value="" selected>{{ __('اختار الوحده') }}...</option>
								@endif
              </select>
						</div>
					</div>

          <div class="form-group row">
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
                <input type="text" name="warranty_period" value="{{ $item->warranty_period }}" class="form-control text-center" id="warranty_period" placeholder="{{ __('اكتب مدة ضمان المنتج هنا') }}">
					    </div>
					</div>

          <div class="form-group row">
  						<label for="purchasing_price" class="col-md-2 control-label">{{ __('سعر الشراء') }}</label>
              <div class="col-md-4">
                <input type="number" name="purchasing_price" value="{{ $item->purchasing_price }}" class="form-control text-center" id="purchasing_price" placeholder="00">
			        </div>
		      </div>

          <div class="form-group row">
  						<label for="selling_price" class="col-md-2 control-label">{{ __('سعر البيع') }}</label>
              <div class="col-md-4">
                <input type="number" name="selling_price" value="{{ $item->selling_price }}" class="form-control text-center" id="selling_price" placeholder="00">
			        </div>
		      </div>

          <div class="form-group row">
  						<label for="average_price" class="col-md-2 control-label">{{ __('متوسط سعر البيع') }}</label>
              <div class="col-md-4">
                <input type="number" name="average_price" value="{{ $item->average_price }}" class="form-control text-center" id="average_price" placeholder="00">
			        </div>
		      </div>

          <div class="form-group row">
  						<label for="expiration_date" class="col-md-2 control-label">{{ __('تاريخ انتهاء الصلحيه') }}</label>
              <div class="col-md-4">
                <input type="number" name="expiration_date" value="{{ $item->expiration_date }}" class="form-control text-center" id="expiration_date" placeholder="00">
			        </div>
		      </div>

					<button type="submit" class="btn btn-success">{{ __('تعديل') }}</button>
					</form>
      </div>
		  <!-- /.card-body -->
		</div>
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


			$(window).keydown(function(event){
		    if(event.keyCode == 13) {
		      event.preventDefault();
		      return false;
		    }
		  });
		})(jQuery)
	</script>
@endsection
