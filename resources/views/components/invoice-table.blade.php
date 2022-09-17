<table class="table">
    <thead class="text-center">
        <tr>
            <th>{{ __('رقم الفاتوره') }}</th>
            <th>{{ __('نوع الحركه') }}</th>
            <th>{{ __('العميل/المورد') }}</th>
            <th>{{ __('الاجمالي') }}</th>
            <th>{{ __('خصم مبلغ') }}</th>
            <th>{{ __('اجمالي بعد الخصم') }}</th>
            <th>{{ __('نسبة الضريبه') }}</th>
            <th>{{ __('إجمالي بعد الضريبه') }}</th>
            {{-- <th>{{ __('متوسط سعر البيع') }}</th> --}}
            <th></th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $invoice->id }}</td>
                <td>{{ movementType($invoice->movement_type) }}</td>
                <td>
                    {!! (isset($invoice->customer->title)) ? '<a href="'.route('user.purchases', ['id' => $invoice->customer->id]).'">'.$invoice->customer->title.'</a>' : __('لا يوجد') !!}
                </td>
                <td>{{ $invoice->total }}</td>
                <td>{{ $invoice->discount_amount }}</td>
                <td>{{ $invoice->total_discount }}</td>
                <td>{{ $invoice->tax_rate }}</td>
                <td>{{ $invoice->total_bill }}</td>
                {{-- <td>{{ $item->average_price }}</td> --}}
                <td>
                    {{-- <form action="{{ route('item.status', ['id' => $invoice->id]) }}" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف العنصر؟!') }}')" method="post"> --}}
                    {{-- @csrf --}}
                    <a href="{{ route('invoices.edit', ['id' => $invoice->id]) }}"
                        class="btn btn-outline-info">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{ route('invoices.view', ['id' => $invoice->id]) }}"
                        class="btn btn-outline-success">
                        <i class="fa fa-eye"></i>
                    </a>
                    {{-- </form> --}}
                </td>
            </tr>
        @endforeach
    </tbody>
    @if ($invoices->hasPages())
        <tfoot>
            <tr>
                <td colspan="9">
                    {{ $invoices->links() }}
                </td>
            </tr>
        </tfoot>
    @endif
</table>