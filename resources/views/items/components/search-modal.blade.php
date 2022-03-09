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
                <select name="cat_id" class="form-control cat_id">
                    <option value="" selected>{{ __('اختار القسم') }}...</option>
                </select>
            </div>

            <div class="form-group">
                <label for="type" class="control-label small">{{ __('الموديل') }}</label>
                <select name="model" class="form-control model">
                    <option value="" selected>{{ __('اختار الموديل') }}...</option>
                </select>
            </div>

            <div class="form-group">
                <label for="type" class="control-label small">{{ __('وحدة المنتج') }}</label>
                <select name="unit_id" class="form-control unit_id">
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