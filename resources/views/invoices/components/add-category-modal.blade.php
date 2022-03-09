<div class="modal fade" data-backdrop="static" id="add-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fas fa-edit"></i>
                    <span class="title agentName" >{{ __('تعديل') }}</span>
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
                                    <label for="barcode" class="control-label agentName">{{ __('اسم عميل') }}</label>
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