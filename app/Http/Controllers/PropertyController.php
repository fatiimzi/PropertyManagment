<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;


class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::all();
        return view('properties.proprerties_list', compact('properties'));
    }

    public function create()
    {
        return view('properties.create_prop');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'type' => 'required|string',
            'units' => 'required|integer',
            'rental_cost' => 'required|numeric',
        ]);

        Property::create($validated);
        return redirect()->route('properties.index');
    }

    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        return view('properties.edit_prop', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'type' => 'required|string',
            'units' => 'required|integer',
            'rental_cost' => 'required|numeric',
        ]);

        $property->update($validated);
        return redirect()->route('properties.index');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('properties.index');
    }
}
