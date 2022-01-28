@extends('stander')

@section('title')
	{{ __('تعديل الصلاحيه') }}
@endsection

@section('css')
	<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
  <form class="w-100" action="{{ route('permission.update', ['id' => $groupPermission->id]) }}" method="post">
    @csrf
    <div class="col-md-12 mt-3">
      <div class="card card-primary">
        <!-- form start -->
        <div class="card-body row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="barcode" class="control-label">{{ __('العنوان') }}</label>
              <input type="text" class="form-control" name="title" value="{{ $groupPermission->title }}">
            </div>
          </div>
          {{-- </form> --}}
        </div>
        <!-- /.card-body -->
      </div>
    </div>

    <div class="col-md-12 mt-3">
      <div class="card card-primary">
        <!-- form start -->
        <div class="card-body row">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('الوحدة') }}</th>
                <th>{{ __('الصلاحية') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach (permissions() as $key => $value)
                <tr>
                  <td width="10">
                    <div class="form-group">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="{{ $key }}">
                        <label class="custom-control-label" for="{{ $key }}"></label>
                      </div>
                    </div>
                  </td>
                  <td>{{ $value['name'] }}</td>
                  <td class="row">
                    <div class="form-group">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" {!! (getPermission($groupPermission->id, $key.'_create')) ? 'checked' : '' !!} name="{{ $key.'_create' }}" class="custom-control-input" id="{{ $key.'_create' }}">
                        <label class="custom-control-label" for="{{ $key.'_create' }}">{{ __('إنشاء') }}</label>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" name="{{ $key.'_edit' }}" {!! (getPermission($groupPermission->id, $key.'_edit')) ? 'checked' : '' !!} class="custom-control-input" id="{{ $key.'_edit' }}">
                        <label class="custom-control-label" for="{{ $key.'_edit' }}">{{ __('تعديل') }}</label>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" name="{{ $key.'_view' }}" {!! (getPermission($groupPermission->id, $key.'_view')) ? 'checked' : '' !!} class="custom-control-input" id="{{ $key.'_view' }}">
                        <label class="custom-control-label" for="{{ $key.'_view' }}">{{ __('عرض') }}</label>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" name="{{ $key.'_delete' }}" {!! (getPermission($groupPermission->id, $key.'_delete')) ? 'checked' : '' !!} class="custom-control-input" id="{{ $key.'_delete' }}">
                        <label class="custom-control-label" for="{{ $key.'_delete' }}">{{ __('حذف') }}</label>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <button type="submit" class="btn btn-info">{{ __('انشاء') }}</button>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </form>
@endsection
