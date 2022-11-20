<div class="modal fade" id="add-new-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary -bg-gradient-blue">
                <h4 class="modal-title">
                    <i class="fas fa-cube"></i>
                    <span class="title">{{ __('Create New Item') }}</span>
                    {{-- <span class="text-info">({{ $category->title }})</span> --}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="save-store-item" class="form-horizontal" action="{{ route('item.store') }}" method="post">
                @csrf
                <div class="modal-body row">

                    <div class="col-md-3">
                        <label for="barcode">{{ __('Item barcode') }}</label>
                        <div class="input-group">
                            <input type="number" name="barcode" class="form-control text-center" id="barcode"
                                placeholder="00" required>
                            <div class="input-group-btn  p-0 d-flex">
                                <button id="barcode_btn" type="button" class="add-cat btn btn-primary bg-gradient-dark">
                                    <i class="fas fa-barcode"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title" class="control-label">{{ __('Item Name') }}</label>
                            <input type="text" name="title" class="form-control" id="title" required
                                placeholder="{{ __('أكتب اسم الصنف اذا لم تتذكر الباركود') }}">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <label for="cat_id" class="control-label">{{ __('القسم') }}</label>
                        <div class="input-group">
                            <select name="cat_id" class="form-control" id="cat_id" required>
                                <option value="" selected>{{ __('اختار القسم') }}...</option>
                            </select>
                            <div class="input-group-btn p-0 d-flex">
                                <button type="button" class="add-cat btn btn-primary bg-gradient-dark"
                                    data-title="{{ __('أضف قسم جديد') }}" data-type="category" data-toggle="modal"
                                    data-target="#add-category" hieght="100">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="model" class="control-label">{{ __('الموديل') }}</label>
                        <div class="input-group">
                            <select name="model" class="form-control" id="model" required>
                                <option value="">{{ __('اختار الموديل') }}...</option>
                            </select>
                            <div class="input-group-btn p-0 d-flex">
                                <button type="button" class="add-cat btn btn-primary bg-gradient-dark"
                                    data-title="{{ __('أضف موديل جديد') }}" data-type="model" data-toggle="modal"
                                    data-target="#add-category">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="unit_id" class="control-label">{{ __('وحدة المنتج') }}</label>
                        <div class="input-group">
                            <select name="unit_id" class="form-control" id="unit_id" required>
                                <option value="">{{ __('اختار الوحده') }}...</option>
                            </select>
                            <div class="input-group-btn p-0 d-flex">
                                <button type="button" class="add-cat btn btn-primary bg-gradient-dark" data-title="{{ __('أضف الوحدة') }}"
                                    data-type="unity" data-toggle="modal" data-target="#add-category">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group row d-none">
                                <label for="type" class="col-md-2 control-label">{{ __('حالة المنتج') }}</label>
                                <div class="col-md-4">
                                <select name="type" class="form-control" id="type" required>
                                    <option value="" selected>{{ __('اختار حالة المنتج') }}...</option>
                                </select>
                                </div>
                            </div> --}}

                    <div class="col-md-4">
                        <label for="warranty_period" class="control-label">{{ __('مدة الضمان') }}</label>
                        <input type="number" name="warranty_period" value="0" required
                            class="form-control text-center" id="warranty_period"
                            placeholder="{{ __('اكتب مدة ضمان المنتج هنا') }}">
                    </div>

                    <div class="col-md-3 mt-3">
                        <label for="purchasing_price" class="control-label">{{ __('سعر الشراء') }}</label>
                        <input type="number" name="purchasing_price" required class="form-control text-center"
                            id="purchasing_price" placeholder="00">
                    </div>

                    <div class="col-md-3 mt-3">
                        <label for="selling_price" class="control-label">{{ __('سعر البيع') }}</label>
                        <input type="number" name="selling_price" required class="form-control text-center"
                            id="selling_price" placeholder="00">
                    </div>

                    <div class="col-md-4 mt-3">
                        <label for="average_price" class="control-label">{{ __('متوسط سعر البيع') }}</label>
                        <input type="number" name="average_price" required class="form-control text-center"
                            id="average_price" placeholder="00">
                    </div>

                    <div class="col-md-2 mt-3">
                        <label for="store_balance" class="control-label">{{ __('رصيد اول المدة') }}</label>
                        <input type="number" name="store_balance" required class="form-control text-center"
                            id="store_balance" placeholder="00">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger bg-gradient-danger" data-dismiss="modal">{{ __('إغلاق') }}</button>
                    <button type="submit" class="btn btn-primary bg-gradient-primary">{{ __('حفظ') }}</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
