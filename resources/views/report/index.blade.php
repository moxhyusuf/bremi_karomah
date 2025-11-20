@extends('components.layout')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <div>
            <h1 class="h3 mb-0 fw-bold">Reports & History</h1>
        </div>
    </div>

    <div class="card p-4">
        <h4 class="fw-semibold mb-3">Report Filters</h4>

        <form method="GET" action="{{ route('report.generate') }}">
            <div class="row g-3">

                {{-- Date From --}}
                <div class="col-md-4">
                    <label class="form-label">Date From</label>
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>

                {{-- Date To --}}
                <div class="col-md-3">
                    <label class="form-label">Date To</label>
                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>

                {{-- Status --}}
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="retur" {{ request('status') == 'retur' ? 'selected' : '' }}>Retur</option>
                    </select>
                </div>

                {{-- Generate & Export --}}
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-dark w-100">
                        <i data-feather="search"></i> Generate
                    </button>
                </div>

            </div>
        </form>

        {{-- Tabs --}}
        <div class="mt-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ request('tab') != 'summary' ? 'active' : '' }}" href="{{ route('report.index') }}">Orders Report</a>
                </li>
            </ul>
        </div>

        {{-- LIST DATA --}}
        <div class="mt-4">

            @if (isset($orders) && count($orders) > 0)
                <h5 class="fw-semibold">Orders List</h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Customer</th>
                                <th>Tipe</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $o)
                                <tr>
                                    <td>{{ $o->kode }}</td>
                                    <td>{{ $o->customer->nama }}</td>
                                    <td>{{ $o->tipe }}</td>
                                    <td>{{ $o->jumlah }}</td>
                                    <td>
                                        @php
                                            $colors = [
                                                'pending' => 'bg-warning',
                                                'proses' => 'bg-info',
                                                'selesai' => 'bg-success',
                                                'retur' => 'bg-danger',
                                            ];
                                        @endphp

                                        <span class="badge {{ $colors[$o->status] ?? 'bg-secondary' }}">
                                            {{ ucfirst($o->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $o->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5 text-muted">
                    <h6>Click "Generate" to view report data</h6>
                </div>
            @endif

        </div>

    </div>
@endsection
