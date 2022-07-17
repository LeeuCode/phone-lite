@extends('stander')

@section('title')
{{ __('فاتورة') }}
@endsection

@section('content')
<form id="invoice-save" class="w-100 row" action="{{ route('invoice.save') }}" method="post">
	@include('components.invoice-header', ['id' => $id])
	@csrf
	<div class="col-md-10">
		<div class="card">
			{{-- <div class="card-body"> --}}
			<table class="table table-bordered mb-0">
				<thead>
					@include('components.invoice-table-header')
				</thead>
				<tbody>
					@include('components.invoice-item-clone')
				</tbody>
			</table>
			{{-- </div> --}}
		</div>
	</div>
	@include('components.invoice-discount')

	@include('invoices.components.calculation')
</form>

@include('invoices.print', ['id' => 'ticket', 'title' => 'فاتورة بيع'])

@include('invoices.components.add-category-modal')

@endsection

@section('js')
<script src="{{ asset('dist/js/printThis.js') }}" charset="utf-8"></script>
<script>
	(function($) {

		$(document).on('click', '.remove-item', function() {
			var tr = $(this).parent().parent(),
				itemTotal = Number(tr.find('.item-total').val()),
				totalItems = Number($('.totalItems').val()),
				barcode = tr.find('.barcode').text();

			$('.totalItems').val((totalItems - itemTotal));
			discountTotal();
			$('#tax_value').val(taxRate());
			$('#total_tax, .total, #residual').val(totalTax());
			$('.total').text(totalTax());
			tr.remove();
			$('#in' + barcode).remove();

			console.log(barcode);
		});

		$(document).on('keydown', '.barcode', function(e) {
			if (e.which == 13) {
				e.preventDefault();
				createTr("{{ route('ajax.getItem') }}", $(this).val())
			}
		});

		$(document).on('keyup', '.discount_amount', function() {
			discountTotal();
		});

		$(document).on('keyup', '.qt', function() {
			var trRow = $(this).parent().parent(),
				barcode = trRow.attr('id'),
				qt = $(this).val(),
				itemPrice = trRow.find('.price').val(),
				itemPurchasingPrice = trRow.find('.purchasing_price').val(),
				totalItems = $('.totalItems').val(),
				total = (qt * itemPrice),
				totalPurchasing = (qt * itemPurchasingPrice),
				trInvoice = $('#in' + barcode),
				invoiceType = $('#invoice_type').val(),
				balance = trRow.find('.store_balance').data('balance');

			if (invoiceType == 'purchase') {
				trRow.find('.item-total').val(totalPurchasing);
				trInvoice.find('.prnt-item-total').text(totalPurchasing);
			} else {
				if (qt > balance ) {
					Swal.fire({
						title: 'تنبيه!',
						text: "الكمية التي ادخلتها اكبر من الموجوده بالمخزن!",
						icon: 'warning',
						showCancelButton: false,
						confirmButtonColor: '#3085d6',
						// cancelButtonColor: '#d33',
						confirmButtonText: 'حسناً'
					});

					trRow.find('.store_balance').val(balance-1);
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

			itemTotalPrice();
			storeBalance(trRow);
			discountTotal();
			$('#tax_value').val(taxRate());
			$('#total_tax, .total, #residual').val(totalTax());
			$('.total').text(totalTax());
			trInvoice.find('.quantity').text(qt);
		});

		$(document).on('keyup', '#tax_rate', function() {
			$('#tax_value').val(taxRate());
			$('#total_tax, .total, #residual').val(totalTax());
			$('.total').text(totalTax());
		});

		$('body').on('keydown', function(e) {
			if (e.keyCode == 112) {
				e.preventDefault();

				$('#invoice-save').submit();
			}
		});

		$('#invoice-save').on('submit', function(e) {
			e.preventDefault();
			var url = $(this).attr('action'),
				data = $(this).serialize(),
				total = $('#all-total').val(),
				paid = $('#paid').val();

			$('#paid').focus();
			if (total != 0) {
				if (paid != '') {
					$.ajax({
						type: 'POST',
						url: url,
						data: data,
						beforeSend: function() {
							$("#ticket").printThis({
								debug: false,
								importCSS: false,
								loadCSS: "{{ asset('dist/css/print-installments.css') }}",
							});
						},
						success: function(data) {
							$('.apend-item-prent').remove();
							$('#id').val(data.id);
							resetForm();
						},
						error: function(xhr) { // if error occured
							alert("Error occured.please try again");
							$(placeholder).append(xhr.statusText + xhr.responseText);
							$(placeholder).removeClass('loading');
						}
					});
				} else {
					$('#calculation').modal('show');
				}
			} else {
				// alert('يجب ان تختار عنصر واحد علي الاقل')
				Swal.fire({
					title: 'تنبيه!',
					text: "يجب ان تختار عنصر واحد علي الاقل",
					icon: 'warning',
					showCancelButton: false,
					confirmButtonColor: '#3085d6',
					// cancelButtonColor: '#d33',
					confirmButtonText: 'حسناً'
				});
			}
		});

		$(document).on('keydown', '#invoice-save', function(e) {
			if (e.which == 13) {
				e.preventDefault();
				return false;
			}
		});

		$(document).on('keyup', '#paid', function() {
			var paid = $(this).val(),
				total = $('#all-total').val();

			$('#residual').val(total - paid);
		});

		$(document).on('keyup', '#discount_amount', function() {
			// var discount = $(this).val();
			$('.total').text(totalTax());
		});

		invoiceType();
	})(jQuery)

	function invoiceType() {
		var type = $('#invoice_type').val(),
			movement_type = $('#movement_type').val();

		$("#supplier_id, #customer_id").empty();

		if (type == 'purchase') {
			$('.purchasing, .dues').show();
			$('.purchasing_price, .price').attr('readonly', false);
			$('.purchasing_price, .price').removeClass('border-0');

			$('input[name=type]').val('suppliers');
			$('.user-type').attr('id', 'supplier_id');
			$('.agentName').text('اسم المورد');
			select2Ajax('#supplier_id', '{{ route('ajax.getSuppliers') }}');
		} else {
			if (movement_type == 'dues') {
				$('.dues').show();
			} else {
				$('.dues').hide();
			}

			$('.purchasing').hide();
			$('.purchasing_price, .price').attr('readonly', true);
			$('.purchasing_price, .price').addClass('border-0');

			$('input[name=type]').val('customer');
			$('.user-type').attr('id', 'customer_id');
			$('.agentName').text('اسم العميل');

			select2Ajax('#customer_id', '{{ route('ajax.getCustomers') }}');
		}
	}
</script>
@endsection