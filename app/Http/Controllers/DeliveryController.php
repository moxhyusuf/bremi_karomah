<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::with('order')->orderBy('id', 'desc')->get();
        $orders = Order::where(['status' => 'selesai'])->get();
        $title = 'Delivery';
        return view('delivery.index', compact('orders', 'title', 'deliveries'));
    }

    public function store(Request $request)
    {
        Delivery::create($request->all());
        return redirect()
            ->back()
            ->with('message', [
                'type' => 'success',
                'text' => 'Data delivery berhasil ditambahkan.'
            ]);
    }

    public function update(Request $request, Delivery $delivery)
    {
        $delivery->update($request->all());
        return redirect()
            ->back()
            ->with('message', [
                'type' => 'success',
                'text' => 'Data delivery berhasil diperbarui.'
            ]);
    }

    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
        return redirect()
            ->back()
            ->with('message', [
                'type' => 'success',
                'text' => 'Data delivery berhasil dihapus.'
            ]);
    }
}
