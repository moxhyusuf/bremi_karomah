@extends('components.layout')
@section('content')
    <h1 class="h3 mb-3"><i class="align-middle" data-feather="users"></i> Halaman Manajemen User</h1>
    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_create">
        <i class="align-middle" data-feather="plus-circle"></i> Tambah
    </button>
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
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th class="no-sort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td> {{ $item['name'] }}</td>
                                    <td class="text-lowercase">{{ $item['email'] }}</td>
                                    <td>{{ $item['role'] }}</td>
                                    <td>
                                        <span class="badge {{ $item['is_active'] ? 'bg-success' : 'bg-danger' }}">
                                            {{ $item['is_active'] ? 'Active' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal_update{{ $item->id }}">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                        </div>
                                    </td>
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
                    <h1 class="modal-title fs-5 text-capitalize">Form User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form autocomplete="off" action="{{ route('user.store') }}" method="POST">
                    @csrf()
                    <div class="modal-body">
                        <div class="row g-3">
                            <input type="text" name="id_user" id="id_user" hidden>
                            <div class="form-group col-md-6 col-12">
                                <label for="name" class="form-label">Nama User</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div id="section_role" class="form-group col-md-6 col-12">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" name="role" id="role" required>
                                    <option value="" selected>-</option>
                                    @foreach (App\Models\User::ROLE as $role)
                                        <option value="{{ $role }}" {{ $role }}>
                                            {{ ucwords($role) }}
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

    @foreach ($users as $user)
        <div class="modal fade" id="modal_update{{ $user->id }}" tabindex="-1" aria-hidden="true" aria-labelledby="modal_update{{ $user->id }}Label">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-capitalize">Form User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row g-3">
                                <input type="text" name="id_user" hidden>
                                <div class="form-group col-md-6 col-12">
                                    <label for="name" class="form-label">Nama User</label>
                                    <input type="text" name="name" class="form-control" required value="{{ $user['name'] }}">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" required value="{{ $user['email'] }}">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control">
                                    <div class="form-text">Biarkan Input Password Kosong, Bila Tidak Ingin Merubah Password</div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select" name="role">
                                        <option value="" selected>-</option>
                                        @foreach (App\Models\User::ROLE as $role)
                                            <option value="{{ $role }}" {{ $role === $user['role'] ? 'selected' : '' }}>
                                                {{ ucwords($role) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="is_active" class="form-label">Status User</label>
                                    <select name="is_active" id="is_active" class="form-control" required>
                                        <option value="1" {{ $user->is_active === 1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ $user->is_active === 0 ? 'selected' : '' }}>Non-Aktif</option>
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
