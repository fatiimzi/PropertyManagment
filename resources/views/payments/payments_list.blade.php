@extends('layouts.app')

@section('title', 'Payments')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Payments</h1>
        <a href="{{ route('payments.create') }}" class="btn btn-primary">Add Payment</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Tenant</th>
                        <th>Property</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Settled</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->tenant->name }}</td>
                        <td>{{ $payment->property->name }}</td>
                        <td>{{ $payment->payment_date }}</td>
                        <td>${{ number_format($payment->amount, 2) }}</td>
                        <td>
                            <span class="badge {{ $payment->is_settled ? 'bg-success' : 'bg-danger' }}">
                                {{ $payment->is_settled ? 'Yes' : 'No' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this payment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No payments found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
