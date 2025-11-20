<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.head')
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">CV. Bremi Barokah</h1>
                            <p class="lead">Login Untuk Melanjutkan</p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-3">
                                    <form action="{{ route('auth.login') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg" type="text" name="email" placeholder="Masukan email" value="{{ old('email') }}" />
                                            @error('email')
                                                <small class="text-danger mt-1 pl-3 d-block text-capitalize" style="text-align: left;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password" placeholder="Masukan password" />
                                            @error('password')
                                                <small class="text-danger mt-1 pl-3 d-block capitalize" style="text-align: left;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="d-grid gap-2 mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('components.script')
</body>

</html>
