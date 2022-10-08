@php
if (isset($invoice)) {
    $inv = $invoice;
} else {
    $inv = '';
}

$show = false;

if (request()->routeIs('invoices.purchase')) {
    $show = true;
}
@endphp

<tr id="2" class="items clone d-none">
    <td class="text-center d-none">
        <input type="hidden" name="item[id][]" class="form-control item_id w-100 border-0" readonly>
    </td>
    <td style="width:15%" class="text-center barcode"></td>
    <td style="width:25%" class="text-center">
        <input type="text" class="form-control p-0 title border-0 text-center" readonly>
    </td>
    <td style="width:15%" class="text-center">
        <input type="number" name="item[store_balance][]" class="form-control store_balance w-100 border-0" readonly>
    </td>
    <td class="text-center purchasing" {!! getVal($inv, 'invoice_type') != 'purchase' && !$show ? 'style="display: none;"' : '' !!}>
        <input type="number" name="item[purchasing_price][]"
            class="form-control purchasing_price w-100 {!! getVal($inv, 'invoice_type') != 'purchase' && !$show ? 'border-0' : '' !!}" {!! getVal($inv, 'invoice_type') != 'purchase' && !$show ? 'readonly' : '' !!}>
    </td>
    <td class="text-center">
        <input type="number" name="item[selling_price][]" class="form-control price w-100">
    </td>
    <td>
        <input type="number" name="item[qt][]" min="1" class="form-control form-control-sm text-center qt"
            placeholder="00">
    </td>
    <td class="text-center col-md-1">
        <input type="number" name="item[item_total][]" class="form-control w-100 item-total border-0 p-0 text-center"
            readonly>
    </td>
    <td>
        <button type="button" class="btn btn-sm btn-danger remove-item" name="button">
            <i class="fas fa-times"></i>
        </button>
    </td>
</tr>
