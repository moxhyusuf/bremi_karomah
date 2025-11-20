@extends('components.layout')
@section('content')
    <h1 class="h3 mb-3"><i class="align-middle" data-feather="activity"></i> Halaman Proses Produksi</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Data Material</h5>
                </div>
                <div class="card-body">
                    <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: 1em;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Order</th>
                                <th>Customer</th>
                                <th>Tipe</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                @if (auth()->user()->role !== 'manager')
                                    <th class="no-sort">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td> {{ $item->kode }}</td>
                                    <td>{{ $item->customer->nama }}</td>
                                    <td> {{ $item->tipe }}</td>
                                    <td> {{ $item->jumlah }}</td>
                                    <td>
                                        @php
                                            $colors = [
                                                'pending' => 'bg-warning',
                                                'proses' => 'bg-info',
                                                'selesai' => 'bg-success',
                                                'retur' => 'bg-danger',
                                            ];
                                        @endphp

                                        <span class="badge {{ $colors[$item->status] ?? 'bg-secondary' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    @if (auth()->user()->role !== 'manager')
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_update{{ $item->id }}">
                                                    <i class="align-middle" data-feather="settings"></i> Update
                                                </button>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @foreach ($orders as $item)
        <div class="modal fade" id="modal_update{{ $item->id }}" tabindex="-1" aria-hidden="true" aria-labelledby="modal_update{{ $item->id }}Label">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-capitalize">Form Production</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('production.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="form-group col-12">
                                    <label class="form-label">Status Order <span class="text-danger">*</span></label>
                                    <select class="form-select" name="status" required>
                                        <option value="" selected>-</option>
                                        @foreach (App\Models\Order::ORDER_STATUS as $status)
                                            <option value="{{ $status }}" @selected($item->status == $status)>
                                                {{ ucwords($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
