@extends('stander')

@section('title')
    {{ __('التقرير اليومي') }}
@endsection

@section('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@php
// Sale.
$paids = 0;
$cash = 0;
$total = 0;

// Bounce.
$paidsBounce = 0;
$cashBounce = 0;
$totalBounce = 0;

// Bounce Dameg.
$paidsBounceDameg = 0;
$cashBounceDameg = 0;
$totalBounceDameg = 0;

// Purchase.
$paidsPurchase = 0;
$cashPurchase = 0;
$totalPurchase = 0;
@endphp

@section('content')
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body ">
                <form class="row p-0 m-0 wh-100" action="{{ route('reports.daily') }}" method="get">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title" class="control-label">{{ __('تاريخ اليوم') }}</label>
                            <input class="form-control date" name="from" id="from">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="title" class="control-label text-white">.</label>
                            <br>
                            <button type="submit" name="result" value="yes" class="btn btn-success">
                                {{ __('أصدار  تقرير مفصل') }}
                            </button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="title" class="control-label text-white">.</label>
                            <br>
                            <button type="submit" class="btn btn-primary">
                                {{ __('أصدار  تقرير سريع') }}
                            </button>
                        </div>
                    </div>

                    <div class="col-md-5 d-flex align-items-center flex-row-reverse">
                        <button type="button" class="mb-2 mt-3 btn btn-info float-right print">
                            <i class="fa fa-print" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="card">
            <div id="daily-report" class="card-body">

                @include('components.report-header-info', ['type' => __('تقرير يومي'), 'date' => $date])
                {{-- Items Cash Loop --}}
                @if (count($itemsCash) > 0)
                    <h5 class="text-primary mb-3">* {{ __('الاصناف المباعه نقداً') }}</h5>
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th>{{ __('باركود الصنف') }}</th>
                                <th>{{ __('اسم الصنف') }}</th>
                                <th>{{ __('القسم') }}</th>
                                <th>{{ __('الموديل') }}</th>
                                <th>{{ __('الكمية المباعه') }}</th>
                                {{-- <th>{{ __('إجمالي المبيعات') }}</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @isset($itemsCash)
                                @foreach ($itemsCash as $item)
                                    <tr class="text-center">
                                        <td>{{ $item->item->barcode }}</td>
                                        <td>{{ $item->item->title }}</td>
                                        <td>
                                            @php
                                                $catConut = $item->item->category()->count();
                                            @endphp
                                            @if ($catConut)
                                                {{ $item->item->category->title }}
                                            @else
                                                {{ __('لا يتوفر') }}
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $modelsConut = $item->item->models()->count();
                                            @endphp
                                            @if ($modelsConut)
                                                {{ $item->item->models->title }}
                                            @else
                                                {{ __('لا يتوفر') }}
                                            @endif
                                        </td>
                                        <td>{{ $item->quantities }}</td>
                                        {{-- <td>{{ $item->totals }}ج</td> --}}
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>

                    <hr class="mt-4 mb-4">
                @endif
                {{-- ./Items Cash Loop --}}

                {{-- Items Dues Loop --}}
                @if (count($itemsDues) > 0)
                    <h5 class="text-danger mb-3">* {{ __('الاصناف المباعه أجال') }}</h5>
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th>{{ __('باركود الصنف') }}</th>
                                <th>{{ __('اسم الصنف') }}</th>
                                <th>{{ __('القسم') }}</th>
                                <th>{{ __('الموديل') }}</th>
                                <th>{{ __('الكمية المباعه') }}</th>
                                {{-- <th>{{ __('إجمالي المبيعات') }}</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itemsDues as $item)
                                <tr class="text-center">
                                    <td>{{ $item->item->barcode }}</td>
                                    <td>{{ $item->item->title }}</td>
                                    <td>
                                        @php
                                            $catConut = $item->item->category()->count();
                                        @endphp
                                        @if ($catConut)
                                            {{ $item->item->category->title }}
                                        @else
                                            {{ __('لا يتوفر') }}
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $modelsConut = $item->item->models()->count();
                                        @endphp
                                        @if ($modelsConut)
                                            {{ $item->item->models->title }}
                                        @else
                                            {{ __('لا يتوفر') }}
                                        @endif
                                    </td>

                                    <td>{{ $item->quantities }}</td>
                                    {{-- <td>{{ $item->totals }}ج</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr class="mt-4 mb-4">
                @endif
                {{-- ./Items Dues Loop --}}

                {{-- Invoice Sale --}}
                @if (count($invoiceSale) > 0)
                    <h5 class="text-primary mb-3">* {{ __('مجموع فواتير المبيعات') }}</h5>
                    <table class="table">
                        {{-- <thead> --}}
                        <tr class="text-center">
                            <th>{{ __('نوع الحركة') }}</th>
                            <th>{{ __('عدد الفواتير') }}</th>
                            <th>{{ __('المجموع') }}</th>
                            <th>{{ __('مجموع المدفوعات') }}</th>
                            <th>{{ __('المتبقي') }}</th>
                            {{-- <th>{{ __('إجمالي المبيعات') }}</th> --}}
                        </tr>
                        {{-- </thead> --}}
                        <tbody>

                            @foreach ($invoiceSale as $item)
                                @php
                                    if ($item->movement_type == 'cash') {
                                        $cash = $item->total_bills;
                                    }
                                    
                                    if ($item->movement_type == 'dues') {
                                        $paids = $item->paids;
                                    }
                                @endphp
                                <tr class="text-center">
                                    <td>{{ movementType($item->movement_type) }}</td>
                                    <td>{{ $item->quantities }}</td>
                                    <td>{{ $item->total_bills }}ج</td>
                                    <td>{{ $item->paids }}ج</td>
                                    <td>{{ $item->residuals }}ج</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-right">
                                    <h5>مجموع النقديه لفواتير المبيعات</h5>
                                </td>
                                <td class="text-center">
                                    <h4>{{ $total = $cash + $paids }}ج</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <hr class="mt-4 mb-4">
                @endif
                {{-- ./Invoice Sale --}}

                {{-- Invoice Bounce --}}
                @if (count($invoiceBounce) > 0)
                    <h5 class="text-warning mb-3">* {{ __('مجموع فواتير المرتجع') }}</h5>
                    <table class="table">
                        {{-- <thead> --}}
                        <tr class="text-center">
                            <th>{{ __('نوع الحركة') }}</th>
                            <th>{{ __('عدد الفواتير') }}</th>
                            <th>{{ __('المجموع') }}</th>
                            <th>{{ __('مجموع المدفوعات') }}</th>
                            <th>{{ __('المتبقي') }}</th>
                            {{-- <th>{{ __('إجمالي المبيعات') }}</th> --}}
                        </tr>
                        {{-- </thead> --}}
                        <tbody>
                            @foreach ($invoiceBounce as $item)
                                @php
                                    if ($item->movement_type == 'cash') {
                                        $cashBounce = $item->total_bills;
                                    }
                                    
                                    if ($item->movement_type == 'dues') {
                                        $paidsBounce = $item->paids;
                                    }
                                @endphp
                                <tr class="text-center">
                                    <td>{{ movementType($item->movement_type) }}</td>
                                    <td>{{ $item->quantities }}</td>
                                    <td>{{ $item->total_bills }}ج</td>
                                    <td>{{ $item->paids }}ج</td>
                                    <td>{{ $item->residuals }}ج</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-right">
                                    <h5>مجموع النقديه لفواتير المرتجع</h5>
                                </td>
                                <td class="text-center">
                                    <h4>{{ $totalBounce = $cashBounce + $paidsBounce }}ج</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <hr class="mt-4 mb-4">
                @endif
                {{-- ./Invoice Bounce --}}

                {{-- Invoice Bounce Dameg --}}
                @if (count($invoiceBounceDameg) > 0)
                    <h5 class="text-danger mb-3">* {{ __('مجموع فواتير المرتجع التالف') }}</h5>
                    <table class="table">
                        {{-- <thead> --}}
                        <tr class="text-center">
                            <th>{{ __('نوع الحركة') }}</th>
                            <th>{{ __('عدد الفواتير') }}</th>
                            <th>{{ __('المجموع') }}</th>
                            <th>{{ __('مجموع المدفوعات') }}</th>
                            <th>{{ __('المتبقي') }}</th>
                        </tr>
                        {{-- </thead> --}}
                        <tbody>
                            @foreach ($invoiceBounceDameg as $item)
                                @php
                                    if ($item->movement_type == 'cash') {
                                        $cashBounceDameg = $item->total_bills;
                                    }
                                    
                                    if ($item->movement_type == 'dues') {
                                        $paidsBounceDameg = $item->paids;
                                    }
                                @endphp
                                <tr class="text-center">
                                    <td>{{ movementType($item->movement_type) }}</td>
                                    <td>{{ $item->quantities }}</td>
                                    <td>{{ $item->total_bills }}ج</td>
                                    <td>{{ $item->paids }}ج</td>
                                    <td>{{ $item->residuals }}ج</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-right">
                                    <h5>مجموع النقديه لفواتير التوالف</h5>
                                </td>
                                <td class="text-center">
                                    <h4>{{ $totalBounceDameg = $cashBounceDameg + $paidsBounceDameg }}ج</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <hr class="mt-4 mb-4">
                @endif
                {{-- ./Invoice Bounce Dameg --}}

                {{-- Invoice Purchase --}}
                @if (count($invoicePurchase) > 0)
                    <h5 class="text-success mb-3">* {{ __('مجموع فواتير المشتريات') }}</h5>
                    <table class="table">
                        {{-- <thead> --}}
                        <tr class="text-center">
                            <th>{{ __('نوع الحركة') }}</th>
                            <th>{{ __('عدد الفواتير') }}</th>
                            <th>{{ __('المجموع') }}</th>
                            <th>{{ __('مجموع المدفوعات') }}</th>
                            <th>{{ __('المتبقي') }}</th>
                            {{-- <th>{{ __('إجمالي المبيعات') }}</th> --}}
                        </tr>
                        {{-- </thead> --}}
                        <tbody>
                            @foreach ($invoicePurchase as $item)
                                @php
                                    if ($item->movement_type == 'cash') {
                                        $cashPurchase = $item->total_bills;
                                    }
                                    
                                    if ($item->movement_type == 'dues') {
                                        $paidsPurchase = $item->paids;
                                    }
                                @endphp
                                <tr class="text-center">
                                    <td>{{ movementType($item->movement_type) }}</td>
                                    <td>{{ $item->quantities }}</td>
                                    <td>{{ $item->total_bills }}ج</td>
                                    <td>{{ $item->paids }}ج</td>
                                    <td>{{ $item->residuals }}ج</td>
                                </tr>
                            @endforeach
                            <tr>
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-right">
                                    <h5>مجموع النقديه لفواتير المشتريات</h5>
                                </td>
                                <td class="text-center">
                                    <h4>{{ $totalPurchase = $cashPurchase + $paidsPurchase }}ج</h4>
                                </td>
                            </tr>
                            </tr>
                        </tbody>
                    </table>

                    <hr class="mt-4 mb-4">
                @endif
                {{-- ./Invoice Purchase --}}


                {{-- Installments --}}
                @if (count($installments) > 0)
                    <h5 class="text-danger mb-3">* {{ __('الأقساط الجديده') }}</h5>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>{{ __('اسم العميل') }}</th>
                                <th>{{ __('رقم الهاتف') }}</th>
                                <th>{{ __('الصنف') }}</th>
                                <th>{{ __('الكمية المباعة') }}</th>
                                <th>{{ __('عدد الاشهر') }}</th>
                                <th>{{ __('الأقساط المدفوعه') }}</th>
                                <th>{{ __('الاقساط المتبقيه') }}</th>
                                <th>{{ __('القسط الشهري') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($installments) > 0)
                                @foreach ($installments as $installment)
                                    <tr>
                                        <td>{{ $installment->customer->title }}</td>
                                        <td>{{ $installment->customer->phone }}</td>
                                        <td>
                                            @php
                                                $itemConut = $installment->item()->count();
                                            @endphp
                                            @if ($itemConut)
                                                {{ $installment->item->title }}
                                            @else
                                                {{ __('لا يتوفر') }}
                                            @endif
                                        </td>
                                        <td>{{ $installment->quantity }}</td>
                                        <td>{{ $installment->number_months }}</td>
                                        <td>{{ $installment->premiums_paid }}</td>
                                        <td>{{ $installment->remaining_installments }}</td>
                                        <td>{{ $installment->monthly_installment }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-center">
                                        <i>
                                            @if (request()->routeIs('devices.search'))
                                                {{ __('لا توجد نتائج مطابقة لعملية بحثك') }}
                                            @else
                                                {{ __('لا توجد اي اقساط حتي الان') }}
                                            @endif
                                        </i>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <hr class="mt-4 mb-4">
                @endif
                {{-- Installments --}}

                @if (count($installments) > 0)
                    <h5 class="text-danger mb-3">* {{ __('الأقساط المسدده') }}</h5>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>{{ __('اسم العميل') }}</th>
                                <th>{{ __('رقم الهاتف') }}</th>
                                <th>{{ __('الصنف') }}</th>
                                <th>{{ __('الكمية المباعة') }}</th>
                                <th>{{ __('عدد الاشهر') }}</th>
                                <th>{{ __('الأقساط المدفوعه') }}</th>
                                <th>{{ __('الاقساط المتبقيه') }}</th>
                                <th>{{ __('القسط الشهري') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($installments) > 0)
                                @foreach ($installments as $installment)
                                    <tr>
                                        <td>{{ $installment->customer->title }}</td>
                                        <td>{{ $installment->customer->phone }}</td>
                                        <td>
                                            @php
                                                $itemConut = $installment->item()->count();
                                            @endphp
                                            @if ($itemConut)
                                                {{ $installment->item->title }}
                                            @else
                                                {{ __('لا يتوفر') }}
                                            @endif
                                        </td>
                                        <td>{{ $installment->quantity }}</td>
                                        <td>{{ $installment->number_months }}</td>
                                        <td>{{ $installment->premiums_paid }}</td>
                                        <td>{{ $installment->remaining_installments }}</td>
                                        <td>{{ $installment->monthly_installment }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-center">
                                        <i>
                                            @if (request()->routeIs('devices.search'))
                                                {{ __('لا توجد نتائج مطابقة لعملية بحثك') }}
                                            @else
                                                {{ __('لا توجد اي اقساط حتي الان') }}
                                            @endif
                                        </i>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <hr class="mt-4 mb-4">
                @endif

                <h4 class="text-center">
                    {{ __('اجمالي النقديه بالخزينة') }}
                    <br>
                    <span class="text-info">{{ $total + $totalBounce - $totalBounceDameg - $totalPurchase }}ج</span>
                </h4>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- InputMask -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- printThis -->
    <script src="{{ asset('dist/js/printThis.js') }}" charset="utf-8"></script>

    <script>
        (function($) {
            //Date range picker with time picker
            $('.date').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                timePickerIncrement: 30,
                format: 'LT',
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });

            $(document).on('click', '.print', function() {
                $("#daily-report").printThis({
                    debug: false,
                    importCSS: true,
                    // loadCSS: "{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}",
                });
            });
        })(jQuery)
    </script>
@endsection
