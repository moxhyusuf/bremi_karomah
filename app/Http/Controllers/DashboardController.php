<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Assessor;
use App\Models\Assessment;
use App\Models\Participant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $totalOrder = Order::count();
        $pending = Order::where('status', 'pending')->count();
        $proses  = Order::where('status', 'proses')->count();
        $selesai = Order::where('status', 'selesai')->count();
        $retur   = Order::where('status', 'retur')->count();

        return view('dashboard.index', compact('title', 'totalOrder', 'pending', 'proses', 'selesai', 'retur'));
    }
}
