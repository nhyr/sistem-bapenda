<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::latest()->paginate(10);

        return view('admin.assets.index', compact('assets'));
    }

    public function create()
    {
        return view('admin.assets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_asset' => ['required', 'string', 'max:100', 'unique:assets,kode_asset'],
            'nama_asset' => ['required', 'string', 'max:255'],
            'kategori' => ['nullable', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
            'kondisi' => ['required', 'in:baik,rusak_ringan,rusak_berat'],
        ]);

        Asset::create($validated);

        return redirect()->route('admin.assets.index')
            ->with('success', 'Data aset berhasil ditambahkan.');
    }

    public function edit(Asset $asset)
    {
        return view('admin.assets.edit', compact('asset'));
    }

    public function update(Request $request, Asset $asset)
    {
        $validated = $request->validate([
            'kode_asset' => ['required', 'string', 'max:100', 'unique:assets,kode_asset,' . $asset->id],
            'nama_asset' => ['required', 'string', 'max:255'],
            'kategori' => ['nullable', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
            'kondisi' => ['required', 'in:baik,rusak_ringan,rusak_berat'],
        ]);

        $asset->update($validated);

        return redirect()->route('admin.assets.index')
            ->with('success', 'Data aset berhasil diperbarui.');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()->route('admin.assets.index')
            ->with('success', 'Data aset berhasil dihapus.');
    }
}