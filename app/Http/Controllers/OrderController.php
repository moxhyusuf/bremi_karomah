<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->orderBy('id', 'desc')->get();
        $customers = Customer::all();
        $title = 'Order';
        return view('order.index', compact('orders', 'title', 'customers'));
    }

    public function store(Request $request)
    {
        $kode = $request->kode;
        $exists = Order::where('kode', $kode)->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->with('message', [
                    'type' => 'danger',
                    'text' => 'Kode sudah digunakan. Silakan gunakan kode lain.'
                ]);
        }

        Order::create($request->all());

        return redirect()
            ->back()
            ->with('message', [
                'type' => 'success',
                'text' => 'Data order berhasil ditambahkan.'
            ]);
    }

    public function update(Request $request, Order $order)
    {
        $exists = Order::where('kode', $request->kode)
            ->where('id', '!=', $order->id)
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->with('message', [
                    'type' => 'danger',
                    'text' => 'Kode sudah digunakan. Silakan gunakan kode lain.'
                ]);
        }

        $order->update($request->all());
        return redirect()
            ->back()
            ->with('message', [
                'type' => 'success',
                'text' => 'Data order berhasil diperbarui.'
            ]);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()
            ->route('order.index')
            ->with('message', [
                'type' => 'success',
                'text' => 'Data order berhasil dihapus.'
            ]);
    }
}
