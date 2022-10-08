$.AdminLTESidebarTweak = {};

$.AdminLTESidebarTweak.options = {
    EnableRemember: true,
    NoTransitionAfterReload: false
    //Removes the transition after page reload.
};

(function ($) {
    "use strict";

    $(document).keydown(function (event) {
        if (event.keyCode == 123) { // Prevent F12
            return false;
        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
            return false;
        }
    });

    $("body").on("collapsed.pushMenu", function () {
        if ($.AdminLTESidebarTweak.options.EnableRemember) {
            document.cookie = "toggleState=closed";
        }
    });

    $(document).on("expanded.pushMenu", function () {
        if ($.AdminLTESidebarTweak.options.EnableRemember) {
            document.cookie = "toggleState=opened";
        }
    });

    if ($.AdminLTESidebarTweak.options.EnableRemember) {
        var re = new RegExp('toggleState' + "=([^;]+)");
        var value = re.exec(document.cookie);
        var toggleState = (value != null) ? unescape(value[1]) : null;
        if (toggleState == 'closed') {
            if ($.AdminLTESidebarTweak.options.NoTransitionAfterReload) {
                $("body").addClass('sidebar-collapse hold-transition').delay(100).queue(function () {
                    $(this).removeClass('hold-transition');
                });
            } else {
                $("body").addClass('sidebar-collapse');
            }
        }
    }

    $(document).on('click', '.add-cat', function () {
        var title = $(this).data('title'),
            type = $(this).data('type');

        $('.title').text(title);
        $('input[name=type]').val(type);
    });

    $(document).on('click', '#barcode_btn', function (e) {
        e.preventDefault();
        var val1 = Math.floor(1000 + Math.random() * 999);
        var val2 = Math.floor(100 + Math.random() * 99);
        var barcodeNum = '7' + val1 + val2;
        $('#barcode').val(barcodeNum);
    });

    $(document).on('click', '.change-mode', function (e) {
        e.preventDefault();
        var mode = $(this).data('mode');

        if (mode == 'dark') {
            setCookie('body-mode', 'dark-mode');
            setCookie('nav-mode', 'navbar-dark');

            $('.dark-mode-nav').addClass('d-none');
            $('.white-mode-nav').removeClass('d-none');
        } else {
            setCookie('body-mode', '');
            setCookie('nav-mode', 'navbar-white navbar-light');

            $('.dark-mode-nav').removeClass('d-none');
            $('.white-mode-nav').addClass('d-none');
        }

        $('body').removeClass('dark-mode').addClass(getCookie('body-mode'));
        $('.navbar').removeClass('navbar-dark').removeClass('navbar-white').removeClass('navbar-light').addClass(getCookie('nav-mode'));
    });

    $(document).on('focusout', '.price', function () {
        var avrage = Number($(this).data('avrage')),
            sale_price = Number($(this).data('price')),
            price = Number($(this).val()),
            trRow = $(this).parent().parent(),
            barcode = trRow.attr('id'),
            qt = trRow.find('.qt').val(),
            itemPrice = trRow.find('.price').val(),
            itemPurchasingPrice = trRow.find('.purchasing_price').val(),
            totalItems = $('.totalItems').val(),
            total = (qt * itemPrice),
            totalPurchasing = (qt * itemPurchasingPrice),
            trInvoice = $('#in' + barcode),
            invoiceType = $('#invoice_type').val(),
            balance = trRow.find('.store_balance').data('balance');


        if (invoiceType != 'bounce_dameg') {
            // console.log('run');
            if (invoiceType == 'purchase') {
                trRow.find('.item-total').val(totalPurchasing);
                trInvoice.find('.prnt-item-total').text(totalPurchasing);
            } else {
                if (qt > balance) {
                    Swal.fire({
                        title: 'تنبيه!',
                        text: "الكمية التي ادخلتها اكبر من الموجوده بالمخزن!",
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        // cancelButtonColor: '#d33',
                        confirmButtonText: 'حسناً'
                    });

                    trRow.find('.store_balance').val(balance - 1);
                    qt = $(this).val(1);
                    total = (1 * itemPrice);

                    trRow.find('.item-total').val(total);
                    trInvoice.find('.prnt-item-total').text(total);
                    itemTotalPrice();
                    storeBalance(trRow);
                    discountTotal();

                    return false;
                }

                trRow.find('.item-total').val(total);
                trInvoice.find('.prnt-item-total').text(total);
            }
        }

        itemTotalPrice();
        storeBalance(trRow);
        discountTotal();
        $('#tax_value').val(taxRate());
        $('#total_tax, .total, #residual').val(totalTax());
        $('.total').text(totalTax());
        trInvoice.find('.quantity').text(qt);

        console.log(qt);

        if (price < avrage) {
            Swal.fire({
                title: 'تنبيه!',
                text: "لا يجب ان تتعدا متوسط سعر البيع و هو " + avrage + "ج",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                // cancelButtonColor: '#d33',
                confirmButtonText: 'حسناً'
            });
            $(this).val(sale_price);

        }

    });

    $('body').addClass(getCookie('body-mode'));

    if (getCookie('nav-mode') == 'navbar-dark' || getCookie('nav-mode') != '') {
        $('.navbar').removeClass('navbar-white').removeClass('navbar-light').addClass(getCookie('nav-mode'));

        $('.dark-mode-nav').addClass('d-none');
        $('.white-mode-nav').removeClass('d-none');

        // console.log(getCookie('nav-mode'));
    } else {
        $('.dark-mode-nav').removeClass('d-none');
        $('.white-mode-nav').addClass('d-none');
    }



})(jQuery);

function createTr(url, selector) {
    var barcode = selector,
        trClone = $('.clone').clone(),
        trInvoiceClone = $('.clone-invoice').clone()
    content = trClone.removeClass('clone').removeClass('d-none'),
        contentInovicePrint = trInvoiceClone.removeClass('clone-invoice').removeClass('hidden-print'),
        trID = $('#' + barcode),
        trInvoice = $('#in' + barcode),
        trQuantity = Number(trID.find('.qt').val()),
        trStoreBlance = Number(trID.find('.store_balance').val());

    if (trStoreBlance == 0) {
        Swal.fire({
            title: 'تنبيه!',
            text: "الكمية غير متاحة بالمخزن",
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            confirmButtonText: 'حسناً'
        });

        return false;
    }

    if (trID.length) {
        var QtContent = Number(content.find('.qt').val()), // Quantity value.
            qtTotal = ++trQuantity, // Quantity total.
            itemPrice = Number(trID.find('.price').val()), // Price currant tr.
            itemPurchasingPrice = Number(trID.find('.purchasing_price').val()), // Price currant tr.
            itemTotal = (qtTotal * itemPrice),
            itemTotalPurchasing = (qtTotal * itemPurchasingPrice);

        trID.find('.qt').val(qtTotal);

        if ($('#invoice_type').val() == 'purchase') {
            trID.find('.item-total').val(itemTotalPurchasing);
            trInvoice.find('.prnt-item-total').text(itemTotalPurchasing);
        } else {
            trID.find('.item-total').val(itemTotal);
            trInvoice.find('.prnt-item-total').text(itemTotal);
        }

        trInvoice.find('.quantity').text(qtTotal);

        storeBalance(trID);
        itemTotalPrice();
        discountTotal();

        $('#tax_value').val(taxRate());
        $('#total_tax, .total, #residual').val(totalTax());
        $('.total').text(totalTax());
    } else {
        $.get(url, { id: barcode }, function (data, status) {
            // Object.keys(data).length != 0
            // Check if data object empty.
            if (data.item !== null) {
                if (data.store_balance != 0) {
                    //====== Add table raw to GUI interface user. ======//
                    appendContent(content, data, barcode);

                    /* appendToPrint(contentInovicePrint, data, barcode); */

                    storeBalance(content);
                    itemTotalPrice();
                    discountTotal();

                    $('#tax_value').val(taxRate());
                    $('#total_tax, .total, #residual').val(totalTax());
                    $('.total').text(totalTax());
                } else {
                    alert('لا يوجد كمية متاحه بالمخزون !');
                }
            } else {
                alert('لا يوجد صنف مطابق لرقم البار كود')
            }
        });
    }

    $('.barcode').val('');
}

function itemTotalPrice() {
    var total = 0;
    $('.totalItems').val(0);
    $('.item-total').each(function () {
        total = total + Number($(this).val());
    });
    $('.totalItems').val(total);
    $('.totalPrint').text(total);
}

function discountTotal() {
    var total = $('.totalItems').val(),
        discount = $('.discount_amount').val();

    $('.total_discount').val(0);
    if (discount >= 0 || total >= 0) {
        $('.total_discount').val(total - discount);
        $('.discount-amount').text(discount);

        $('#total_tax, .total, #residual').val(totalTax());
        $('.total, .totalPrint').text(totalTax());
    }
}

function disPercentTotal() {
    var total = $('.totalItems').val(),
        discount = $('.discount_amount').val();

    $('.total_discount').val(0);
    if (discount > 0) {
        $('.total_discount').val(total - discount);
        $('.discount-amount').text(discount);

        $('#total_tax, .total, #residual').val(totalTax());
        $('.total, .totalPrint').text(totalTax());
    }
}

function taxRate() {
    var tax_rate = Number($('#tax_rate').val()),
        total = Number($('#total_discount').val());

    return (total * tax_rate) / 100;
}

function totalTax() {
    var total_discount = Number($('#total_discount').val()),
        tax_rate = taxRate(),
        discount_amount = $('#discount_amount').val();

    return (total_discount - tax_rate);
}

function resetForm() {
    $('.apend-item').remove();
    $('.totalItems, .discount_amount, .total_discount, #all-total, #tax_value, #total_tax, #residual').val('0');
    $('.total').text(0);
    $('.total, #paid').val('');
    $('#calculation').modal('hide');
    $('.barcode').focus();
}

function appendContent(content, data, barcode) {
    //====== Add table raw to GUI interface user. ======//
    content.attr('id', barcode);
    content.addClass('apend-item');
    content.find('.barcode').text(data.item.barcode);
    content.find('.item_id').val(data.item.id);
    content.find('.title').val(data.item.title);

    if (data.itemPrice != null) {
        priceByType(content, data.itemPrice);
    } else {
        priceByType(content, data.item);
    }

    // content.find('.store_balance').val(data.item.store_balance-1);
    content.find('.store_balance').attr('data-balance', data.item.store_balance);
    content.find('.qt').val(1);

    $(content).prependTo(".table");
}

function appendToPrint(contentInovicePrint, data, barcode) {
    //====== Add table raw to Print table. ======//
    contentInovicePrint.addClass('apend-item-prent');
    contentInovicePrint.attr('id', 'in' + barcode);
    contentInovicePrint.find('.description').text(data.item.title);
    contentInovicePrint.find('.quantity').text(1);
    // contentInovicePrint.find('.invoice-price').text(data.item.selling_price);
    // contentInovicePrint.find('.prnt-item-total').text(data.item.selling_price);

    if ($('#invoice_type').val() == 'purchase') {
        contentInovicePrint.find('.invoice-price').text(data.item.purchasing_price);
        contentInovicePrint.find('.prnt-item-total').text(data.item.purchasing_price);
    } else {
        contentInovicePrint.find('.invoice-price').text(data.item.selling_price);
        contentInovicePrint.find('.prnt-item-total').text(data.item.selling_price);
    }

    $(contentInovicePrint).prependTo(".table-print");
}

function priceByType(content, data) {

    content.find('.price').val(data.selling_price);
    content.find('.price').attr('data-avrage', data.average_price);
    content.find('.price').attr('data-price', data.selling_price);
    content.find('.purchasing_price').val(data.purchasing_price);
    if ($('#invoice_type').val() == 'purchase') {
        content.find('.item-total').val(data.purchasing_price);
    } else {
        content.find('.item-total').val(data.selling_price);
    }
}

function storeBalance(content) {
    var balance = Number(content.find('.store_balance').data('balance')),
        qt = Number(content.find('.qt').val()),
        invoiceType = $('#invoice_type').val(),
        store_balance = Number(balance - qt);

    if (invoiceType == 'purchase' || invoiceType == 'bounce') {
        content.find('.store_balance').val(balance + qt);
    } else if (invoiceType == 'bounce_dameg') {
        content.find('.store_balance').val(balance);
    } else {
        content.find('.store_balance').val(store_balance);
    }
}

function clcQtInstallments() {
    var qt = $('#quantity').val(),
        balance = $('#balance').data('balance'),
        advancePurchase = $('#advance_purchase').val(),
        price = $('#installment_selling_price').val(),
        totalQt = (balance - qt);

    $('#balance').val(totalQt);
    $('#remaining_installments').val((price * qt) - advancePurchase);

    interestValue();
    monthlyInstallment();
}

function interestValue() {
    var number_months = $('#number_months').val(),
        purchasingPrice = $('#purchasing_price').val(),
        sellingPrice = $('#installment_selling_price').val(),
        quantity = $('#quantity').val(),
        interestValue = (sellingPrice - purchasingPrice);

    $('#interest_value').val(interestValue * quantity);
}

function monthlyInstallment() {
    var remainingInstallments = $('#remaining_installments').val(),
        months = $('#number_months').val(),
        monthsCount = (remainingInstallments / months);

    $('#monthly_installment').val(monthsCount.toFixed(2));
}

/**
 * @param selector
 * @param url
 */
function select2Ajax(selector, url, by = null) {
    $(selector).select2({
        dir: "rtl",
        ajax: {
            url: url,
            data: function (params) {
                return {
                    search: params.term,
                    page: params.page || 1
                };
            },
            dataType: 'json',
            processResults: function (data) {

                data.page = data.page || 1;
                return {
                    results: $.map(data.items, function (item) {
                        // console.log(item.);

                        if (by != null && by == "id") {
                            return {
                                id: item.id,
                                text: item.id,
                                barcode: item.barcode
                            };
                        }

                        return {
                            id: item.id,
                            text: item.title,
                            barcode: item.barcode
                        };
                    }),
                    pagination: {
                        more: data.pagination
                    }
                }
            },
            cache: true,
            delay: 250
        },
    });
}

function setInstallmentPrintData(data) {
    $('#installment_customer_name').text(data.installment_customer_name);
    $('#installment_customer_id').text(data.installment_customer_id);
    $('.date').text(data.date);
    $('.time').text(data.time);
    $('#installment_item_name').text(data.installment_item_name);
    $('#installment_quantity').text(data.installment_quantity);
    $('#selling_price').text(data.installment_selling_price);
    $('#installment_total').text(data.installment_selling_price);
    $('.remaining-installments').text(data.remaining_installments);
    $('#installment_number_months').text(data.number_months);
    $('.remaining_installments').val(data.remaining_installments);
    $('.premiums-paid').text(data.premiums_paid);
    $('#premiums_paid').val(data.premiums_paid);
    $('.monthly_installment').text(data.monthly_installment);
    $('.renewal_date').text(data.renewal_date);
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
