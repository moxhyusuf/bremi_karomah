<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::with('order')->orderBy('id', 'desc')->get();
        $orders = Order::all();
        $title = 'Material';

        return view('material.index', compact('orders', 'title', 'materials'));
    }

    public function store(Request $request)
    {
        Material::create($request->all());
        return redirect()
            ->back()
            ->with('message', [
                'type' => 'success',
                'text' => 'Data material berhasil ditambahkan.'
            ]);
    }

    public function update(Request $request, Material $material)
    {
        $material->update($request->all());
        return redirect()
            ->back()
            ->with('message', [
                'type' => 'success',
                'text' => 'Data material berhasil diperbarui.'
            ]);
    }

    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()
            ->back()
            ->with('message', [
                'type' => 'success',
                'text' => 'Data material berhasil dihapus.'
            ]);
    }
}
