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
</div>
