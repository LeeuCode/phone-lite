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
    <td style="width:15%" class="">
        <input type="number" name="item[store_balance][]" class="form-control text-center store_balance w-100 border-0" readonly>
    </td>
    <td class="purchasing" {!! getVal($inv, 'invoice_type') != 'purchase' && !$show ? 'style="display: none;width:10%"' : 'style="width:10%;"' !!}>
        <input type="number" name="item[purchasing_price][]"
            class="form-control text-center purchasing_price w-100 {!! getVal($inv, 'invoice_type') != 'purchase' && !$show ? 'border-0' : '' !!}" {!! getVal($inv, 'invoice_type') != 'purchase' && !$show ? 'readonly' : '' !!}>
    </td>
    <td style="width:10%" >
        <input type="number" name="item[selling_price][]" class="text-center form-control price w-100">
    </td>
    <td style="width:10%">
        <input type="number" name="item[qt][]" min="1" class="form-control  text-center qt"
            placeholder="00">
    </td>
    <td style="width:10%">
        <input type="number" name="item[item_total][]" class="form-control w-100 item-total border-0 p-0 text-center"
            readonly>
    </td>
    <td  style="width:5%">
        <button type="button" class="btn btn-sm btn-danger remove-item" name="button">
            <i class="fas fa-times"></i>
        </button>
    </td>
</tr>
