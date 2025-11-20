<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $title = 'Customer';
        return view('customer.index', compact('customers', 'title'));
    }

    public function store(Request $request)
    {
        Customer::create([
            'nama' => $request->nama,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'nama_perusahaan' => $request->nama_perusahaan,
        ]);

        return redirect()
            ->route('customer.index')
            ->with('message', [
                'type' => 'success',
                'text' => 'Data Customer berhasil ditambahkan.'
            ]);
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
        return redirect()
            ->route('customer.index')
            ->with('message', [
                'type' => 'success',
                'text' => 'Data Customer berhasil diperbarui.'
            ]);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('customer.index')
            ->with('message', [
                'type' => 'success',
                'text' => 'Data Customer berhasil dihapus.'
            ]);
    }
}
