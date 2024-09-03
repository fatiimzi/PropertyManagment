@extends('layouts.app')

@section('title', 'Edit Payment')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">Edit Payment</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('payments.update', $payment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="tenant_id" class="form-label">Tenant</label>
                    <select name="tenant_id" id="tenant_id" class="form-select" required>
                        <option value="" disabled>Select a Tenant</option>
                        @foreach($tenants as $tenant)
                            <option value="{{ $tenant->id }}" {{ $payment->tenant_id == $tenant->id ? 'selected' : '' }}>{{ $tenant->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="payment_date" class="form-label">Payment Date</label>
                    <input type="date" class="form-control" id="payment_date" name="payment_date" value="{{ $payment->payment_date }}" required>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ $payment->amount }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="is_settled" class="form-label">Is Settled?</label>
                    <select name="is_settled" id="is_settled" class="form-select" required>
                        <option value="1" {{ $payment->is_settled ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$payment->is_settled ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-warning">Update Payment</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('tenant_id').addEventListener('change', function() {
        const tenantId = this.value;
        if (tenantId) {
            fetch(`/api/tenants/${tenantId}/property-rent`)
                .then(response => response.json())
                .then(data => {
                    if (data.rental_cost) {
                        document.getElementById('amount').value = data.rental_cost;
                    } else {
                        document.getElementById('amount').value = '';
                        alert('No rental cost found for the selected tenant.');
                    }
                })
                .catch(() => {
                    document.getElementById('amount').value = '';
                    alert('Failed to fetch rental cost. Please try again.');
                });
        } else {
            document.getElementById('amount').value = '';
        }
    });
</script>
@endsection
