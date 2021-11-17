@extends('stander')

@section('title')
	{{ __('تعديل العميل') }}
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
        <h3 class="card-title">{{ __('تعديل عميل') }}</h3>
      </div>
			<!-- form start -->
      <div class="card-body">
				<form class="form-horizontal" action="{{ route('user.update', ['id'=> $user->id]) }}" method="post">
					@csrf

          <div class="form-group row">
							<label for="id" class="col-md-2 control-label">{{ __('الكود التعريفي') }}</label>
              <div class="col-md-4">
                <input type="text" class="form-control" value="{{ $user->id }}" id="id" placeholder="00">
					    </div>
					</div>
          <input type="hidden" name="type" value="customer">
					<div class="form-group row">
  						<label for="name" class="col-md-2 control-label">{{ __('الاسم بالكامل') }}</label>
              <div class="col-md-4">
                <input type="text" name="title" value="{{ $user->title }}" class="form-control" id="name" placeholder="{{ __('أكتب اسم العميل هنا') }}">
			        </div>
		      </div>

          <div class="form-group row">
  						<label for="phone" class="col-md-2 control-label">{{ __('رقم الهاتف') }}</label>
              <div class="col-md-4">
                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" id="phone" placeholder="{{ __('أكتب اسم العميل هنا') }}">
			        </div>
		      </div>

          <div class="form-group row">
  						<label for="address" class="col-md-2 control-label">{{ __('العنوان') }}</label>
              <div class="col-md-4">
                <input type="text" name="address" value="{{ $user->address }}" class="form-control" id="address" placeholder="{{ __('أكتب العنوان هنا') }}">
			        </div>
		      </div>

          <div class="form-group row">
  						<label for="address" class="col-md-2 control-label">{{ __('الرصيد') }}</label>
              <div class="col-md-4">
                <input type="text" name="balance" class="form-control" id="address" value="{{ $user->balance }}" placeholder="00">
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
