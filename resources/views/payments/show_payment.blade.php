<!-- resources/views/payments/show.blade.php -->
@extends('layouts.app')

@section('title', 'Payment Details')

@section('content')
<h1>Payment Details</h1>

<div class="card">
    <div class="card-header">
        Payment for {{ $payment->tenant->name }} ({{ $payment->tenant->property->name }})
    </div>
    <div class="card-body">
        <p><strong>Tenant Name:</strong> {{ $payment->tenant->name }}</p>
        <p><strong>Property:</strong> {{ $payment->tenant->property->name }}</p>
        <p><strong>Amount:</strong> ${{ $payment->amount }}</p>
        <p><strong>Date Paid:</strong> {{ $payment->date_paid }}</p>
        <p><strong>Status:</strong> 
            @if($payment->is_settled)
                <span class="badge bg-success">Settled</span>
            @else
                <span class="badge bg-danger">Due</span>
            @endif
        </p>
    </div>
    <div class="card-footer text-end">
        <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning">Edit Payment</a>
        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Payment</button>
        </form>
    </div>
</div>
@endsection
