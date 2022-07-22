<div class="col-md-6 mt-3 mb-3">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-file-invoice"></i> 
                {{ __('احدث فواتير المبيعات') }}
            </h3>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>{{ __('بواسطة') }}</th>
                        <th>{{ __('نوع الحركة') }}</th>
                        <th >{{ __('نسبة الخصم') }}</th>
                        <th >{{ __('الاجمالي') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $invoicesSale = App\Models\Invoice::where('invoice_type','sale')
                        ->orderby('created_at', 'DESC')->limit(5)->get();
                    ?>

                    @foreach ($invoicesSale as $invoice)
                        <tr>
                            <td>{{ $invoice->id }}.</td>
                            <td>{{ $invoice->user->name }}</td>
                            <td>
                                @if ($invoice->movement_type == 'cash')
                                    <span class="badge bg-success" >{{ __('نقدي') }}</span>
                                @else
                                    
                                @endif
                            </td>
                            <td>
                                @if ($invoice->discount_amount != 0)
                                    {{ $invoice->discount_amount }}
                                @else
                                    <span class="badge bg-danger" >{{ __('لا يوجد خصم') }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $invoice->total_bill }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>