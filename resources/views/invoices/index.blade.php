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

		<div class="modal fade" data-backdrop="static" id="calculation">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">
							<i class="fas fa-cash-register"></i>
							<span class="title" >{{ __('الحساب') }}</span>
							{{-- <span class="text-info">({{ $category->title }})</span> --}}
						</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<form class="create-category" action="{{ route('ajax.createCategory') }}" method="post">
						@csrf
					<div class="modal-body">
							<h3 class="text-center">اجمالي الحساب</h3>
							<h1 class="text-center text-danger">
								<span class="total" >0</span>ج
								<input id="all-total" type="hidden" name="total_bill" class="total" value="0">
							</h1>
							{{-- <input type="hidden" name="type" value="category"> --}}
							<div class="form-group text-center">
									<label for="paid" class="control-label">{{ __('المدفوع') }}</label>
									<input type="number" name="paid" class="form-control text-center paid" id="paid" placeholder="00" autocomplete="off">
							</div>
							<div class="form-group text-center">
									<label for="residual" class="control-label">{{ __('المتبقي') }}</label>
									<input type="text" name="residual" class="form-control text-center" id="residual" value="0" placeholder="00">
							</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('إغلاق') }}</button>
						 <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
					</div>
				</div>
				</form>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
	  </div>
	</form>

	@include('invoices.print', ['id' => 'ticket'])

	<div class="modal fade" data-backdrop="static" id="add-category">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">
						<i class="fas fa-edit"></i>
						<span class="title agentName" >{{ __('تعديل') }}</span>
					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form class="create-user" action="{{ route('ajax.createUser') }}" method="post">
						@csrf
						<div class="modal-body">
								<input type="hidden" name="type" value="customer">
								<div class="form-group">
										<label for="barcode" class="control-label agentName">{{ __('اسم عميل') }}</label>
										<input type="text" name="title" class="form-control" id="barcode" placeholder="{{ __('اكتب العنوان هنا') }}">
								</div>

								<div class="form-group">
										<label for="barcode" class="control-label">{{ __('رقم المحمول') }}</label>
										<input type="text" name="phone" class="form-control" id="barcode" placeholder="{{ __('أكتب رقم تليفون العميل') }}">
								</div>
						</div>
						<div class="modal-footer justify-content-between">
							<button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('إغلاق') }}</button>
							 <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
						</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
  </div>

@endsection

@section('js')
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
		    $('#total_tax, .total, #residual').val(totalTax());
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
						barcode = trRow.attr('id'),
						qt = $(this).val(),
						itemPrice = trRow.find('.price').val(),
						itemPurchasingPrice = trRow.find('.purchasing_price').val(),
						totalItems = $('.totalItems').val(),
						total = (qt*itemPrice),
						totalPurchasing = (qt*itemPurchasingPrice),
						trInvoice = $('#in'+barcode),
						invoiceType = $('#invoice_type').val();

				if ( invoiceType == 'purchase') {
					trRow.find('.item-total').val(totalPurchasing);
					trInvoice.find('.prnt-item-total').text(totalPurchasing);
				} else {
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

			$(document).on('keyup', '#tax_rate', function(){
				$('#tax_value').val(taxRate());
		    $('#total_tax, .total, #residual').val(totalTax());
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
											// header: "<h1>Look at all of my kitties!</h1>"
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
								},
								// complete: function() {
								// 		i--;
								// 		if (i <= 0) {
								// 				$(placeholder).removeClass('loading');
								// 		}
								// },
								// dataType: 'html'
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
		    if(movement_type == 'dues') {
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
