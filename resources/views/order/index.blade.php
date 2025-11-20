@extends('components.layout')
@section('content')
    <h1 class="h3 mb-3"><i class="align-middle" data-feather="package"></i> Halaman Manajemen Order</h1>
    @if (auth()->user()->role !== 'manager')
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_create">
            <i class="align-middle" data-feather="plus-circle"></i> Tambah
        </button>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Data User</h5>
                </div>
                <div class="card-body">
                    <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: 1em;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Customer</th>
                                <th>Tipe</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                @if (auth()->user()->role !== 'manager')
                                    <th class="no-sort">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td> {{ $item['kode'] }}</td>
                                    <td>{{ $item['customer']['nama'] }}</td>
                                    <td>{{ $item['tipe'] }}</td>
                                    <td>{{ $item['jumlah'] }}</td>
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
                                    <td>{{ $item->createdAtFormatted }}</td>
                                    @if (auth()->user()->role !== 'manager')
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <form action="{{ route('order.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="align-middle" data-feather="trash"></i>
                                                    </button>
                                                </form>
                                                <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal_update{{ $item->id }}">
                                                    <i class="align-middle" data-feather="edit"></i>
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


    <div class="modal fade" id="modal_create" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-capitalize">Form Order</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form autocomplete="off" action="{{ route('order.store') }}" method="POST">
                    @csrf()
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">Kode Order <span class="text-danger">*</span></label>
                                <input type="text" name="kode" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">Customer <span class="text-danger">*</span></label>
                                <select class="form-select" name="customer_id" required>
                                    <option value="" selected>-</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer['id'] }}">{{ ucwords($customer['nama']) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">Tipe Produk <span class="text-danger">*</span></label>
                                <select class="form-select" name="tipe" required>
                                    <option value="" selected>-</option>
                                    @foreach (App\Models\Order::ORDER_TYPE as $type)
                                        <option value="{{ $type }}">{{ ucwords($type) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                <input type="number" name="jumlah" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">Refrensi Desain <span class="text-danger">*</span></label>
                                <input type="text" name="desain" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">Warna <span class="text-danger">*</span></label>
                                <input type="text" name="warna" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">Ukuran <span class="text-danger">*</span></label>
                                <select class="form-select" name="ukuran" required>
                                    <option value="" selected>-</option>
                                    @foreach (App\Models\Order::ORDER_SIZE as $size)
                                        <option value="{{ $size }}">{{ ucwords($size) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">Posisi <span class="text-danger">*</span></label>
                                <input type="text" name="posisi" class="form-control" required>
                            </div>
                            <div class="form-group col-12">
                                <label class="form-label">Catatan</label>
                                <textarea class="form-control" name="catatan" id="" rows="3"></textarea>
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

    @foreach ($orders as $item)
        <div class="modal fade" id="modal_update{{ $item->id }}" tabindex="-1" aria-hidden="true" aria-labelledby="modal_update{{ $item->id }}Label">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-capitalize">Form Order</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('order.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">Kode Order <span class="text-danger">*</span></label>
                                    <input type="text" name="kode" class="form-control" required value="{{ $item->kode }}">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">Customer <span class="text-danger">*</span></label>
                                    <select class="form-select" name="customer_id" required>
                                        <option value="" selected>-</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" @selected($item->customer_id == $customer->id)>
                                                {{ ucwords($customer->nama) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">Tipe Produk <span class="text-danger">*</span></label>
                                    <select class="form-select" name="tipe" required>
                                        <option value="" selected>-</option>
                                        @foreach (App\Models\Order::ORDER_TYPE as $type)
                                            <option value="{{ $type }}" @selected($item->tipe == $type)>
                                                {{ ucwords($type) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                    <input type="number" name="jumlah" class="form-control" required value="{{ $item->jumlah }}">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">Refrensi Desain <span class="text-danger">*</span></label>
                                    <input type="text" name="desain" class="form-control" required value="{{ $item->desain }}">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">Warna <span class="text-danger">*</span></label>
                                    <input type="text" name="warna" class="form-control" required value="{{ $item->warna }}">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">Ukuran <span class="text-danger">*</span></label>
                                    <select class="form-select" name="ukuran" required>
                                        <option value="" selected>-</option>
                                        @foreach (App\Models\Order::ORDER_SIZE as $size)
                                            <option value="{{ $size }}" @selected($item->ukuran == $size)>
                                                {{ ucwords($size) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">Posisi <span class="text-danger">*</span></label>
                                    <input type="text" name="posisi" class="form-control" required value="{{ $item->posisi }}">
                                </div>
                                <div class="form-group col-12">
                                    <label class="form-label">Catatan</label>
                                    <textarea class="form-control" name="catatan" id="" rows="3">{{ $item->catatan }}</textarea>
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
