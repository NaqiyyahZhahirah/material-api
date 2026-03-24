<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    // READ
    public function index() {
        $materials = Material::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Material Berhasil Diambil',
            'data'    => $materials
        ], 200);
    }

    // CREATE
    public function store(Request $request) {
        $request->validate([
            'nama_material' => 'required',
            'kategori'      => 'required',
            'harga'         => 'required|numeric',
            'stok'          => 'required|integer',
        ]);

        $material = Material::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Material Baru Ditambahkan',
            'data'    => $material
        ], 201);
    }

    // READ SINGLE
    public function show(Material $material) {
        return response()->json([
            'success' => true,
            'data'    => $material
        ], 200);
    }

    // UPDATE
    public function update(Request $request, Material $material) {
        $material->update($request->all());
        $material->refresh();
        return response()->json([
            'success' => true,
            'message' => 'Material Berhasil Diperbarui',
            'data'    => $material
        ], 200);
    }

    // DELETE
    public function destroy(Material $material) {
        $material->delete();
        return response()->json([
            'success' => true,
            'message' => 'Material Berhasil Dihapus'
        ], 200);
    }
}