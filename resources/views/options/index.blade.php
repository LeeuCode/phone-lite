@extends('stander')

@section('title')
    {{ __('إعدادات النظام') }}
@endsection

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="col-md-6 ml-auto mr-auto mt-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ __('إعدادات انظام') }}</h3>
            </div>
            <!-- form start -->
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('settings.update') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label" for="logo">{{ __('الشعار') }}</label>
                        <div class="col-md-3">
                            @php
                                $logo = getOption('logo');
                                $src = asset('images/default.jpg');
                                if ($logo) {
                                    $src = asset('images/' . $logo);
                                }
                            @endphp
                            <input type="hidden" name="logo" value="{{ $logo }}">
                            <img id="preview-featured-image" src="{{ $src }}" class="rounded w-100"
                                alt="Cinque Terre">
                            <input id="logo" onchange="privewImage(this)" accept="image/*" type="file"
                                name="logo">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="balance" class="col-md-4 control-label">{{ __('اسم النشاط التجاري') }}</label>
                        <div class="col-md-6">
                            <input type="text" name="shop_name" value="{{ getOption('shop_name') }}"
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="balance" class="col-md-4 control-label">{{ __('مكان النشاط التجاري') }}</label>
                        <div class="col-md-6">
                            <input type="text" name="shop_location" value="{{ getOption('shop_location') }}"
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 control-label">{{ __('رقم الهاتف') }}</label>
                        <div class="col-md-6">
                            <input type="text" name="phone" class="form-control" value="{{ getOption('phone') }}"
                                id="phone">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="facebook" class="col-md-4 control-label">{{ __('رابط الفيس بوك') }}</label>
                        <div class="col-md-6">
                            <input type="text" name="facebook" value="{{ getOption('facebook') }}" class="form-control"
                                id="facebook">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="twitter" class="col-md-4 control-label">{{ __('رابط تويتير') }}</label>
                        <div class="col-md-6">
                            <input type="text" name="twitter" value="{{ getOption('twitter') }}" class="form-control"
                                id="twitter">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="whatsapp" class="col-md-4 control-label">{{ __('رقم الواتس اب') }}</label>
                        <div class="col-md-6">
                            <input type="text" name="whatsapp" value="{{ getOption('whatsapp') }}" class="form-control"
                                id="whatsapp">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="offers" class="col-md-4 control-label">{{ __('العروض') }}</label>
                        <div class="col-md-6">
                            <input type="text" name="offers" value="{{ getOption('offers') }}" class="form-control"
                                id="offers">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="thanks" class="col-md-4 control-label">{{ __('رسالة الشكر') }}</label>
                        <div class="col-md-6">
                            <input type="text" name="thanks" value="{{ getOption('thanks') }}" class="form-control"
                                id="thanks">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('تحديث') }}</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        function privewImage(key) {
            var imageSrc = key.previousElementSibling;
            const [file] = key.files
            if (file) {
                imageSrc.src = URL.createObjectURL(file)
            }
        }

        (function($) {
            let imgInp = document.getElementById('feature-image');
            let blah = document.getElementById('preview-featured-image');

            // Replace the <textarea id="editor1"> with a CKEditor 4
            // instance, using default configuration.
            // CKEDITOR.replace( 'content' );

            select2Ajax('#item_id', '{{ route('ajax.getItems') }}');

            select2Ajax('#customer_id', '{{ route('ajax.getCustomers') }}');

            $(document).on('submit', '.create-user', function(e) {
                e.preventDefault();
                var url = $(this).attr('action'),
                    data = $(this).serialize();

                $.post(url, data, function(data, status) {
                    $('input[name=title] , input[name=phone]').val('');
                    $('#add-category').modal('hide');
                });
            });

            $(document).on('click', '.add-cat', function() {
                var title = $(this).data('title'),
                    type = $(this).data('type');

                $('.title').text(title);
                $('input[name=type]').val(type);
            });

            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            $('#item_id').on('select2:select', function(e) {
                var item = e.params.data;

                $.get("{{ route('ajax.getItem') }}", {
                    id: item.barcode
                }, function(data, status) {
                    var itemData = data.item;
                    $('#balance').data('balance', itemData.store_balance),
                        $('#balance').val(itemData.store_balance);
                    $('#purchasing_price').val(itemData.selling_price);
                    $('#installment_selling_price').val(itemData.selling_price);

                    clcQtInstallments();
                });
            });

            $(document).on('keyup', '#quantity', function() {
                clcQtInstallments();
            });

            $(document).on('keyup', '#number_months', function() {
                monthlyInstallment();
            });

            $(document).on('keyup', '#installment_selling_price', function() {
                clcQtInstallments();
            });

            $(document).on('keyup', '#advance_purchase', function() {
                clcQtInstallments();
            });

        })(jQuery)
    </script>
@endsection
