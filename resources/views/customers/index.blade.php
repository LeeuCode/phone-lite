@extends('stander')

@section('title')
	{{ __('العملاء') }}
@endsection

@section('css')
	<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
	<a href="{{ route('user.create') }}" class="btn btn-info mt-3 mr-3" >
		<i class="fa fa-plus" ></i>
		{{ __('أضافة عميل جديد') }}
	</a>

	<a href="{{ route('item.create') }}" data-toggle="modal" data-target="#modal-search" class="btn btn-outline-primary mt-3" style="margin-right: auto;margin-left:1rem;" >
		<i class="fa fa-search" ></i>
		{{ __('البحث عن العملاء') }}
	</a>
	<div class="col-md-12 mt-3">
		<div class="card">
			<div class="card-body p-0">
				<table class="table" >
					<thead>
						<tr>
							<th>{{ __('اسم المورد') }}</th>
							<th>{{ __('رقم الهاتف') }}</th>
							<th>{{ __('العنوان') }}</th>
							<th>{{ __('الرصيد') }}</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
							<tr>
								<td>
									<a href="{{ route('user.purchases', ['id' => $user->id]) }}">
										{{ $user->title }}
									</a>
								</td>
								<td>{{ $user->phone }}</td>
								<td>{{ $user->address }}</td>
								<td>{{ $user->balance }}</td>
								<td>
									<form action="{{ route('user.destroy', ['id' => $user->id]) }}" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف العنصر؟!') }}')" method="post">
										@csrf
										<a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-outline-info" >
											<i class="fa fa-edit" ></i>
										</a>
										<button type="submit" class="btn btn-outline-danger" >
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
	<form class="m-0" action="{{ route('item.search') }}" method="get">
		<div class="modal fade" id="modal-search">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title">{{ __('البحث عن العملاء') }}</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body row">

						<div class="col-md-6">
							<div class="form-group">
								<label for="id" class="control-label small">{{ __('باركود الصنف') }}</label>
								<input type="number" name="barcode" class="form-control text-center" id="barcode" placeholder="00">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="id" class="control-label small">{{ __('اسم العميل') }}</label>
								<input type="text" name="title" class="form-control" id="title" placeholder="{{ __('أكتب اسم العميل هنا.') }}" autocomplete="off">
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
			select2Ajax('#cat_id', '{{ route('ajax.getCategories') }}');

			select2Ajax('#model', '{{ route('ajax.getModels') }}');

			select2Ajax('#unit_id', '{{ route('ajax.getunities') }}');


			// $(window).keydown(function(event){
		  //   if(event.keyCode == 13) {
		  //     event.preventDefault();
		  //     return false;
		  //   }
		  // });
		})(jQuery)
	</script>

@endsection
