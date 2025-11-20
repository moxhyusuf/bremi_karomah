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
        $query = Order::with(['customer', 'material', 'delivery']);

        // Filter tanggal
        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $orders = $query->orderBy('created_at', 'DESC')->get();
        $title = 'Report';

        return view('report.index', compact('orders', 'title'));
    }
}
