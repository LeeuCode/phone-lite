<div class="modal fade" data-backdrop="static" id="calculation">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fas fa-cash-register"></i>
                    <span class="title" >{{ __('الحساب') }}</span>
                    {{-- <span class="text-info">({{ $category->title }})</span> --}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="create-category" action="{{ route('ajax.createCategory') }}" method="post">
                @csrf
            <div class="modal-body">
                    <h3 class="text-center">اجمالي الحساب</h3>
                    <h1 class="text-center text-danger">
                        <span class="total" >0</span>ج
                        <input id="all-total" type="hidden" name="total_bill" class="total" value="0">
                    </h1>
                    {{-- <input type="hidden" name="type" value="category"> --}}
                    <div class="form-group text-center">
                            <label for="paid" class="control-label">{{ __('المدفوع') }}</label>
                            <input type="number" name="paid" class="form-control text-center paid" id="paid" placeholder="00" autocomplete="off">
                    </div>
                    <div class="form-group text-center">
                            <label for="residual" class="control-label">{{ __('المتبقي') }}</label>
                            <input type="text" name="residual" class="form-control text-center" id="residual" value="0" placeholder="00">
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