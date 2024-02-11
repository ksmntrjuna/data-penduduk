<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Province;

class DistrictController extends Controller
{
    public function index(Request $request)
    {
        $query = District::query();

        // Filter berdasarkan provinsi
        if ($request->filled('province_id')) {
            $query->where('province_id', $request->input('province_id'));
        }

        // Pencarian berdasarkan nama kabupaten
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $districts = $query->with('province')->get();
        $provinces = Province::all();

        return view('districts.index', compact('districts', 'provinces'));
    }


    public function create()
    {
        $provinces = Province::all();
        return view('districts.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
        ]);

        District::create($request->all());

        return redirect()->route('districts.index')->with('success', 'Kabupaten berhasil ditambahkan');
    }

    public function edit(District $district)
    {
        $provinces = Province::all();
        return view('districts.edit', compact('district', 'provinces'));
    }

    public function update(Request $request, District $district)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
        ]);

        $district->update($request->all());

        return redirect()->route('districts.index')->with('success', 'Kabupaten berhasil diperbarui');
    }

    public function destroy(District $district)
    {
        $district->delete();

        return redirect()->route('districts.index')->with('success', 'Kabupaten berhasil dihapus');
    }
}

