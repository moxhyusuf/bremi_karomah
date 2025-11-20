<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.head')
</head>

<body>
    <div class="wrapper">
        @include('components.sidebar')
        <div class="main">
            @include('components.header')
            <main class="content">
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </main>
            @include('components.toast')
        </div>
    </div>
    @include('components.script')
</body>

</html>
