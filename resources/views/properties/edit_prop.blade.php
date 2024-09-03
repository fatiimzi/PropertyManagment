@extends('layouts.app')

@section('title', isset($property) ? 'Edit Property' : 'Add Property')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ isset($property) ? 'Edit Property' : 'Add Property' }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ isset($property) ? route('properties.update', $property->id) : route('properties.store') }}" method="POST">
                @csrf
                @if(isset($property))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Property Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $property->name ?? '') }}" placeholder="Enter property name" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $property->address ?? '') }}" placeholder="Enter property address" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="" disabled>Select Type</option>
                        <option value="Apartment" {{ old('type', $property->type ?? '') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="House" {{ old('type', $property->type ?? '') == 'House' ? 'selected' : '' }}>House</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="units" class="form-label">Number of Units</label>
                    <input type="number" class="form-control" id="units" name="units" value="{{ old('units', $property->units ?? '') }}" placeholder="Enter number of units" required>
                </div>

                <div class="mb-3">
                    <label for="rental_cost" class="form-label">Rental Cost</label>
                    <input type="number" step="0.01" class="form-control" id="rental_cost" name="rental_cost" value="{{ old('rental_cost', $property->rental_cost ?? '') }}" placeholder="Enter rental cost" required>
                </div>

                <button type="submit" class="btn btn-primary">{{ isset($property) ? 'Update Property' : 'Add Property' }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
