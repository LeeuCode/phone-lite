<form action="" method="post">
    @csrf
    <div class="modal fade" id="modal-delete" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('حذف متعدّد') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="type" class="control-label small">{{ __('الاصناف') }}</label>
                            <select name="items[]" class="form-control selected-items" multiple>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('إغلاق') }}</button>
                    <button type="button" class="btn btn-danger">{{ __('حذف') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>