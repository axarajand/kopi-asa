<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::orderBy('name', 'asc')->get();
        return view('admin.regions.index', compact('regions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tb_regions',
            'province' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Region::create($validated);

        return redirect()->route('admin.regions.index')
                         ->with('success', 'Daerah kopi baru berhasil ditambahkan.');
    }

    public function show(Region $region)
    {
        return response()->json($region);
    }

    public function update(Request $request, Region $region)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('tb_regions')->ignore($region->id)],
            'province' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $region->update($validated);

        return redirect()->route('admin.regions.index')
                         ->with('success', 'Data daerah kopi berhasil diperbarui.');
    }

    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()->route('admin.regions.index')
                         ->with('success', 'Data daerah kopi berhasil dihapus.');
    }
}