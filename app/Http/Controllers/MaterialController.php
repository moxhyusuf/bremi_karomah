<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::with('order')->orderBy('id', 'desc')->get();
        $orders = Order::get();

        $title = 'Material';

        return view('material.index', compact('orders', 'title', 'materials'));
    }

    public function store(Request $request)
    {
        $data = [
            'order_id' => $request->order_id,
            'nama_item' => $request->nama_item,
        ];

        if ($request->hasFile('desain')) {
            $data['desain'] = $request->file('desain')->store('desain', 'public');
        }

        Material::create($data);
        return redirect()
            ->back()
            ->with('message', [
                'type' => 'success',
                'text' => 'Data material berhasil ditambahkan.'
            ]);
    }

    public function update(Request $request, Material $material)
    {
        $data = [
            'order_id' => $request->order_id,
            'nama_item' => $request->nama_item,
        ];

        if ($request->hasFile('desain')) {
            if ($material->desain && Storage::disk('public')->exists($material->desain)) {
                Storage::disk('public')->delete($material->desain);
            }

            $data['desain'] = $request->file('desain')->store('desain', 'public');
        }

        $material->update($data);

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
