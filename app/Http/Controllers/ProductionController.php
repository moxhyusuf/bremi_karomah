<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->orderBy('id', 'desc')->get();
        $title = 'Production';
        return view('production.index', compact('orders', 'title'));
    }

    public function update(Request $request, $id)
    {

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        return redirect()
            ->back()
            ->with('message', [
                'type' => 'success',
                'text' => 'Status order berhasil diperbarui.'
            ]);
    }
}
