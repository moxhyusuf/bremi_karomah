@extends('components.layout')
@section('content')
    <h1 class="h3 mb-3"><i class="align-middle" data-feather="user"></i> Halaman Manajemen Customer</h1>
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
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Perusahaan</th>
                                @if (auth()->user()->role !== 'manager')
                                    <th class="no-sort">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td> {{ $item['nama'] }}</td>
                                    <td>{{ $item['no_telepon'] }}</td>
                                    <td>{{ $item['alamat'] }}</td>
                                    <td>{{ $item['nama_perusahaan'] }}</td>
                                    @if (auth()->user()->role !== 'manager')
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <form action="{{ route('customer.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this customer?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="align-middle" data-feather="trash"></i> Delete
                                                    </button>
                                                </form>
                                                <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal_update{{ $item->id }}">
                                                    <i class="align-middle" data-feather="edit"></i> Edit
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
                    <h1 class="modal-title fs-5 text-capitalize">Form Customer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form autocomplete="off" action="{{ route('customer.store') }}" method="POST">
                    @csrf()
                    <div class="modal-body">
                        <div class="row g-3">
                            <input type="text" name="id_user" id="id_user" hidden>
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">Nama Customer</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">No Telepon</label>
                                <input type="number" name="no_telepon" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label class="form-label">Nama Perusahaan</label>
                                <input type="text" name="nama_perusahaan" class="form-control" required>
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

    @foreach ($customers as $item)
        <div class="modal fade" id="modal_update{{ $item->id }}" tabindex="-1" aria-hidden="true" aria-labelledby="modal_update{{ $item->id }}Label">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-capitalize">Form Customer</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('customer.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">Nama Customer</label>
                                    <input type="text" name="nama" class="form-control" required value="{{ $item['nama'] }}">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">No Telepon</label>
                                    <input type="number" name="no_telepon" class="form-control" required value="{{ $item['no_telepon'] }}">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" required value="{{ $item['alamat'] }}">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label class="form-label">Nama Perusahaan</label>
                                    <input type="text" name="nama_perusahaan" class="form-control" required value="{{ $item['nama_perusahaan'] }}">
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
