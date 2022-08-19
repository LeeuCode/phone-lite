@extends('customers.profile')

@section('user-content')
    @include('components.invoice-table', ['invoices' => $invoices])
@endsection