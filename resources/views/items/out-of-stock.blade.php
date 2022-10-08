@extends('stander')

@section('title')
    {{ __('الأصناف') }}
@endsection

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="col-md-12">
        <h5 class="mb-2 mt-3 float-left">
            <i class="nav-icon fas fa-database"></i>
            {{ __('منتجات علي وشك النفاذ') }}

        </h5>
        <button class="mb-2 mt-3 btn btn-info float-right print">
            <i class="fa fa-print" aria-hidden="true"></i>
        </button>
    </div>

    <div class="col-md-12 mt-3">
        <div id="of-stock" class="card">
            <div class="card-body p-0">
                
                @include('components.report-header-info', ['type' => __('منتجات اوشكت علي النفاذ')])

                <table class="table">
                    {{-- <thead> --}}
                    <tr>
                        <th>
                            <div class="icheck-primary d-inline">
                                #
                            </div>
                        </th>
                        <th>{{ __('باركود الصنف') }}</th>
                        <th>{{ __('اسم الصنف') }}</th>
                        <th>{{ __('القسم') }}</th>
                        <th>{{ __('الموديل') }}</th>
                        <th>{{ __('وحدة المنتج') }}</th>
                        <th>{{ __('الكمية المتاحه') }}</th>
                    </tr>
                    {{-- </thead> --}}
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>
                                    {{ $item->id }}.
                                </td>
                                <td>{{ $item->barcode }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    @php
                                        $catConut = $item->category()->count();
                                    @endphp
                                    @if ($catConut)
                                        {{ $item->category->title }}
                                    @else
                                        {{ __('لا يتوفر') }}
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $modelsConut = $item->models()->count();
                                    @endphp
                                    @if ($modelsConut)
                                        {{ $item->models->title }}
                                    @else
                                        {{ __('لا يتوفر') }}
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $unitiesConut = $item->unities()->count();
                                    @endphp
                                    @if ($unitiesConut)
                                        {{ $item->unities->title }}
                                    @else
                                        {{ __('لا يتوفر') }}
                                    @endif
                                </td>
                                <td>{{ $item->store_balance }}</td>
                                {{-- <td>{{ $item->selling_price }}</td>
                                <td>{{ $item->average_price }}</td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <td colspan="9">
                                {{ $items->links() }}
                            </td>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
        </div>
    </div>


    {{-- @include('items.components.search-modal')

    @include('items.components.edit-items-modal')

    @include('items.components.delete-items-modal') --}}
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- JsBarcode -->
    <script src="{{ asset('dist/js/JsBarcode.all.min.js') }}"></script>
    <!-- printThis -->
    <script src="{{ asset('dist/js/printThis.js') }}" charset="utf-8"></script>

    <script>
        (function($) {
            $(document).on('click', '.print', function() {
                $("#of-stock").printThis({
                    debug: false,
                    importCSS: true,
                    // loadCSS: "{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}",
                });
            });

        })(jQuery)
    </script>
@endsection
