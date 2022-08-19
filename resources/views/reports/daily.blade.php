@extends('stander')

@section('title')
    {{ __('التقرير اليومي') }}
@endsection

@section('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body ">
                <form class="row p-0 m-0" action="{{ route('reports.daily') }}" method="get">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title" class="control-label">{{ __('تاريخ اليوم') }}</label>
                            <input class="form-control date" name="from" id="from">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title" class="control-label">.</label>
                            <br>
                            <button type="submit" name="result" value="yes" class="btn btn-primary">
                                {{ __('أصدار التقرير') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                @if (count($itemsCash) > 0)
                    <h5 class="text-primary mb-3">** {{ __('الاصناف المباعه نقداً') }}</h5>
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th>{{ __('باركود الصنف') }}</th>
                                <th>{{ __('اسم الصنف') }}</th>
                                <th>{{ __('القسم') }}</th>
                                <th>{{ __('الموديل') }}</th>
                                <th>{{ __('الكمية المباعه') }}</th>
                                <th>{{ __('إجمالي المبيعات') }}</th>
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
                                        <td>{{ $item->totals }}ج</td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>

                    <hr class="mt-4 mb-4">
                @endif

                @if (count($itemsDues) > 0)
                    <h5 class="text-danger mb-3">** {{ __('الاصناف المباعه أجال') }}</h5>
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th>{{ __('باركود الصنف') }}</th>
                                <th>{{ __('اسم الصنف') }}</th>
                                <th>{{ __('القسم') }}</th>
                                <th>{{ __('الموديل') }}</th>
                                <th>{{ __('الكمية المباعه') }}</th>
                                <th>{{ __('إجمالي المبيعات') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @isset($items) --}}
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
                                        <td>{{ $item->totals }}ج</td>
                                    </tr>
                                @endforeach
                            {{-- @endisset --}}
                        </tbody>
                    </table>

                    <hr class="mt-4 mb-4">
                @endif

                @if (count($installments) > 0)
                    <h5 class="text-danger mb-3">** {{ __('الأقساط الجديده') }}</h5>
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

                @if (count($installments) > 0)
                    <h5 class="text-danger mb-3">** {{ __('الأقساط المسدده') }}</h5>
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
        })(jQuery)
    </script>
@endsection
