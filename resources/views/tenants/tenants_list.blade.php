@extends('layouts.app')

@section('title', 'Tenants')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Tenants</h1>
        <a href="{{ route('tenants.create') }}" class="btn btn-primary">Add New Tenant</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Contact Details</th>
                        <th>Property</th>
                        <th>Section</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tenants as $tenant)
                    <tr>
                        <td>{{ $tenant->name }}</td>
                        <td>{{ $tenant->contact_details }}</td>
                        <td>{{ $tenant->property->name }}</td>
                        <td>{{ $tenant->section }}</td>
                        <td>
                            <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this tenant?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No tenants found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
