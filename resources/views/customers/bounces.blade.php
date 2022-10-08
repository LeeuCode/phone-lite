@if ($user->type == 'customer')
    @extends('customers.profile')
@else
    @extends('suppliers.profile')
@endif

@section('user-content')
    @include('components.invoice-table', ['invoices' => $invoices])
@endsection