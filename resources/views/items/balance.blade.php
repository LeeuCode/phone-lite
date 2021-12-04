@extends('stander')

@section('title')
	{{ __('رصيد اول المدة') }}
@endsection

@section('css')
	<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
  <div class="col-md-6 ml-auto mr-auto mt-3">
		<div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">{{ __('رصيد اول المدة') }}</h3>
      </div>
			<!-- form start -->
      <div class="card-body">
				<form class="form-horizontal" action="{{ route('item.balance.store') }}" method="post">
					@csrf

					<div class="form-group row">
							<label for="title" class="col-md-3 control-label">{{ __('اسم الصنف') }}</label>
              <div class="col-md-8">
  							<select name="item_id" class="form-control" id="item_id" required>
									<option value="">{{ __('اختار من الاصناف') }}</option>
  							</select>
  						</div>
					</div>

          <div class="form-group row">
							<label for="store_balance" class="col-md-3 control-label">{{ __('الكمية') }}</label>
              <div class="col-md-8">
                <input type="text" name="store_balance" class="form-control text-center" id="store_balance" placeholder="00" required>
					    </div>
					</div>

					<button type="submit" class="btn btn-primary">{{ __('أضف الكميه') }}</button>
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
					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form class="create-user" action="{{ route('ajax.createUser') }}" method="post">
						@csrf
						<div class="modal-body">
								<input type="hidden" name="type" value="customer">
								<div class="form-group">
										<label for="barcode" class="control-label">{{ __('اسم عميل') }}</label>
										<input type="text" name="title" class="form-control" id="barcode" placeholder="{{ __('اكتب العنوان هنا') }}">
								</div>

								<div class="form-group">
										<label for="barcode" class="control-label">{{ __('رقم المحمول') }}</label>
										<input type="text" name="phone" class="form-control" id="barcode" placeholder="{{ __('أكتب رقم تليفون العميل') }}">
								</div>
						</div>
						<div class="modal-footer justify-content-between">
							<button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('إغلاق') }}</button>
							 <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
						</div>
				</form>
			</div>
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
			select2Ajax('#item_id', '{{ route('ajax.getItems') }}');

      $(window).keydown(function(event){
		    if(event.keyCode == 13) {
		      event.preventDefault();
		      return false;
		    }
		  });
      
		})(jQuery)
	</script>
@endsection
