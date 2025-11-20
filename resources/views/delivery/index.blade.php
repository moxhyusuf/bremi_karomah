@extends('components.layout')
@section('content')
    <h1 class="h3 mb-3"><i class="align-middle" data-feather="truck"></i> Halaman Delivery Management (OUT)</h1>
    @if (auth()->user()->role !== 'manager')
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_create">
            <i class="align-middle" data-feather="plus-circle"></i> Tambah
        </button>
    @endif
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
                                <th>Jumlah Pengantaran</th>
                                <th>Metode</th>
                                <th>Penerima</th>
                                <th>Tanggal</th>
                                @if (auth()->user()->role !== 'manager')
                                    <th class="no-sort">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deliveries as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td> {{ $item->order->kode }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td> {{ $item->metode }}</td>
                                    <td> {{ $item->nama_penerima }}</td>
                                    <td>{{ $item->createdAtFormatted }}</td>
                                    @if (auth()->user()->role !== 'manager')
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <form action="{{ route('delivery.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data?');">
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
                <form autocomplete="off" action="{{ route('delivery.store') }}" method="POST">
                    @csrf()
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">Pilih Order <span class="text-danger">*</span></label>
                                <select class="form-select" name="order_id" required>
                                    <option value="" selected>-</option>
                                    @foreach ($orders as $order)
                                        <option value="{{ $order->id }}">
                                            {{ ucwords($order->kode) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                <input type="number" name="jumlah" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">Metode <span class="text-danger">*</span></label>
                                <input type="text" name="metode" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">Nama Penerima <span class="text-danger">*</span></label>
                                <input type="text" name="nama_penerima" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">Kontak Penerima <span class="text-danger">*</span></label>
                                <input type="text" name="kontak penerima" class="form-control" required>
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

    @foreach ($deliveries as $item)
        <div class="modal fade" id="modal_update{{ $item->id }}" tabindex="-1" aria-hidden="true" aria-labelledby="modal_update{{ $item->id }}Label">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-capitalize">Form Delivery</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('delivery.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">Pilih Order <span class="text-danger">*</span></label>
                                    <select class="form-select" name="order_id" required>
                                        <option value="" selected>-</option>
                                        @foreach ($orders as $order)
                                            <option value="{{ $order->id }}" @selected($item->order_id == $order->id)>
                                                {{ ucwords($order->kode) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                    <input type="number" name="jumlah" class="form-control" required value="{{ $item->jumlah }}">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">Metode <span class="text-danger">*</span></label>
                                    <input type="text" name="metode" class="form-control" required value="{{ $item->metode }}">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">Nama Penerima <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_penerima" class="form-control" required value="{{ $item->nama_penerima }}">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">Kontak Penerima <span class="text-danger">*</span></label>
                                    <input type="text" name="kontak penerima" class="form-control" required value="{{ $item->kontak_penerima }}">
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
