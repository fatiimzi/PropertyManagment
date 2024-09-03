@extends('layouts.app')

@section('title', 'Add Payment')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add Payment</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('payments.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="tenant_id" class="form-label">Tenant</label>
                    <select name="tenant_id" id="tenant_id" class="form-select" required>
                        <option value="" disabled selected>Select a Tenant</option>
                        @foreach($tenants as $tenant)
                            <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="payment_date" class="form-label">Payment Date</label>
                    <input type="date" class="form-control" id="payment_date" name="payment_date" required>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="is_settled" class="form-label">Is Settled?</label>
                    <select name="is_settled" id="is_settled" class="form-select" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save Payment</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('tenant_id').addEventListener('change', function() {
        const tenantId = this.value;
        if (tenantId) {
            fetch(`/tenants/${tenantId}/property-rent`)
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
