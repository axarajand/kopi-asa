<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variety;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VarietyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $varieties = Variety::latest()->get();
        return view('admin.varieties.index', compact('varieties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tb_varieties',
            'species' => 'required|in:Arabika,Robusta,Liberika,Excelsa',
            'notes' => 'nullable|string',
        ]);

        Variety::create($validated);

        return redirect()->route('admin.varieties.index')
                         ->with('success', 'Varietas baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource for AJAX calls.
     */
    public function show(Variety $variety)
    {
        // This method is used to fetch data for the edit modal via AJAX
        return response()->json($variety);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Variety $variety)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('tb_varieties')->ignore($variety->id)],
            'species' => 'required|in:Arabika,Robusta,Liberika,Excelsa',
            'notes' => 'nullable|string',
        ]);

        $variety->update($validated);

        return redirect()->route('admin.varieties.index')
                         ->with('success', 'Data varietas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variety $variety)
    {
        $variety->delete();

        return redirect()->route('admin.varieties.index')
                         ->with('success', 'Data varietas berhasil dihapus.');
    }
}