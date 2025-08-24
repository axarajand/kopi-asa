<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FarmerController extends Controller
{
    public function index()
    {
        $farmers = User::where('role', 'farmer')->latest()->paginate(10);
        return view('admin.farmers.index', compact('farmers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $firstName = explode(' ', $request->name)[0];
            $timestamp = now()->format('dmYHi');
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $avatarName = strtolower($firstName) . '_' . $timestamp . '.' . $extension;
            $avatarPath = $request->file('avatar')->storeAs('avatars', $avatarName, 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'farmer',
            'profile_photo_path' => $avatarPath,
        ]);

        return redirect()->route('admin.farmers.index')
                         ->with('success', 'Akun petani baru berhasil dibuat.');
    }

    public function show(User $farmer)
    {
        return response()->json($farmer);
    }

    public function update(Request $request, User $farmer)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('tb_users')->ignore($farmer->id)],
            'password' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $data = $request->except('password', 'avatar');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            if ($farmer->profile_photo_path) {
                Storage::disk('public')->delete($farmer->profile_photo_path);
            }
            $firstName = explode(' ', $request->name)[0];
            $timestamp = now()->format('dmYHi');
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $avatarName = strtolower($firstName) . '_' . $timestamp . '.' . $extension;
            $data['profile_photo_path'] = $request->file('avatar')->storeAs('avatars', $avatarName, 'public');
        }

        $farmer->update($data);

        return redirect()->route('admin.farmers.index')
                         ->with('success', 'Data petani berhasil diperbarui.');
    }

    public function destroy(User $farmer)
    {
        if ($farmer->profile_photo_path) {
            Storage::disk('public')->delete($farmer->profile_photo_path);
        }
        $farmer->delete();

        return redirect()->route('admin.farmers.index')
                         ->with('success', 'Akun petani berhasil dihapus.');
    }

    public function getPlantationsForDropdown(User $user)
    {
        return response()->json($user->plantations);
    }
}