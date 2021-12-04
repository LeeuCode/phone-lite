$.AdminLTESidebarTweak = {};

$.AdminLTESidebarTweak.options = {
    EnableRemember: true,
    NoTransitionAfterReload: false
    //Removes the transition after page reload.
};

$(function () {
    "use strict";

    $("body").on("collapsed.pushMenu", function(){
        if($.AdminLTESidebarTweak.options.EnableRemember){
            document.cookie = "toggleState=closed";
        }
    });

    $(document).on("expanded.pushMenu", function(){
        if($.AdminLTESidebarTweak.options.EnableRemember){
            document.cookie = "toggleState=opened";
        }
    });

    if($.AdminLTESidebarTweak.options.EnableRemember){
        var re = new RegExp('toggleState' + "=([^;]+)");
        var value = re.exec(document.cookie);
        var toggleState = (value != null) ? unescape(value[1]) : null;
        if(toggleState == 'closed'){
            if($.AdminLTESidebarTweak.options.NoTransitionAfterReload){
                $("body").addClass('sidebar-collapse hold-transition').delay(100).queue(function(){
                    $(this).removeClass('hold-transition');
                });
            }else{
                $("body").addClass('sidebar-collapse');
            }
        }
    }
});


function createTr(url,selector) {
  var barcode = selector,
  trClone = $('.clone').clone(),
  trInvoiceClone = $('.clone-invoice').clone()
  content = trClone.removeClass('clone').removeClass('d-none'),
  contentInovicePrint = trInvoiceClone.removeClass('clone-invoice').removeClass('hidden-print'),
  trID = $('#'+barcode),
  trInvoice = $('#in'+barcode),
  trQuantity = Number(trID.find('.qt').val());

  if (trID.length) {
    var QtContent = Number(content.find('.qt').val()), // Quantity value.
    qtTotal = ++trQuantity, // Quantity total.
    itemPrice = Number(trID.find('.price').val()), // Price currant tr.
    itemPurchasingPrice = Number(trID.find('.purchasing_price').val()), // Price currant tr.
    itemTotal = (qtTotal*itemPrice),
    itemTotalPurchasing = (qtTotal*itemPurchasingPrice);

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
    $.get(url,{ id:barcode }, function(data, status){
      // Object.keys(data).length != 0
      // Check if data object empty.
      if(data.item !== null) {
        if (data.store_balance != 0) {
          //====== Add table raw to GUI interface user. ======//
          appendContent(content,data,barcode);

          appendToPrint(contentInovicePrint, data, barcode);

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
  $('.item-total').each(function(){
    total = total + Number($(this).val());
  });
  $('.totalItems').val(total);
  $('.totalPrint').text(total);
}

function discountTotal() {
  var total = $('.totalItems').val(),
      discount = $('.discount_amount').val();

  $('.total_discount').val(0);
  if (discount >= 0 || total >= 0){
    $('.total_discount').val(total-discount);
  }
}

function disPercentTotal() {
  var total = $('.totalItems').val(),
      discount = $('.discount_amount').val();

  $('.total_discount').val(0);
  if (discount > 0){
    $('.total_discount').val(total-discount);
  }
}

function taxRate() {
  var tax_rate = Number($('#tax_rate').val()),
      total = Number($('#total_discount').val());

  return (total * tax_rate) / 100;
}

function totalTax() {
  var total_discount = Number($('#total_discount').val()),
      tax_rate = taxRate();

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

function appendContent(content,data, barcode) {
  //====== Add table raw to GUI interface user. ======//
  content.attr('id', barcode);
  content.addClass('apend-item');
  content.find('.barcode').text(data.item.barcode);
  content.find('.item_id').val(data.item.id);
  content.find('.title').val(data.item.title);

  if(data.itemPrice != null) {
    priceByType(content,data.itemPrice);
  } else {
    priceByType(content,data.item);
  }

  // content.find('.store_balance').val(data.item.store_balance-1);
  content.find('.store_balance').attr('data-balance',data.item.store_balance);
  content.find('.qt').val(1);

  $(content).prependTo(".table");
}

function appendToPrint(contentInovicePrint, data,  barcode) {
  //====== Add table raw to Print table. ======//
  contentInovicePrint.addClass('apend-item-prent');
  contentInovicePrint.attr('id', 'in'+barcode);
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

function priceByType(content,data) {
  content.find('.price').val(data.selling_price);
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
      invoiceType = $('#invoice_type').val();

  if (invoiceType == 'purchase' || invoiceType == 'bounce') {
    content.find('.store_balance').val(balance+qt);
  } else {
    content.find('.store_balance').val(balance-qt);
  }
}

function clcQtInstallments() {
  var qt = $('#quantity').val(),
      balance = $('#balance').data('balance'),
      advancePurchase = $('#advance_purchase').val(),
      price = $('#installment_selling_price').val(),
      totalQt = (balance-qt);

  $('#balance').val(totalQt);
  $('#remaining_installments').val((price*qt)-advancePurchase);

  interestValue();
  monthlyInstallment();
}

function interestValue() {
  var number_months = $('#number_months').val(),
      purchasingPrice = $('#purchasing_price').val(),
      sellingPrice = $('#installment_selling_price').val(),
      quantity = $('#quantity').val(),
      interestValue = (sellingPrice-purchasingPrice);

  $('#interest_value').val(interestValue*quantity);
}

function monthlyInstallment() {
  var remainingInstallments = $('#remaining_installments').val(),
      months = $('#number_months').val(),
      monthsCount = (remainingInstallments/months);

  $('#monthly_installment').val(monthsCount.toFixed(2));
}

/**
 * @param selector
 * @param url
 */
function select2Ajax(selector,url)
{
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
                    results: $.map(data.items,function (item) {
                      // console.log(item.);
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

    /**
     * Enable all stores or custom stores.
     */
    // $('input[name=store_option]').change(function(){
    //     var val = $(this).val(),
    //         store = $('.custom-stores');
    //
    //     if (val == 'custom') {
    //         store.show();
    //     } else {
    //         store.hide();
    //     }
    // });
}
