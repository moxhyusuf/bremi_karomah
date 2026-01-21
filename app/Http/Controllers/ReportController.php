<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $title = 'Report';
        return view('report.index', compact('title'));
    }

    public function generate(Request $request)
    {
        $title = 'Report';

        $query = Order::with(['customer', 'material', 'delivery']);

        // Filter tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter kode barang
        if ($request->filled('kode')) {
            $query->where('kode', 'like', '%' . $request->kode . '%');
        }

        // Filter jenis / tipe barang
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        // =====================
        // TOTAL KESELURUHAN
        // =====================
        $totalJumlah = $orders->sum('jumlah');

        // =====================
        // REKAP PER KATEGORI / TIPE
        // =====================
        $rekapKategori = $orders->groupBy('tipe')->map(function ($items) {
            return [
                'total_order' => $items->count(),
                'total_jumlah' => $items->sum('jumlah'),
            ];
        });

        return view('report.index', compact(
            'orders',
            'title',
            'totalJumlah',
            'rekapKategori'
        ));
    }
}
