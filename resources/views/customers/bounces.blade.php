@php

if ($user->type == 'customer') {
    $text = 'customers.profile';
}else {
    $text = 'suppliers.profile';
}
    
@endphp

@extends($text)

@section('user-content')
    @include('components.invoice-table', ['invoices' => $invoices])
@endsection