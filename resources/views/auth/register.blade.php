<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.head')
</head>

<body>
    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="auth-header">
                    <a href="{{ route('auth.register') }}"><img style="width: 50px" src="{{ asset('img/logo.png') }}" alt="img"></a>
                </div>
                <div class="card my-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-end mb-4">
                            <h3 class="mb-0"><b>Halaman Register</b></h3>
                            <a href="{{ route('auth.login') }}" class="link-primary">Sudah memiliki akun?</a>
                        </div>
                        <form action="{{ route('auth.register') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" placeholder="Masukan Nama" name="name" id="name" value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger mt-1 pl-3 d-block text-capitalize" style="text-align: left;">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Alamat Email</label>
                                <input type="text" class="form-control" placeholder="Alamat Email" name="email" id="email" value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger mt-1 pl-3 d-block text-capitalize" style="text-align: left;">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                                @error('password')
                                    <small class="text-danger mt-1 pl-3 d-block capitalize" style="text-align: left;">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-primary">Buat Akun</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="auth-footer row">
                    <!-- <div class=""> -->
                    <div class="col my-1">
                        <p class="m-0">Copyright © <a href="#">Codedthemes</a></p>
                    </div>
                    <div class="col-auto my-1">
                        <ul class="list-inline footer-link mb-0">
                            <li class="list-inline-item"><a href="#">Home</a></li>
                            <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="#">Contact us</a></li>
                        </ul>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
    @include('components.script')
</body>

</html>
