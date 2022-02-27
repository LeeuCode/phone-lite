@extends('stander')

@section('title')
	{{ __('تعديل المستخدم') }}
@endsection

@section('css')
	<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
  <div class="col-md-6 ml-auto mr-auto mt-3">
		<div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">{{ __('تعديل المستخدم') }}</h3>
      </div>
			<!-- form start -->
      <div class="card-body">
				<form class="form-horizontal" action="{{ route('users.employee.update', ['id'=> $user->id ]) }}" method="post">
					@csrf

					<div class="form-group row">
  						<label for="name" class="col-md-3 control-label">{{ __('اسم المستخدم') }}</label>
              <div class="col-md-8">
  							<input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="{{ __('أكتب اسم المستخدم هنا') }}" required>
  						</div>
		      </div>

					<div class="form-group row">
							<label for="email" class="col-md-3 control-label">{{ __('البريد الالكتروني') }}</label>
              <div class="col-md-8">
  							<input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="{{ __('أكتب البريد الإلكتروني') }}">
  						</div>
					</div>

          <div class="form-check mb-3">
            <input type="checkbox" name="change_password" class="form-check-input" id="change-password">
            <label class="form-check-label" for="change-password">{{ __('تغير كلمة المرور') }}</label>
          </div>

          <div class="change-password" style="display:none">
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
          </div>

					<div class="form-group row">
							<label for="quantity" class="col-md-3 control-label">{{ __('الصلاحية') }}</label>
              <div class="col-md-8">
                <select class="form-control" name="role">
                  <option value="">{{ __('أختار صلاحية من الصلاحيات المتااحه') }}</option>
									@foreach ($permissions as $permission)
										<option value="{{ $permission->id }}" {!! ($permission->id == $user->role) ? 'selected' : '' !!} >{{ $permission->title }}</option>
									@endforeach
                </select>
					    </div>
					</div>

					<button type="submit" class="btn btn-success">{{ __('تحديث المستخدم') }}</button>
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
	<script>
		(function($){
			$(document).on('change', '#change-password', function(){
        $('.change-password').toggle();
      });
		})(jQuery)
	</script>
@endsection
