@extends('stander')

@section('title')
	{{ __('أضافة مستخدم جديد') }}
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
        <h3 class="card-title">{{ __('أضافة مستخدم جديد') }}</h3>
      </div>
			<!-- form start -->
      <div class="card-body">
				@if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

				<form class="form-horizontal" action="{{ route('users.employee.store') }}" method="post">
					@csrf

					<div class="form-group row">
  						<label for="name" class="col-md-3 control-label">{{ __('اسم المستخدم') }}</label>
              <div class="col-md-8">
  							<input type="text" name="name" class="form-control" placeholder="{{ __('أكتب اسم المستخدم هنا') }}" required autofocus autocomplete="off">
  						</div>
		      </div>

					<div class="form-group row">
							<label for="email" class="col-md-3 control-label">{{ __('البريد الالكتروني') }}</label>
              <div class="col-md-8">
  							<input type="email" name="email" class="form-control" placeholder="{{ __('أكتب البريد الإلكتروني') }}">
  						</div>
					</div>

          <div class="form-group row">
							<label for="password" class="col-md-3 control-label">{{ __('كلمة السر') }}</label>
              <div class="col-md-8">
                <input type="password" name="password" class="form-control" id="password">
					    </div>
					</div>

          <div class="form-group row">
							<label for="password_confirmation" class="col-md-3 control-label">{{ __('تاكيد كلمة السر') }}</label>
              <div class="col-md-8">
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
					    </div>
					</div>

					<div class="form-group row">
							<label for="quantity" class="col-md-3 control-label">{{ __('الصلاحية') }}</label>
              <div class="col-md-8">
                <select class="form-control" name="role">
                  <option value="">{{ __('أختار صلاحية من الصلاحيات المتااحه') }}</option>
									@foreach ($permissions as $permission)
										<option value="{{ $permission->id }}">{{ $permission->title }}</option>
									@endforeach
                </select>
					    </div>
					</div>

					<button type="submit" class="btn btn-primary">{{ __('إنشاء مستخدم') }}</button>
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

			select2Ajax('#customer_id', '{{ route('ajax.getCustomers') }}');

			$(document).on('submit', '.create-user', function(e){
				e.preventDefault();
				var url = $(this).attr('action'),
						data = $(this).serialize();

					$.post(url,data,function(data, status){
						$('input[name=title] , input[name=phone]').val('');
						$('#add-category').modal('hide');
				  });
			});

			$(document).on('click', '.add-cat',function(){
				var title = $(this).data('title'),
						type = $(this).data('type');

				$('.title').text(title);
				$('input[name=type]').val(type);
			});

			$(window).keydown(function(event){
		    if(event.keyCode == 13) {
		      event.preventDefault();
		      return false;
		    }
		  });

			$('#item_id').on('select2:select', function (e) {
				var item = e.params.data;

				$.get("{{ route('ajax.getItem') }}",{ id:item.barcode }, function(data, status){
					var itemData = data.item;
							$('#balance').data('balance',itemData.store_balance),
							$('#balance').val(itemData.store_balance);
					$('#purchasing_price').val(itemData.selling_price);
					$('#installment_selling_price').val(itemData.selling_price);

					clcQtInstallments();
				});
			});

			$(document).on('keyup', '#quantity', function () {
				clcQtInstallments();
			});

			$(document).on('keyup', '#number_months', function() {
				monthlyInstallment();
			});

			$(document).on('keyup', '#installment_selling_price', function () {
				clcQtInstallments();
			});

			$(document).on('keyup', '#advance_purchase', function() {
				clcQtInstallments();
			});

		})(jQuery)
	</script>
@endsection
