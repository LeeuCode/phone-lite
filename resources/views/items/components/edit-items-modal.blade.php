<form action="" method="post">
    @csrf
    <div class="modal fade" id="modal-edit" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('تحرير متعدّد') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type" class="control-label small">{{ __('الاصناف') }}</label>
                            <select name="items[]" class="form-control selected-items" multiple>
                            </select>
                        </div>
                    </div>
    
                    <div class="col-md-6">
                        <div class="form-group input-group-sm">
                            <label for="type" class="control-label small">{{ __('القسم') }}</label>
                            <select name="cat_id" class="form-control cat_id">
                                <option value="" selected>{{ __('اختار القسم') }}...</option>
                            </select>
                        </div>
        
                        <div class="form-group input-group-sm">
                            <label for="type" class="control-label small">{{ __('الموديل') }}</label>
                            <select name="model" class="form-control model">
                                <option value="" selected>{{ __('اختار الموديل') }}...</option>
                            </select>
                        </div>
        
                        <div class="form-group input-group-sm">
                            <label for="type" class="control-label small">{{ __('وحدة المنتج') }}</label>
                            <select name="unit_id" class="form-control unit_id">
                                <option value="" selected>{{ __('اختار الوحده') }}...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('إغلاق') }}</button>
                    <button type="button" class="btn btn-primary">{{ __('تعديل') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>