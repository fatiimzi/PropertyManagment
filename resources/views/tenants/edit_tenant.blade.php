@extends('layouts.app')

@section('title', 'Edit Tenant')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1 class="card-title mb-4">Edit Tenant</h1>
            <form action="{{ route('tenants.update', $tenant->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Use PUT or PATCH to update the tenant -->

                <div class="mb-3">
                    <label for="name" class="form-label">Tenant Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $tenant->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="contact_details" class="form-label">Contact Details</label>
                    <input type="text" class="form-control" id="contact_details" name="contact_details" value="{{ old('contact_details', $tenant->contact_details) }}" required>
                </div>

                <div class="mb-3">
                    <label for="property_id" class="form-label">Property</label>
                    <select class="form-select" id="property_id" name="property_id" required>
                        <option value="">Select a Property</option>
                        @foreach($properties as $property)
                            <option value="{{ $property->id }}" {{ $tenant->property_id == $property->id ? 'selected' : '' }}>
                                {{ $property->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Tenant</button>
            </form>
        </div>
    </div>
</div>
@endsection
