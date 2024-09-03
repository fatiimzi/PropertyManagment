<!-- resources/views/tenants/form.blade.php -->
@extends('layouts.app')

@section('title', isset($tenant) ? 'Edit Tenant' : 'Add Tenant')

@section('content')
<h1>{{ isset($tenant) ? 'Edit Tenant' : 'Add Tenant' }}</h1>
<form action="{{ isset($tenant) ? route('tenants.update', $tenant->id) : route('tenants.store') }}" method="POST">
    @csrf
    @if(isset($tenant))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="name" class="form-label">Tenant Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $tenant->name ?? '') }}" required>
   
