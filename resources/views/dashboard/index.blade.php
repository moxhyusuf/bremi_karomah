@extends('components.layout')
@section('content')
    <h1 class="h3 mb-3">Halaman Dashboard</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Total Order</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="box"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $totalOrder }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Pending</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="clock"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $pending }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Proses</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="move"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $proses }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Selesai</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="check-circle"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $selesai }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Retur</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="x-circle"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $retur }}</h1>
                </div>
            </div>
        </div>

    </div>
@endsection
