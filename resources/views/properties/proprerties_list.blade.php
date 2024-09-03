@extends('layouts.app')

@section('title', 'Properties')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Properties</h1>
        <a href="{{ route('properties.create') }}" class="btn btn-primary">Add New Property</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Property Name</th>
                        <th>Address</th>
                        <th>Type</th>
                        <th>Units</th>
                        <th>Rental Cost</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($properties as $property)
                    <tr>
                        <td>{{ $property->name }}</td>
                        <td>{{ $property->address }}</td>
                        <td>{{ $property->type }}</td>
                        <td>{{ $property->units }}</td>
                        <td>${{ number_format($property->rental_cost, 2) }}</td>
                        <td>
                            <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('properties.destroy', $property->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this property?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No properties found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
