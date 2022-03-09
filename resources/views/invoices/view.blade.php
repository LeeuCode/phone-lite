@extends('stander')

@section('title')
	{{ __('فاتورة') }}
@endsection

@section('content')
	<form id="invoice-save" class="w-100 row" action="{{ route('invoice.save') }}" method="post">
		@include('components.invoice-header', [
			'id' => $invoice->id,
			'invoice' => $invoice,
			'view' => true
		])
		@csrf
		<div class="col-md-10">
			<div class="card">
				{{-- <div class="card-body"> --}}
				<table class="table table-bordered mb-0">
					<thead>
						@include('components.invoice-table-header', [
							'id' => $invoice->id,
							'invoice' => $invoice,
							'view' => true
						])
					</thead>
					<tbody>
						@include('components.invoice-item-clone')
					</tbody>
				</table>
				{{-- </div> --}}
			</div>
		</div>
		@include('components.invoice-discount', ['view' => true])
	</form>

	@include('invoices.print', ['title' => 'فاتورة مبيعات'])

@endsection

{{-- @section('js')
	<script src="{{ asset('dist/js/printThis.js') }}" charset="utf-8"></script>
	<script>
		(function($){

			$(document).on('click', '.remove-item', function(){
				var tr = $(this).parent().parent(),
						itemTotal = Number(tr.find('.item-total').val()),
						totalItems = Number($('.totalItems').val());

				$('.totalItems').val((totalItems-itemTotal));
				discountTotal();
				$('#tax_value').val(taxRate());
		    $('#total_tax, .total').val(totalTax());
				$('.total').text(totalTax());
				tr.remove();
			});

			$(document).on('keydown', '.barcode', function(e){
		    if(e.which == 13) {
					e.preventDefault();
					createTr("{{ route('ajax.getItem') }}", $(this).val())
		    }
			});

			$(document).on('keyup', '.discount_amount', function(){
				discountTotal();
			});

			$(document).on('keyup', '.qt', function() {
				var trRow = $(this).parent().parent(),
						qt = $(this).val(),
						itemPrice = trRow.find('.price').val(),
						itemPurchasingPrice = trRow.find('.purchasing_price').val(),
						totalItems = $('.totalItems').val(),
						total = (qt*itemPrice),
						totalPurchasing = (qt*itemPurchasingPrice);

				if ($('#invoice_type').val() == 'purchase') {
					trRow.find('.item-total').val(totalPurchasing);
				} else {
					trRow.find('.item-total').val(total);
				}

				itemTotalPrice();
				storeBalance(trRow);
				discountTotal();
				$('#tax_value').val(taxRate());
				$('#total_tax, .total').val(totalTax());
				$('.total').text(totalTax());
			});

			$(document).on('keyup', '#tax_rate', function(){
				$('#tax_value').val(taxRate());
		    $('#total_tax, .total').val(totalTax());
				$('.total').text(totalTax());
			});

			$('body').on('keydown', function(e){
				if (e.keyCode == 112) {
					e.preventDefault();
					$('#invoice-save').submit();
				}
			});

			$('#invoice-save').on('submit', function(e){
				e.preventDefault();
				var url = $(this).attr('action'),
						data = $(this).serialize(),
						total = $('#all-total').val(),
						paid = $('#paid').val();

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
											loadCSS: "{{ asset('dist/css/print.css') }}",
											// header: "<h1>Look at all of my kitties!</h1>"
									});
								},
								success: function(data) {
									$('.apend-item-prent').remove();
									resetForm();
								},
								error: function(xhr) { // if error occured
										alert("Error occured.please try again");
										$(placeholder).append(xhr.statusText + xhr.responseText);
										$(placeholder).removeClass('loading');
								},
						});
					} else {
						$('#calculation').modal('show');
					}
				} else {
					alert('يجب ان تختار عنصر واحد علي الاقل')
				}
			});

			$(document).on('keydown', '#invoice-save', function(e){
		    if(e.which == 13) {
					e.preventDefault();
					return false;
				}
			});

			$(document).on('keyup', '#paid', function(){
				var paid = $(this).val(),
						total = $('#all-total').val();

				$('#residual').val(total-paid);
			});
		})(jQuery)
	</script>
@endsection --}}
