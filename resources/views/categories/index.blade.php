@extends('stander')

@section('title')
	{{ __('الأقسام') }}
@endsection

@section('content')
  {{-- Create Form --}}
  <div class="col-md-4 mt-3">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">{{ __('أضف قسم جديد') }}</h3>
      </div>
			<!-- form start -->
      <div class="card-body">
				<form class="" action="{{ route('category.store') }}" method="post">
					@csrf
					<input type="hidden" name="type" value="category">
          <div class="form-group">
  						<label for="barcode" class="control-label">{{ __('اسم القسم') }}</label>
              <input type="text" autofocus name="title" class="form-control" id="barcode" placeholder="{{ __('اكتب اسم القسم هنا') }}">
		      </div>

          <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
        </form>
      </div>
    </div>
  </div>

	{{-- Categories --}}
  <div class="col-md-8 mt-3">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">{{ __('الأقسام') }}</h3>
      </div>
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th>{{ __('اسم القسم') }}</th>
              <th>{{ __('التحكم') }}</th>
            </tr>
          </thead>
          <tbody>
						@if (isset($categories))
							@if (count($categories) > 0)
								@foreach ($categories as $category)
									<tr>
										<td class="align-middle">{{ $category->title }}</td>
										<td class="py-0 align-middle">

											{{-- <div class="btn-group btn-group-sm"> --}}
											<form class="p-0 m-0" action="{{ route('category.status', ['id' => $category->id]) }}" onsubmit="return confirm('{{ __('هل انت متاكد من حذف القسم !') }}')" method="post">
												@csrf
												<input type="hidden" name="publish" value="0">
												<button type="button" href="#" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#edit-category-{{ $category->id }}">
													<i class="fas fa-edit"></i>
												</button>
												<button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-eye-slash"></i></button>
											</form>
											{{-- </div> --}}
										</td>
									</tr>

									<div class="modal fade" id="edit-category-{{ $category->id }}">
						        <div class="modal-dialog">
						          <div class="modal-content">
						            <div class="modal-header">
						              <h4 class="modal-title">
														<i class="fas fa-edit"></i>
														{{ __('تعديل') }}
														<span class="text-info">({{ $category->title }})</span></h4>
						              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						                <span aria-hidden="true">&times;</span>
						              </button>
						            </div>

												<form class="" action="{{ route('category.update', ['id' => $category->id]) }}" method="post">
													@csrf
						            <div class="modal-body">
														<input type="hidden" name="type" value="category">
									          <div class="form-group">
									  						<label for="barcode" class="control-label">{{ __('اسم القسم') }}</label>
									              <input type="text" name="title" class="form-control" id="barcode" placeholder="{{ __('اكتب اسم القسم هنا') }}">
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
					      <!-- /.modal -->
								@endforeach
							@else
								<tr>
									<td colspan="2"class="text-center" >
										{{ __('لم يتم العثور علي اي قسم حتي الان') }}
									</td>
								</tr>
							@endif
						@else
							<tr>
								<td colspan="2"class="text-center" >
									{{ __('لم يتم العثور علي اي قسم حتي الان') }}
								</td>
							</tr>
						@endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
