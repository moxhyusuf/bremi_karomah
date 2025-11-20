<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.head')
    <!-- Pastikan Bootstrap 5 sudah di-include -->
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-body p-4 text-center">
                        <h1 class="h4 fw-bold mb-3 text-primary">Verifikasi Email Anda</h1>
                        <p class="text-muted mb-4">
                            Kami telah mengirim link verifikasi ke email Anda.
                            Silakan periksa inbox atau folder spam.
                        </p>

                        @if (session('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                Kirim Ulang Link Verifikasi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.script')
</body>

</html>
