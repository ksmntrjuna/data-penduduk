<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        return view('provinces.index', compact('provinces'));
    }

    public function create()
    {
        return view('provinces.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Province::create($request->all());

        return redirect()->route('provinces.index')->with('success', 'Provinsi berhasil ditambahkan');
    }

    public function edit(Province $province)
    {
        return view('provinces.edit', compact('province'));
    }

    public function update(Request $request, Province $province)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $province->update($request->all());

        return redirect()->route('provinces.index')->with('success', 'Provinsi berhasil diperbarui');
    }

    public function destroy(Province $province)
    {
        $province->delete();

        return redirect()->route('provinces.index')->with('success', 'Provinsi berhasil dihapus');
    }
}
