<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Tenant;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the payments.
     */
    public function index()
    {
        // Fetch all payments along with the related tenant and property
        $payments = Payment::with(['tenant', 'property'])->get();
        return view('payments.payments_list', compact('payments'));
    }

    /**
     * Show the form for creating a new payment.
     */
    public function create()
    {
        // Fetch all tenants for the dropdown in the create view
        $tenants = Tenant::all();
        return view('payments.create_payment', compact('tenants'));
    }

    /**
     * Store a newly created payment in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'payment_date' => 'required|date',
            'is_settled' => 'required|boolean',
        ]);

        // Get the tenant and their associated property
        $tenant = Tenant::findOrFail($validated['tenant_id']);
        $property = $tenant->property; // Assuming each tenant is linked to one property

        // Calculate the payment amount based on the property's rental cost
        $paymentAmount = $property->rental_cost;

        // Create the payment
        Payment::create([
            'tenant_id' => $validated['tenant_id'],
            'property_id' => $property->id, // Associate with the tenant's property
            'payment_date' => $validated['payment_date'],
            'amount' => $paymentAmount, // Use the property's rental cost as the amount
            'is_settled' => $validated['is_settled'],
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully.');
    }

    /**
     * Show the form for editing the specified payment.
     */
    public function edit(Payment $payment)
    {
        // Fetch all tenants for the dropdown in the edit view
        $tenants = Tenant::all();
        return view('payments.edit', compact('payment', 'tenants'));
    }

    /**
     * Update the specified payment in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'payment_date' => 'required|date',
            'is_settled' => 'required|boolean',
        ]);

        // Get the tenant and their associated property
        $tenant = Tenant::findOrFail($validated['tenant_id']);
        $property = $tenant->property; // Assuming each tenant is linked to one property

        // Calculate the payment amount based on the property's rental cost
        $paymentAmount = $property->rental_cost;

        // Update the payment
        $payment->update([
            'tenant_id' => $validated['tenant_id'],
            'property_id' => $property->id, // Associate with the tenant's property
            'payment_date' => $validated['payment_date'],
            'amount' => $paymentAmount, // Use the property's rental cost as the amount
            'is_settled' => $validated['is_settled'],
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified payment from storage.
     */
    public function destroy(Payment $payment)
    {
        // Delete the payment
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}
