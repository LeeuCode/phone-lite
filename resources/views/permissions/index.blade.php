@extends('stander')

@section('title')
	{{ __('صلاحيات المستخدمين') }}
@endsection

@section('content')
	{{-- <a href="{{ route('item.create') }}" class="btn btn-info mt-3 mr-3" >
		<i class="fa fa-plus" ></i>
		{{ __('أضافة صنف جديد') }}
	</a>

	<a href="{{ route('item.create') }}" data-toggle="modal" data-target="#modal-search" class="btn btn-outline-primary mt-3" style="margin-right: auto;margin-left:1rem;" >
		<i class="fa fa-search" ></i>
		{{ __('البحث عن الاصناف') }}
	</a>

	<div class="col-md-12 mt-3">
    <ul class="nav">
      <li class="nav-item">
        <a class="p-1 f-12" href="{{ route('items') }}">
          <small>{{ __('كل الأصناف') }} ({{ DB::table('items')->where('publish', 1)->count() }})</small>
        </a>
      </li>
      |
      <li class="nav-item ">
        <a class="p-1 text-danger" href="{{ route('installment.paids') }}">
          <small>{{ __('الأصناف المحذوفه') }} ({{ DB::table('items')->where('publish', 0)->count() }})</small>
        </a>
      </li>
    </ul>
  </div> --}}

	<div class="col-md-6 mr-auto ml-auto mt-3">
		<a href="{{ route('permission.create') }}" class="btn btn-info mt-3 mb-3" >
		 <i class="fa fa-plus" ></i>
		 {{ __('أضف صلاحية جديدة') }}
		</a>
		<div class="card">
			<div class="card-body p-0">
				<table class="table" >
					<thead>
						<tr>
							<th>{{ __('الصلاحية') }}</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($permissions as $permission)
							<tr>
								<td>{{ $permission->title }}</td>
								<td>
									<form action="{{ route('item.status', ['id' => $permission->id]) }}" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف العنصر؟!') }}')" method="post">
										@csrf
										<a href="{{ route('permission.edit', ['id' => $permission->id]) }}" class="btn btn-outline-info" >
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
					<tfoot>
						<tr>
							<td colspan="9">
								{{ $permissions->links() }}
							</td>
						</tr>
					</tfoot>
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
		        <h4 class="modal-title">{{ __('البحث عن الأصناف') }}</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">

						<div class="form-group">
							<label for="id" class="control-label small">{{ __('باركود الصنف') }}</label>
							<input type="number" name="barcode" class="form-control text-center" id="barcode" placeholder="00">
						</div>

						<div class="form-group">
							<label for="id" class="control-label small">{{ __('اسم الصنف') }}</label>
							<input type="text" name="title" class="form-control" id="title" placeholder="{{ __('أكتب اسم الصنف اذا لم تتذكر الباركود') }}" autocomplete="off">
						</div>

						<div class="form-group">
							<label for="type" class="control-label small">{{ __('القسم') }}</label>
							<select name="cat_id" class="form-control" id="cat_id">
              	<option value="" selected>{{ __('اختار القسم') }}...</option>
              </select>
						</div>

						<div class="form-group">
							<label for="type" class="control-label small">{{ __('الموديل') }}</label>
							<select name="model" class="form-control" id="model">
								<option value="" selected>{{ __('اختار الموديل') }}...</option>
							</select>
						</div>

						<div class="form-group">
							<label for="type" class="control-label small">{{ __('وحدة المنتج') }}</label>
							<select name="unit_id" class="form-control" id="unit_id">
              	<option value="" selected>{{ __('اختار الوحده') }}...</option>
              </select>
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
