<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plantation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlantationController extends Controller
{
    public function index()
    {
        $plantations = Plantation::with('user')->latest()->get();
        return view('admin.plantations.index', compact('plantations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:tb_users,id',
            'name' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'address_detail' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        Plantation::create($validated);

        return redirect()->route('admin.plantations.index')
                         ->with('success', 'Data kebun baru berhasil ditambahkan.');
    }

    public function show(Plantation $plantation)
    {
        return response()->json($plantation);
    }

    public function update(Request $request, Plantation $plantation)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:tb_users,id',
            'name' => 'required|string|max:255',
            'address_detail' => 'nullable|string',
            'postal_code' => 'required|string|max:10',
        ]);

        $plantation->update($validated);

        return redirect()->route('admin.plantations.index')
                         ->with('success', 'Data kebun berhasil diperbarui.');
    }

    public function destroy(Plantation $plantation)
    {
        $plantation->delete();

        return redirect()->route('admin.plantations.index')
                         ->with('success', 'Data kebun berhasil dihapus.');
    }
}