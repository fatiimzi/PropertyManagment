<?php 
namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Property;
use Illuminate\Http\Request;

class TenantController extends Controller
{
/**
* Display a listing of the tenants.
*/
public function index()
{
// Fetch all tenants from the database
$tenants = Tenant::with('property')->get(); // Eager loading the property relationship
return view('tenants.tenants_list', compact('tenants'));
}

/**
* Show the form for creating a new tenant.
*/
public function create()
{
// Fetch all properties to populate the dropdown in the form
$properties = Property::all();
return view('tenants.create_tenant', compact('properties'));
}

/**
* Store a newly created tenant in storage.
*/
public function store(Request $request)
{
// Validate the incoming request data
$validated = $request->validate([
'name' => 'required|string|max:255',
'contact_details' => 'required|string',
'property_id' => 'required|exists:properties,id',
]);

// Create a new tenant in the database
Tenant::create($validated);

// Redirect back to the tenants list with a success message
return redirect()->route('tenants.index')->with('success', 'Tenant added successfully.');
}

/**
* Display the specified tenant.
*/
public function show(Tenant $tenant)
{
// Show the details of a specific tenant
return view('tenants.show', compact('tenant'));
}

/**
* Show the form for editing the specified tenant.
*/
public function edit(Tenant $tenant)
{
// Fetch all properties for the dropdown
$properties = Property::all();
return view('tenants.edit_tenant', compact('tenant', 'properties'));
}

/**
* Update the specified tenant in storage.
*/
public function update(Request $request, Tenant $tenant)
{
// Validate the incoming request data
$validated = $request->validate([
'name' => 'required|string|max:255',
'contact_details' => 'required|string',
'property_id' => 'required|exists:properties,id',
]);

// Update the tenant in the database
$tenant->update($validated);

// Redirect back to the tenants list with a success message
return redirect()->route('tenants.index')->with('success', 'Tenant updated successfully.');
}

/**
* Remove the specified tenant from storage.
*/
public function destroy(Tenant $tenant)
{
// Delete the tenant from the database
$tenant->delete();

// Redirect back to the tenants list with a success message
return redirect()->route('tenants.index')->with('success', 'Tenant deleted successfully.');
}
}